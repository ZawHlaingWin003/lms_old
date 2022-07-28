<div class="trueflase_answer_paper mt-5">
    <div class="trueflase_header_div">
        <h3 class="trueflase_header">True / False</h3>
    </div>
    @foreach ($trueFalses as $key => $trueFalse)
        <div class="card truefalse_card">
            <div class="truefalepra_no">
                <p class="me-3">{{ ++$key }} .</p>
                <p>
                    {!! $trueFalse->question !!}
                </p>
            </div>
            <div class="choice_true_false ms-4">
                <input type="hidden" name="trueFalse[trueFalse_{{ $key }}][question_id]" value="{{$trueFalse->id}}">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="trueFalse[trueFalse_{{ $key }}][student_answer]"
                        id="{{ $key }}_true" value="True">
                    <label class="form-check-label" for="{{ $key }}_true">
                        True
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="trueFalse[trueFalse_{{ $key }}][student_answer]"
                        id="{{ $key }}_false" value="False">
                    <label class="form-check-label" for="{{ $key }}_false">
                        False
                    </label>
                </div>
            </div>
        </div>
    @endforeach
</div>
