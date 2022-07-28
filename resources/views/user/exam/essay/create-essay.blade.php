

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
            "name" => $exam->exam_name,
            "route" => route('show.exam', ['course' => $course, 'exam' => $exam]),
            "active" => false,
        ],
        [
            "name" => 'Add Questions',
            "route" => route('chooseQuestionType.exam', ['course' => $course, 'exam' => $exam]),
            "active" => false,
        ],
        [
            "name" => $mode == 'entry' ? 'Create Essay Question' : 'Edit Essay Question',
            "route" => $mode == 'entry' ? route('create.essay', ['course' => $course, 'exam' => $exam]) : route('edit.essay', ['course', $course, 'exam' => $exam, 'essay' => $essay]),
            "active" => true
        ]
    ];
    @endphp

    <x-breadcrumb :navigations="$navigations" />

    <x-page-heading>
        {{ $mode == 'entry' ? 'Create Essay Question' : 'Edit Essay Question' }}
    </x-page-heading>


    <div class="container bg-white p-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ $mode == 'entry' ? route('store.essay', ['course' => $course, 'exam' => $exam]) : route('update.essay', ['course' => $course, 'exam' => $exam, 'essay' => $essay]) }}" method="POST">
                    @csrf

                    @if ($mode == 'edit')
                        @method('PUT')
                    @endif

                    <div class="mb-4 row">
                        <label for="question" class="col-sm-2 col-form-label">Question</label>
                        <div class="col-sm-10">
                            <textarea class="summernote" id="question" name="question">@if($mode == 'edit') {{ $essay->question }} @endif</textarea>
                            @error('question')
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

