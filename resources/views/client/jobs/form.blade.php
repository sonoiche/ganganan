<div class="mb-4">
    <label for="job_title" class="form-label">Job Title</label>
    <input type="text" name="job_title" class="form-control" id="job_title" value="{{ $job->job_title ?? '' }}" placeholder="What role are you hiring for?" />
    <small class="form-text text-muted">Use a clear, searchable role name (e.g., “Experienced Electrician”).</small>
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="workers_need" class="form-label">Number of Workers Needed</label>
            <input type="number" name="workers_need" class="form-control" id="workers_need" value="{{ $job->workers_need ?? '' }}" min="1" placeholder="Enter total headcount" />
            <small class="form-text text-muted">How many workers do you need for this job?</small>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="workers_gender" class="form-label">Preferred Gender</label>
            <select name="workers_gender" id="workers_gender" class="form-select">
                <option value="Any" {{ (isset($job->workers_gender) && $job->workers_gender == 'Any') ? 'selected' : '' }}>Any</option>
                <option value="Male" {{ (isset($job->workers_gender) && $job->workers_gender == 'Male') ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ (isset($job->workers_gender) && $job->workers_gender == 'Female') ? 'selected' : '' }}>Female</option>
            </select>
            <small class="form-text text-muted">Choose “Any” when gender does not impact the work.</small>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="salary" class="form-label">Base Pay Amount</label>
            <input type="number" name="salary" class="form-control" id="salary" value="{{ $job->salary ?? '' }}" min="0" placeholder="e.g., 800" />
            <small class="form-text text-muted">List the numeric amount without symbols. Seeker views will display ₱ automatically.</small>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="salary_rate" class="form-label">Pay Interval</label>
            <select name="salary_rate" id="salary_rate" class="form-select">
                <option value="">Select pay interval</option>
                <option value="Hourly" {{ (isset($job->salary_rate) && $job->salary_rate == 'Hourly') ? 'selected' : '' }}>Hourly</option>
                <option value="Daily" {{ (isset($job->salary_rate) && $job->salary_rate == 'Daily') ? 'selected' : '' }}>Daily</option>
            </select>
            <small class="form-text text-muted">How often will workers be paid? Choose the interval that matches your offer.</small>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="date_needed" class="form-label">Preferred Start Date</label>
            <input type="date" name="date_needed" class="form-control" id="date_needed" value="{{ $job->date_needed ?? '' }}" />
            <small class="form-text text-muted">When do you want the worker to start?</small>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="date_until" class="form-label">Engagement End Date</label>
            <input type="date" name="date_until" class="form-control" id="date_until" value="{{ $job->date_until ?? '' }}" />
            <small class="form-text text-muted">Leave blank if the end date is flexible or ongoing.</small>
        </div>
    </div>
</div>
<div class="mb-4">
    <label for="skills" class="form-label">Key Skills Needed</label>
    <select name="skills[]" id="skills" class="form-select select2" multiple>
        <option value="">Select relevant skills</option>
        @foreach ($skills as $skill)
        <option value="{{ $skill->id }}" {{ (isset($job->skills) && in_array($skill->id, $job->array_skills)) ? 'selected' : '' }}>{{ $skill->name }}</option>
        @endforeach
    </select>
    <small class="form-text text-muted">Pick all skills that are required to succeed in this role.</small>
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="location" class="form-label">Location</label>
            @php
                $selectedLocation = old('location', $job->location ?? '');
            @endphp
            <select name="location" id="location" class="form-select">
                <option value="">Select town or city</option>
                @foreach (config('pangasinan.towns') as $town)
                <option value="{{ $town }}" {{ $selectedLocation === $town ? 'selected' : '' }}>{{ $town }}</option>
                @endforeach
            </select>
            <small class="form-text text-muted">Choose the town where the work will happen. Remote jobs can mention that in the description.</small>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="photo" class="form-label">Cover Photo</label>
            <input type="file" name="photo" class="form-control" id="photo" />
            <small class="form-text text-muted">Upload a square image (1:1) to help your job stand out.</small>
        </div>
    </div>
</div>
<div class="mb-4">
    <label for="job_description" class="form-label">Job Description</label>
    <textarea id="job_description" name="job_description" class="form-control" rows="5" style="width: 100%; resize: none" placeholder="Outline the tasks, schedule, and special requirements">{{ $job->job_description ?? '' }}</textarea>
    <small class="form-text text-muted">Include tools provided, working hours, and any certifications required.</small>
</div>
<div class="mb-4">
    <label for="status" class="form-label">Publishing Status</label>
    <select name="status" id="status" class="form-select">
        <option value="">Select status</option>
        <option value="Publish" {{ (isset($job->status) && $job->status == 'Publish') ? 'selected' : '' }}>Publish (visible to seekers)</option>
        <option value="Draft" {{ (isset($job->status) && $job->status == 'Draft') ? 'selected' : '' }}>Draft (save for later)</option>
    </select>
    <small class="form-text text-muted">Draft posts are only visible to you until you publish them.</small>
</div>