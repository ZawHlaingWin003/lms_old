@extends('layout.app')


@section('navbar')
    <x-navbar />
@endsection

@section('slidenavbar')
    <x-slide-nav-bar />
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
    <div class="edding_exam_top_div bg-white">
        <div class="left">
            <h3 class="left_text">Editting Exam</h3>
        </div>
        <div class="right">
            <label for="grade" class="">Maximum Grade</label>
            <input type="text" id="grade" >
            <button class="btn fw-bold">Save</button>
        </div>
    </div>
    <div class="container p-0">
        {{-- Editting Modal Start --}}
        <div class="modal fade " id="edittingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h3 style="color: #035397" class="fw-bold p-3">Questions</h3>
                        <div class="row">
                            <div class="left col-md-12" style="">
                                <div class="left_div">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <a href="{{ route('create.trueFalse', ['course' => $course, 'exam' => $exam]) }}">True / False</a>
                                </div>
                                <div class="left_div">
                                    <i class="fa-solid fa-bars-staggered"></i>
                                    <a href="{{ route('create.multipleChoice', ['course' => $course, 'exam' => $exam]) }}">Multiple
                                        Choice</a>
                                </div>
                                <div class="left_div">
                                    <i class="fa-solid fa-bars"></i>
                                    <a href="">Fill In The Blank</a>
                                </div>
                                <div class="left_div">
                                    <i class="fa-solid fa-file-lines"></i>
                                    <a href="{{ route('create.shortQuestion', ['course' => $course, 'exam' => $exam]) }}">Short
                                        Question</a>
                                </div>
                                <div class="left_div">
                                    <i class="fa-solid fa-file-contract"></i>
                                    <a href="{{ route('create.essay', ['course' => $course, 'exam' => $exam]) }}">Essay</a>
                                </div>
                                <div class="left_div">
                                    <i class="fa-solid fa-bars-progress"></i>
                                    <a href="">Matching</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Editing Modal End --}}
        <div class="button_and_questionAnswer">

            <div class="question_add_btn_div text-end">
                <button type="button" class="btn btn-primary px-3 py-2 mt-3 mb-5" data-bs-toggle="modal"
                    data-bs-target="#edittingModal" style="background-color: #035397;">
                    Add
                </button>
            </div>

            @if (count($multipleChoices))
                <x-multiple-choice :course="$course" :exam="$exam" :multipleChoices="$multipleChoices"></x-multiple-choice>
            @endif

            @if (count($trueFalses))
                <x-true-false :course="$course" :exam="$exam" :trueFalses="$trueFalses"></x-true-false>
            @endif

            @if (count($shortQuestions))
                <x-short-question :course="$course" :exam="$exam" :shortQuestions="$shortQuestions"></x-short-question>
            @endif

            @if (count($essays))
                <x-essay :course="$course" :exam="$exam" :essays="$essays"></x-essay>
            @endif
        </div>
    </div>
@endsection
