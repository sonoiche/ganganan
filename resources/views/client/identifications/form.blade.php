<div class="row">
    <div class="col-6">
        <div class="mb-4">
            <label for="identification_type" class="form-label">Identification Type</label>
            <input type="text" name="identification_type" class="form-control" id="identification_type" value="{{ $identification->identification_type ?? '' }}" />
        </div>
    </div>
    <div class="col-6">
        <div class="mb-4">
            <label for="file" class="form-label">File</label>
            <input type="file" name="file" class="form-control" id="file" />
        </div>
    </div>
</div>