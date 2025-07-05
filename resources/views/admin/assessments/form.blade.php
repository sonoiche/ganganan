<div class="row">
    <div class="col-12">
        <div class="mb-4">
            <label for="name" class="form-label">Assessment Title</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $assessment->name ?? '' }}" />
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="items" class="form-label">Items Count</label>
            <input type="number" name="items" class="form-control" id="items" value="{{ $assessment->items ?? '' }}" />
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="passing_grade" class="form-label">Passing Grade</label>
            <input type="number" name="passing_grade" class="form-control" id="passing_grade" value="{{ $assessment->passing_grade ?? '' }}" />
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="mb-4">
            <label for="name" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="">Select Status</option>
                <option value="Published" {{ (isset($assessment->status) && $assessment->status == 'Published') ? 'selected' : '' }}>Published</option>
                <option value="Draft" {{ (isset($assessment->status) && $assessment->status == 'Draft') ? 'selected' : '' }}>Draft</option>
            </select>
        </div>
    </div>
</div>