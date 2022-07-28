<div class="long_answerpaper_part mt-5">
    <div class="longanswer_header_div">
        <h3 class="longanswer_header">Long Answer Question</h3>
    </div>

    @foreach ($essays as $key => $essay)
        <div class="card longanswer_card">
            <div class="longanswer_pnadno">
                <p class="me-3">{{ ++$key }}.</p>
                <p>{!! $essay->question !!}</p>
            </div>
            <div class="form-group ms-4">
                <input type="hidden" name="essay[essay_{{$key}}][question_id]" value="{{$essay->id}}">
                <textarea name="essay[essay_{{$key}}][student_answer]" id="{{$key}}_essay" rows="2" class="summernote"></textarea>
            </div>
        </div>
    @endforeach

</div>
