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
            ]
        ]
    @endphp

    <x-breadcrumb :navigations="$navigations" />

    <x-page-heading>
        Summernote
    </x-page-heading>
    
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('status') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <x-form-container>

        <form action="{{ route('submit.test.summernote') }}" method="POST" enctype="multipart/form-data" id="course_editor">
            @csrf
            <textarea class="summernote" name="editor_text_1"></textarea>
            <div class="d-flex justify-content-end py-3 create_btn" id="create_btn">
                <button type="submit" class="btn btn-success">
                    Create
                </button>
            </div>
        </form>
        <div class="d-flex justify-content-end">
            <button class="btn btn-outline-primary d-flex align-items-center" onclick="add_page(this)">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                </svg>
                Add Page
            </button>
        </div>
    </x-form-container>
    
@endsection

@section('script')
    <script>

        // add new summernote to create new page
        let i = 1;
        function add_page(ele) {
            let text_editor = document.querySelector('.summernote');
            let note_editor = document.querySelector('.note-editor.note-frame');
            // console.log(note_editor);
            let clone_text_editor = text_editor.cloneNode(true);
            let clone_note_editor = note_editor.cloneNode(true);
            clone_text_editor.name = text_editor.name.replace('1', ++i);
            let course_editor = document.querySelector('#course_editor');
            let create_btn = document.querySelector('#create_btn');
            course_editor.insertBefore(clone_text_editor, create_btn);
            // load summernote function again
            load_summernote();
            // course_editor.insertBefore(clone_note_editor, create_btn);
            // console.log(clone_editor);
        }
    </script>
@endsection