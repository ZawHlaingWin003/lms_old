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
            'active' => true,
        ],
    ];
    @endphp

    <x-breadcrumb :navigations="$navigations" />

    <x-page-heading>
        {{ $course->course_name }}
    </x-page-heading>

    <x-page-heading>
        {{ $exam->exam_name }}
    </x-page-heading>



    @if (auth()->user()->role_id == 3)

        <div class="card student_exam_card">
            <div class="student_exam_card_des">
                <h3 class="text-muted">Assignment Question</h3>
                <p>
                    {{ $exam->description }}
                </p>
            </div>
            <div class="student_exam_card_times mt-4 text-center">
                <p>Attempts</p>
                <p>This exam/ quiz/ tutorial will close on : {{ $exam->end_full_date }}</p>
                <p>Time Limit: {{ $exam->duration }} minutes</p>
            </div>
            <div class="student_exam_card_times_table">
                <table class="table table-striped mt-3">
                    <thead>
                        <tr class="text-center">
                            <th>State</th>
                            <th>Marks/30.00</th>
                            <th>Grade/100.00</th>
                            <th>review</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>
                                Finished Submitted at
                                {{ $exam->start_full_date }}
                            </td>
                            <td> - </td>
                            <td> - </td>
                            <td class="">
                                <a href="" class="text-danger" style="text-decoration: none;">review</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-3">
                <h5>Your final grade for this exam /quiz /tutorial is 73.33/100.00 .</h5>
            </div>
            <div class="to_button mt-5 text-center">
                <a href="{{route('answerpaper.exam', [$course, $exam])}}" class="btn btn-primary" style="padding: 0.7rem 1rem;">Attempt</a>
            </div>
        </div>
    @else
        <div class="">
            <div class="card border-0">
                <h3 class="pt-3 px-3 fw-bold text-main bg-white"> {{ $course->course_name }} : {{ $exam->exam_name }}</h3>
                <div class="container">
                    <hr style="color: black;">
                </div>
                <div class="px-3">
                    <h3 class="text-muted">Assignment Question</h3>
                    {{ $exam->description }}
                </div>
                <div class="text-center mt-5">
                    <p style="background-color: #F2F2F2;" class="py-3">
                        Open Exam
                        <span class="ms-5">
                            {{ $exam->start_full_date }}
                        </span>
                    </p>
                    <p>
                        Close Exam
                        <span class="ms-5">
                            {{ $exam->end_full_date }}
                        </span>
                    </p>
                    <p style="padding-right: 99px ;background-color: #F2F2F2;" class="py-3">Time Limit <span
                            class="ms-5">{{ $exam->duration }} minutes</span></span></p>
                    <p style="padding-right: 180px;">Attempts Allowed <span class="ms-5">1 Day</span></p>
                </div>
                <div class="text-center" style="margin-top: 50px; margin-bottom:50px;">
                    <a href="{{ route('chooseQuestionType.exam', ['course' => $course, 'exam' => $exam]) }}"
                        class="btn btn-primary me-2" style="padding:0.5rem 1.2rem;background-color:#035397;">Add
                        Questions</a>
                    <a href="" class="btn btn-primary ms-2"
                        style="padding:0.5rem 1.2rem;background-color:#035397;">Grade Exam</a>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('script')
    <script></script>
@endsection
