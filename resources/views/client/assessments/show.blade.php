@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-datatable table-responsive">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header d-flex justify-content-between flex-md-row pb-3">
                    <div class="head-label text-center"><h5 class="card-title mb-0">Assessment Tests &mdash; {{ $assessment->name }}</h5></div>
                </div>
                <div class="card-body">
                    <form action="{{ url('client/assessments') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <ol>
                                    @foreach ($questions as $key => $item)
                                    <li>
                                        {{ $item->question }}
                                        <div class="my-3">
                                            {!! $item->content !!}
                                            <div class="form-group mt-2 w-25">
                                                <label for="answer" class="form-label">Answer: </label>
                                                <select name="answers[]" id="answer" class="form-select">
                                                    <option value="">--</option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="C">C</option>
                                                    <option value="D">D</option>
                                                </select>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mt-3" style="margin-left: 15px;">
                                    <button class="btn btn-primary" type="submit">Submit Answer</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="assessment_id" value="{{ $assessment->id }}" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection