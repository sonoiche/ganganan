<div class="mb-4">
    <label for="job_title" class="form-label">Job Title</label>
    <input type="text" name="job_title" class="form-control" id="job_title" value="{{ $job->job_title ?? '' }}" />
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="workers_need" class="form-label">Number of Needs</label>
            <input type="number" name="workers_need" class="form-control" id="workers_need" value="{{ $job->workers_need ?? '' }}" />
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="workers_gender" class="form-label">Gender</label>
            <select name="workers_gender" id="workers_gender" class="form-select">
                <option value="Any" {{ (isset($job->workers_gender) && $job->workers_gender == 'Any') ? 'selected' : '' }}>Any</option>
                <option value="Male" {{ (isset($job->workers_gender) && $job->workers_gender == 'Male') ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ (isset($job->workers_gender) && $job->workers_gender == 'Female') ? 'selected' : '' }}>Female</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="salary" class="form-label">Salary</label>
            <input type="number" name="salary" class="form-control" id="salary" value="{{ $job->salary ?? '' }}" />
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="salary_rate" class="form-label">Salary Rate</label>
            <select name="salary_rate" id="salary_rate" class="form-select">
                <option value="">Select Rate</option>
                <option value="Hourly" {{ (isset($job->salary_rate) && $job->salary_rate == 'Hourly') ? 'selected' : '' }}>Hourly</option>
                <option value="Daily" {{ (isset($job->salary_rate) && $job->salary_rate == 'Daily') ? 'selected' : '' }}>Daily</option>
            </select>
        </div>
    </div>
</div>
<div class="mb-4">
    <label for="status" class="form-label">Status</label>
    <select name="status" id="status" class="form-select">
        <option value="">Select Status</option>
        <option value="Publish" {{ (isset($job->status) && $job->status == 'Publish') ? 'selected' : '' }}>Publish</option>
        <option value="Draft" {{ (isset($job->status) && $job->status == 'Draft') ? 'selected' : '' }}>Draft</option>
    </select>
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="date_needed" class="form-label">Date Needed</label>
            <input type="date" name="date_needed" class="form-control" id="date_needed" value="{{ $job->date_needed ?? '' }}" />
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="date_until" class="form-label">Date Until</label>
            <input type="date" name="date_until" class="form-control" id="date_until" value="{{ $job->date_until ?? '' }}" />
        </div>
    </div>
</div>
<div class="mb-4">
    <label for="skills" class="form-label">Skills Needed</label>
    <select name="skills[]" id="skills" class="form-select select2" multiple>
        <option value="">Select Multiple Skills</option>
        @foreach ($skills as $skill)
        <option value="{{ $skill->id }}" {{ (isset($job->skills) && in_array($skill->id, $job->array_skills)) ? 'selected' : '' }}>{{ $skill->name }}</option>
        @endforeach
    </select>
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="location" class="form-label">Location</label>
            @php
                $selectedLocation = old('location', $job->location ?? '');
            @endphp
            <select name="location" id="location" class="form-select">
                <option value="">Select Location</option>
                @foreach (config('pangasinan.towns') as $town)
                <option value="{{ $town }}" {{ $selectedLocation === $town ? 'selected' : '' }}>{{ $town }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="photo" class="form-label">Photo</label>
            <input type="file" name="photo" class="form-control" id="photo" />
        </div>
    </div>
</div>
<div class="mb-4">
    <label for="job_description" class="form-label">Job Description</label>
    <textarea id="job_description" name="job_description" class="form-control" rows="5" style="width: 100%; resize: none">{{ $job->job_description ?? '' }}</textarea>
</div>