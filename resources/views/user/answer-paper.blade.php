@extends('layout.app')

@section('navbar')
    <x-navbar></x-navbar>
@endsection

@section('slidenavbar')
    <x-slide-nav-bar></x-slide-nav-bar>
@endsection

@section('content')
    @php
    $navigations = [
        [
            'name' => 'Dashboard',
            'route' => route('dashboard'),
            'active' => false,
        ],
        [
            'name' => $course->course_name,
            'route' => route('show.course', $course->id),
            'active' => false,
        ],
        [
            'name' => $exam->exam_name,
            'route' => route('show.exam', ['course' => $course, 'exam' => $exam]),
            'active' => false,
        ],
        [
            'name' => 'Add Questions',
            'route' => route('chooseQuestionType.exam', ['course' => $course, 'exam' => $exam]),
            'active' => true,
        ],
    ];
    @endphp

    <x-breadcrumb :navigations="$navigations" />
    <div class="amt row mb-3">
        <div class="col-md-6"></div>
        <div class="amt_div col-md-6">
            <ul class="amt_ul">
                <li><a href="">Attendance</a></li>
                <li><a href="">My Progress</a></li>
                <li><a href="">Time Table</a></li>
            </ul>
        </div>
    </div>
    <x-page-heading>
        Financial Accounting
    </x-page-heading>

    <x-page-heading>
        Exam / Quiz / Tutorial (2 /jun /2022)
    </x-page-heading>

    <x-page-heading>
        <p class="m-0 fs-4 fw-bold text-main">
            Time Remaining <i class="fa-solid fa-angles-right"></i>
            <span class="minute me-2">{{ $exam->duration }}</span>:<span class="second ms-2">00</span>
        </p>
    </x-page-heading>

    {{-- {{dd($multipleChoices)}} --}}

    <form action="{{route('store.answer',[$course, $exam])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (count($multipleChoices))
            <x-answer_paper.multiple-choice :course="$course" :exam="$exam" :multipleChoices="$multipleChoices"></x-answer_paper.multiple-choice>
        @endif

        @if (count($trueFalses))
            <x-answer_paper.true-false :course="$course" :exam="$exam" :trueFalses="$trueFalses"></x-answer_paper.true-false>
        @endif

        @if (count($shortQuestions))
            <x-answer_paper.short-question :course="$course" :exam="$exam" :shortQuestions="$shortQuestions"></x-answer_paper.short-question>
        @endif

        @if (count($essays))
            <x-answer_paper.essay :course="$course" :exam="$exam" :essays="$essays"></x-answer_paper.essay>
        @endif

        <x-answer_paper.docs-image-video></x-answer_paper.docs-image-video>


        <div class="timer_and_button card mt-5 p-5 d-flex flex-row justify-content-between align-items-center">
            <div class="timer_minutes">
                <p class="m-0 fs-4 fw-bold text-main">
                    Time Remaining <i class="fa-solid fa-angles-right"></i>
                    <span class="minute me-2">{{ $exam->duration }}</span>:<span class="second ms-2">00</span>
                </p>
            </div>
            <div class="finish_attempt">
                <button type="submit" class="btn btn-primary main-btn" id="finish_btn">Finish Attempt</button>
            </div>
        </div>
        
    </form>


    {{-- Time out Modal Start --}}
    <div class="modal fade" id="timeoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h1> Congratulations....</h1>
                    <div>
                        <p class="text-center text-danger">
                            Exam time is full.
                        </p>
                        <p class="text-center text-danger">
                            Your answer sheet has been collected.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Time out modal end --}}

    <script>

        // const preventBrower = function(event) {
        //     event.returnValue = "Write something clever here..";
        // }
        // window.addEventListener("beforeunload", preventBrower);

        // $('#finish_btn').on('click', function(){
        //     window.removeEventListener("beforeunload", preventBrower);
        // })

        // document.addEventListener('contextmenu', event => event.preventDefault());

        $(document).ready(function() {
            function dec_min() {
                var finish = document.getElementById('finish');
                minute = parseInt($('.minute').html());
                if (minute != 0) {
                    $('.minute').html(minute - 1);
                    $('.second').html(59);
                } else {
                    $('.minute').html('Time out');
                    $('.second').html('');
                    finish.click();
                    $('#timeoutModal').modal('show');
                }
            }
            var update = function() {
                $('.second').each(function() {
                    var count = parseInt($(this).html());
                    if (count != 0) {
                        $(this).html(count - 1);
                    } else {
                        dec_min();
                    }
                });
            };
            setInterval(update, 1000)
        })

    </script>
@endsection
