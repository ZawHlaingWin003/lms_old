<div class="short_answerpaper_part mt-5">
    <div class="short_answer_header_div">
        <h3 class="short_answer_header">
            Short Answer Question
        </h3>
    </div>
    @foreach ($shortQuestions as $key => $shortQuestion)
        <div class="card shortanswer_card">
            <div class="shortanswer_pnadno">
                <p class="me-3">{{ ++$key }}.</p>
                <p>{!! $shortQuestion->question !!}</p>
            </div>
            <div class="form-group ms-4">
                <input type="hidden" name="shortQuestion[shortQuestion_{{ $key }}][question_id]" value="{{$shortQuestion->id}}">
                <textarea name="shortQuestion[shortQuestion_{{$key}}][student_answer]" id="{{$key}}_shortQuestion" rows="2" class="form-control"></textarea>
            </div>

        </div>
    @endforeach

</div>
