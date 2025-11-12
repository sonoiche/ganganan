@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
            <div class="card-header skill-header pb-0">
                <h5 class="mb-1">Skills Library</h5>
                <p class="text-muted mb-0">Manage the list of skills applicants can select when building their profiles.</p>
            </div>
            <div class="w-skill-search w-md-auto text-end pt-md-0">
                <form action="{{ url('admin/skills') }}" method="post" class="w-100" aria-label="Create or update a skill">
                    @csrf
                    <div class="input-group @error('name') is-invalid @enderror">
                        <input type="text" name="name" id="skill_name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter a skill name (e.g. Welding, Plumbing)" aria-describedby="skill-helper" />
                        <button class="btn btn-secondary create-new btn-primary" type="submit">
                            Save Skill
                        </button>
                    </div>
                    <input type="hidden" name="id" id="skill_id" />
                    @error('name')
                        <div class="invalid-feedback" style="display: block; text-align: left">The skill name field is required.</div>
                    @enderror
                    <div id="skill-helper" class="form-text text-start">Keep names short and specific so seekers can find them easily.</div>
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
                            <a href="javascript:void(0);" onclick="editSkill({{ $skill->id }})" class="text-success" aria-label="Edit {{ $skill->name }}"><i class="bx bx-edit-alt me-1"></i></a> &nbsp;
                            <a href="javascript:void(0);" onclick="removeSkill({{ $skill->id }})" class="text-danger" aria-label="Delete {{ $skill->name }}"><i class="bx bx-trash me-1"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center text-muted" colspan="3">No skills have been added yet. Use the form above to create your first entry.</td>
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
    if(confirm('Removing this skill will hide it from applicants. Do you want to continue?')) {
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