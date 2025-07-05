<div class="row">
    <div class="col-12">
        <div class="mb-4">
            <label for="question" class="form-label">Question</label>
            <input type="text" name="question" class="form-control" id="question" value="{{ $question->question ?? '' }}" />
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="option-1" class="form-label">Option 1</label>
            <input type="text" name="options[]" class="form-control" id="option-1" value="{{ $question->single_option[0] ?? '' }}" />
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="option-2" class="form-label">Option 2</label>
            <input type="text" name="options[]" class="form-control" id="option-2" value="{{ $question->single_option[1] ?? '' }}" />
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="option-3" class="form-label">Option 3</label>
            <input type="text" name="options[]" class="form-control" id="option-3" value="{{ $question->single_option[2] ?? '' }}" />
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-4">
            <label for="option-4" class="form-label">Option 4</label>
            <input type="text" name="options[]" class="form-control" id="option-4" value="{{ $question->single_option[3] ?? '' }}" />
        </div>
    </div>
    <div class="col-12">
        <div class="mb-4">
            <label for="answer" class="form-label">Correct Answer</label>
            <select name="answer" id="answer" class="form-select">
                <option value="A" {{ (isset($question->answer) && $question->answer == 'A') ? 'selected' : '' }}>Option 1</option>
                <option value="B" {{ (isset($question->answer) && $question->answer == 'B') ? 'selected' : '' }}>Option 2</option>
                <option value="C" {{ (isset($question->answer) && $question->answer == 'C') ? 'selected' : '' }}>Option 3</option>
                <option value="D" {{ (isset($question->answer) && $question->answer == 'D') ? 'selected' : '' }}>Option 4</option>
            </select>
        </div>
    </div>
</div>