@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        @include('widgets.profile.userinfo')
        <!-- User Content -->
        <div class="col-xl-8 col-lg-7 order-0 order-md-1">
            <!-- User Pills -->
            @include('widgets.profile.userpill')
            <!--/ User Pills -->
    
            <!-- Project table -->
            <div class="card mb-6">
                <div class="d-flex justify-content-between">
                    <h5 class="card-header pb-0 text-sm-start text-center" style="margin-bottom: 15px">Manage my Skill Set</h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('client/skills') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="skills" class="form-label">Skills Set</label>
                            <select name="skills[]" id="skills" class="form-select select2" multiple>
                                <option value="">Select Multiple Skills</option>
                                @foreach ($skills as $skill)
                                <option value="{{ $skill->id }}" {{ (isset($user->user_skill) && in_array($skill->id, $user->user_skill->array_skills)) ? 'selected' : '' }}>{{ $skill->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ url('assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ url('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ url('assets/js/forms-selects.js') }}"></script>
@endpush

@section('css')
<link rel="stylesheet" href="{{ url('assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ url('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
@endsection