@props(['course', 'exam', 'shortQuestions'])


<div class="short_answer_all mt-5">
    <div class="short_answer_header_div">
        <h3 class="short_answer_header">
            Short Answer Question
        </h3>
    </div>
    
    @foreach ($shortQuestions as $shortQuestion)
        <div class="card shortanswer_card">
            <div class="row">
                <div class="shortanswer_pnadno col-md-9">
                    <p class="left_p">{{ $loop->iteration }}. </p>
                    <p class="right_p">{!! $shortQuestion->question !!}</p>
                </div>
                <div class="action_buttons col-md-3 ">
                    <a type="button" href="{{ route('edit.shortQuestion', ['course' => $course, 'exam' => $exam, 'shortQuestion' => $shortQuestion]) }}" class="btn text-success fs-3 btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                    <form class="d-inline" action="{{ route('delete.shortQuestion', $shortQuestion) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn text-danger fs-3 btn-sm" id="short-question-delete-confirm"><i class="fa-regular fa-trash-can"></i></button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
