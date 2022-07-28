@props(['course', 'exam', 'multipleChoices'])

<div class="multiple_all">
    <div class="multipleheader_div">
        <h3 class="multipleheader p-3">
            Multiple Choice
        </h3>
    </div>
    <fieldset>
        @foreach ($multipleChoices as $key => $multipleChoice)
            <div class="card multiple_card">
                <div class="multiple_main row">
                    <div class="two_contain col-md-9">
                        <div class="mulqu_para">
                            <p class="left_p">{{ $loop->iteration }}. </p>
                            <p class="right_p">{!! $multipleChoice->question !!}</p>
                        </div>
                        <div class="choice_answer">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="choice_{{ $key }}"
                                    id="{{ $key }}_choice_1" @if ($multipleChoice->answer == 1) checked @endif
                                    disabled>
                                <label class="form-check-label" for="{{ $key }}_choice_1">
                                    {{ $multipleChoice->choice_1 }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="choice_{{ $key }}"
                                    id="{{ $key }}_choice_2" @if ($multipleChoice->answer == 2) checked @endif
                                    disabled>
                                <label class="form-check-label" for="{{ $key }}_choice_2">
                                    {{ $multipleChoice->choice_2 }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="choice_{{ $key }}"
                                    id="{{ $key }}_choice_3" @if ($multipleChoice->answer == 3) checked @endif
                                    disabled>
                                <label class="form-check-label" for="{{ $key }}_choice_3">
                                    {{ $multipleChoice->choice_3 }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="choice_{{ $key }}"
                                    id="{{ $key }}_choice_4" @if ($multipleChoice->answer == 4) checked @endif
                                    disabled>
                                <label class="form-check-label" for="{{ $key }}_choice_4">
                                    {{ $multipleChoice->choice_4 }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="action_buttons col-md-3 ">
                        <a type="button" href="{{ route('edit.multipleChoice', ['course' => $course, 'exam' => $exam, 'multipleChoice' => $multipleChoice]) }}" class="btn text-success fs-3 btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form class="d-inline" action="{{ route('delete.multipleChoice', ['multipleChoice' => $multipleChoice]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn text-danger fs-3 btn-sm" id="multiple-choice-delete-confirm"><i class="fa-regular fa-trash-can"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </fieldset>
</div>


