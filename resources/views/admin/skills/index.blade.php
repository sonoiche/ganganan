@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
            <h5 class="card-header skill-header">List of Skills</h5>
            <div class="w-skill-search w-md-auto text-end pt-md-0">
                <form action="{{ url('admin/skills') }}" method="post" class="w-100">
                    @csrf
                    <div class="input-group @error('name') is-invalid @enderror">
                        <input type="text" name="name" id="skill_name" class="form-control @error('name') is-invalid @enderror" placeholder="Skill name" />
                        <button class="btn btn-secondary create-new btn-primary" type="submit">
                            Save
                        </button>
                    </div>
                    <input type="hidden" name="id" id="skill_id" />
                    @error('name')
                        <div class="invalid-feedback" style="display: block; text-align: left">The skill name field is required.</div>
                    @enderror
                </form>
            </div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 2%">#</th>
                        <th style="width: 80%">Skill Name</th>
                        <th style="width: 15%" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($skills as $key => $skill)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $skill->name }}</td>
                        <td class="text-center">
                            <a href="javascript:void(0);" onclick="editSkill({{ $skill->id }})" class="text-success"><i class="bx bx-edit-alt me-1"></i></a> &nbsp;
                            <a href="javascript:void(0);" onclick="removeSkill({{ $skill->id }})" class="text-danger"><i class="bx bx-trash me-1"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="3">No data available</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function editSkill(id) {
    $.ajax({
        type: "GET",
        url: "{{ url('admin/skills') }}/" +id+ "/edit",
        dataType: "json",
        success: function (response) {
            $('#skill_id').val(response.skill.id);
            $('#skill_name').val(response.skill.name);
        }
    });
}

function removeSkill(id) {
    if(confirm('Are you sure you want to delete this skill?')) {
        $.ajax({
            type: "DELETE",
            url: "{{ url('admin/skills') }}/" +id,
            dataType: "json",
            success: function (response) {
                location.reload();
            }
        });
    }
}
</script>
@endpush