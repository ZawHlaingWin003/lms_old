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
                "name" => $mode == 'entry' ? 'Create Exam' : 'Edit Exam',
                "route" => $mode == 'entry' ? route('create.exam', ['course' => $course, 'section_id' => $section_id]) : route('edit.exam', ['course', $course, 'exam' => $exam]),
                "active" => true
            ],
        ]
    @endphp

    <x-breadcrumb :navigations="$navigations" />

    <x-page-heading>
        {{ $mode == 'entry' ? 'Create Exam' : 'Edit Exam' }}
    </x-page-heading>
    
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('status') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    

    {{-- choose question type model --}}
    <div class="modal fade" id="question_type_modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <strong>Delete</strong>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group list-group-flush">
                        <a href="" action="GET" id="create_zoom" class="list-group-item list-group-item-action category_item">
                            Ture / False
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <x-confirm-delete></x-confirm-delete>

    <x-form-container>
        <form action="{{ $mode == 'entry' ? route('store.exam',  ['course' => $course, 'section_id' => $section_id]) : route('update.exam', ['course' => $course, 'exam' => $exam]) }}" method="POST">
            @csrf
            @if ($mode == 'edit')
                @method('PUT')
            @endif
            <div class="col-12 mb-5 row">
                <div class="col-12 col-sm-3">
                    <label for="exam_name" class="form-label">Exam Name</label>
                </div>
                <div class="col-12 col-sm-9">
                    <input type="text" @if($mode == 'edit') value="{{ $exam->exam_name }}" @endif class="form-control" id="exam_name" name="exam_name">
                </div>
            </div>

            <div class="col-12 mb-4 row">
                <div class="col-12 col-sm-3">
                    <label for="start_date_time" class="form-label">Start Date and Time</label>
                </div>
                <div class="col-12 col-sm-5">
                    <input type="datetime-local" @if($mode == 'edit') value="{{ $exam->start_date_time }}" @endif class="form-control" id="start_date_time" name="start_date_time">
                </div>
            </div>

            <div class="col-12 mb-4 row">
                <div class="col-12 col-sm-3">
                    <label for="end_date_time" class="form-label">End Date and Time</label>
                </div>
                <div class="col-12 col-sm-5">
                    <input type="datetime-local" @if($mode == 'edit') value="{{ $exam->end_date_time }}" @endif class="form-control" id="end_date_time" name="end_date_time">
                </div>
            </div>

            <div class="col-12 mb-4 row">
                <div class="col-12 col-sm-3">
                    <label for="duration" class="form-label">Exam Duration (minutes)</label>
                </div>
                <div class="col-12 col-sm-5">
                    <input type="number" @if($mode == 'edit') value="{{ $exam->duration }}" @endif class="form-control" id="duration" name="duration"> 
                </div>
            </div>

            <div class="col-12 mb-4 row">
                <div class="col-12 col-sm-3">
                    <label for="description" class="form-label">Description</label>
                </div>
                <div class="col-12 col-sm-9">
                    <textarea name="description" class="form-control" id="description" cols="20" rows="5">{{ $mode == 'entry' ? '' : $exam->description }}</textarea>
                </div>
            </div>

            <div class="col-12 mb-4 row">
                <div class="col-12 col-sm-3">
                    <label for="description" class="form-label">Max Number of Uploaded File</label>
                </div>
                <div class="col-12 col-sm-2 d-flex alin-items-center gap-2">
                    <input type="number" name="max_total_file" id="max_total_file" class="form-control">
                    <span class="align-self-center invisible">MB</span>
                </div>
            </div>

            <div class="col-12 mb-4 row">
                <div class="col-12 col-sm-3">
                    <label for="description" class="form-label">Max Submission Size</label>
                </div>
                <div class="col-12 col-sm-2 d-flex alin-items-center gap-2">
                    <input type="number" name="max_file_size" id="max_file_size" class="form-control">
                    <span class="align-self-center">MB</span>
                </div>
            </div>

            <div class="col-12 mb-4 row">
                <div class="col-12 col-sm-3">
                    <label for="description" class="form-label">Accepted File Types</label>
                </div>
                <div class="col-12 col-sm-9">
                    <input type="text" name="accept_file_type" id="accept_file_type" class="form-control">
                </div>
            </div>

            <div class="col-12 d-flex justify-content-end">
                <input type="submit" class="btn btn-primary"
                    @if($mode == "edit") value="Update" @else  value="Create" @endif>
            </div>
            
        </form>
    </x-form-container>
    
@endsection

@section('script')
    <script>

    </script>
@endsection