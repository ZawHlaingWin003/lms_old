<div class="multiple_answerpaper_part">
    <div class="multipleheader_div">
        <h3 class="multipleheader">
            Multiple Choice
        </h3>
    </div>
    @foreach ($multipleChoices as $key => $multipleChoice)
        <div class="card multiple_card">
            <div class="mulqu_para">
                <p class="me-3">{{ ++$key }}. </p>
                <p>{{ $multipleChoice->question }}</p>
            </div>
            <div class="choice_answer ms-4">
                <input type="hidden" name="multipleChoice[multipleChoice_{{ $key }}][question_id]" value="{{$multipleChoice->id}}">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="multipleChoice[multipleChoice_{{ $key }}][student_answer]"
                        id="{{ $key }}_choice_1" value="1">
                    <label class="form-check-label" for="{{ $key }}_choice_1">
                        {{ $multipleChoice->choice_1 }}
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="multipleChoice[multipleChoice_{{ $key }}][student_answer]"
                        id="{{ $key }}_choice_2" value="2">
                    <label class="form-check-label" for="{{ $key }}_choice_2">
                        {{ $multipleChoice->choice_2 }}
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="multipleChoice[multipleChoice_{{ $key }}][student_answer]"
                        id="{{ $key }}_choice_3" value="3">
                    <label class="form-check-label" for="{{ $key }}_choice_3">
                        {{ $multipleChoice->choice_3 }}
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="multipleChoice[multipleChoice_{{ $key }}][student_answer]"
                        id="{{ $key }}_choice_4" value="4">
                    <label class="form-check-label" for="{{ $key }}_choice_4">
                        {{ $multipleChoice->choice_4 }}
                    </label>
                </div>
            </div>
        </div>
    @endforeach
</div>
