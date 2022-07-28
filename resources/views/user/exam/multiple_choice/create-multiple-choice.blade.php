@extends('layout.app')


@section('navbar')
    <x-navbar/>
@endsection

@section('slidenavbar')
    <x-slide-nav-bar/>
@endsection

@section('content')
    @php
        $navigations = [
            [
                "name" => "Dashboard",
                "route" => route('dashboard'),
                "active" => false
            ],
            [
                "name" => $course->course_name,
                "route" => route('show.course', $course->id),
                "active" => false
            ],
            [
                "name" => $exam->exam_name,
                "route" => route('show.exam', ['course' => $course, 'exam' => $exam]),
                "active" => false
            ],
            [
                "name" => 'Add Questions',
                "route" => route('chooseQuestionType.exam', ['course' => $course, 'exam' => $exam]),
                "active" => false,
            ],
            [
                "name" => $mode == 'entry' ? 'Add Multiple Choice' : 'Edit Multiple Choice',
                "route" => $mode == 'entry' ? route('create.multipleChoice', ['course' => $course, 'exam' => $exam]) : route('edit.multipleChoice', ['course', $course, 'exam' => $exam, 'multipleChoice' => $multipleChoice]),
                "active" => true
            ],
        ]
    @endphp

    <x-breadcrumb :navigations="$navigations" />

    <x-page-heading>
        {{ $mode == 'entry' ? 'Add Multiple Choice' : 'Edit Multiple Choice' }}
    </x-page-heading>

    <div class="container bg-white p-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ $mode == 'entry' ? route('store.multipleChoice', ['course' => $course, 'exam' => $exam]) : route('update.multipleChoice', ['course' => $course, 'exam' => $exam, 'multipleChoice' => $multipleChoice]) }}" method="POST">
                    @csrf
                    @if ($mode == 'edit')
                        @method('PUT')
                    @endif

                    <div class="mb-4 row">
                        <label for="question" class="col-sm-2 col-form-label">Question</label>
                        <div class="col-sm-10">
                            <textarea class="summernote" id="question" name="question">@if($mode == 'edit') {{ $multipleChoice->question }} @endif</textarea>
                            @error('question')
                                <p class="text-danger"><small>* {{ $message }}</small></p>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="choice_1" class="col-sm-2 col-form-label">Choice 1</label>
                        <div class="col-sm-10">
                            <textarea name="choice_1" id="choice_1" class="form-control">@if($mode == 'edit'){{ $multipleChoice->choice_1 }}@endif</textarea>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="choice_2" class="col-sm-2 col-form-label">Choice 2</label>
                        <div class="col-sm-10">
                            <textarea name="choice_2" id="choice_2" class="form-control">@if($mode == 'edit'){{ $multipleChoice->choice_2 }}@endif</textarea>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="choice_3" class="col-sm-2 col-form-label">Choice 3</label>
                        <div class="col-sm-10">
                            <textarea name="choice_3" id="choice_3" class="form-control">@if($mode == 'edit'){{ $multipleChoice->choice_3 }}@endif</textarea>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="choice_4" class="col-sm-2 col-form-label">Choice 4</label>
                        <div class="col-sm-10">
                            <textarea name="choice_4" id="choice_4" class="form-control">@if($mode == 'edit'){{ $multipleChoice->choice_4 }}@endif</textarea>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="answer" class="col-sm-2 col-form-label">Answer</label>
                        <div class="col-sm-10">
                            @if ($mode == 'entry')
                            <select class="form-select @error('answer') is-invalid @enderror" name="answer">
                                <option selected disabled>-- Choose correct answer --</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            @else
                            <select class="form-select @error('answer') is-invalid @enderror" name="answer">
                                <option selected disabled>-- Choose correct answer --</option>
                                <option value="1" {{ $multipleChoice->answer == 1 ? 'selected' : '' }}>1</option>
                                <option value="2" {{ $multipleChoice->answer == 2 ? 'selected' : '' }}>2</option>
                                <option value="3" {{ $multipleChoice->answer == 3 ? 'selected' : '' }}>3</option>
                                <option value="4" {{ $multipleChoice->answer == 4 ? 'selected' : '' }}>4</option>
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

@section('script')
    <script>

    </script>
@endsection
