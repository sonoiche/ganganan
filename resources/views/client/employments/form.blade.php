<div class="mb-4">
    <label for="name" class="form-label">Service / Work</label>
    <input type="text" name="name" class="form-control" id="name" value="{{ $employment->name ?? '' }}" />
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="employer" class="form-label">Name of Employer</label>
            <input type="text" name="employer" class="form-control" id="employer" value="{{ $employment->employer ?? '' }}" />
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="employment_date" class="form-label">Employed Date</label>
            <input type="month" name="employment_date" class="form-control" id="employment_date" value="{{ $employment->employment_date ?? '' }}" />
        </div>
    </div>
</div>