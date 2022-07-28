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
            'active' => false,
        ],
        [
            'name' => $mode == 'entry' ? 'Add TrueFalse' : 'Edit TrueFalse',
            'route' => $mode == 'entry' ? route('create.trueFalse', ['course' => $course, 'exam' => $exam]) : route('edit.trueFalse', ['course', $course, 'exam' => $exam, 'trueFalse' => $trueFalse]),
            'active' => true,
        ],
    ];
    @endphp

    <x-breadcrumb :navigations="$navigations" />

    <x-page-heading>
        {{ $mode == 'entry' ? 'Add True/False' : 'Edit True/False' }}
    </x-page-heading>


    <div class="container bg-white p-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ $mode == 'entry' ? route('store.trueFalse', ['course' => $course, 'exam' => $exam]) : route('update.trueFalse', ['course' => $course, 'exam' => $exam, 'trueFalse' => $trueFalse]) }}" method="POST">
                    @csrf

                    @if ($mode == 'edit')
                        @method('PUT')
                    @endif

                    <div class="mb-4 row">
                        <label for="question" class="col-sm-2 col-form-label">Question</label>
                        <div class="col-sm-10">
                            <textarea class="summernote" id="question" name="question">@if($mode == 'edit') {{ $trueFalse->question }} @endif</textarea>
                            @error('question')
                                <p class="text-danger"><small>* {{ $message }}</small></p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label for="answer" class="col-sm-2 col-form-label">Answer</label>
                        <div class="col-sm-10">
                            @if ($mode == 'entry')
                                <select class="form-select @error('answer') is-invalid @enderror" name="answer">
                                    <option selected disabled>-- Choose correct answer --</option>
                                    <option value="True">True</option>
                                    <option value="False">False</option>
                                </select>
                            @else
                                <select class="form-select @error('answer') is-invalid @enderror" name="answer">
                                    <option selected disabled>-- Choose correct answer --</option>
                                    <option value="True" {{ $trueFalse->answer == 'True' ? 'selected' : '' }}>True</option>
                                    <option value="False" {{ $trueFalse->answer == 'False' ? 'selected' : '' }}>False</option>
                                </select>
                            @endif
                            @error('answer')
                                <p class="text-danger"><small>* {{ $message }}</small></p>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary float-end mb-3">
                        {{ $mode == 'entry' ? 'Save' : 'Update' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
