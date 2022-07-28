@extends('layout.app')


@section('navbar')
    <x-navbar/>
@endsection

@section('slidenavbar')
    <x-slide-nav-bar/>
@endsection

@section('content')
    @if ($mode == "entry")
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
                    "name" => "Create Lesson",
                    "route" => route('create.lesson', ['course' => $course, "section_id" => $section_id]),
                    "active" => true
                ],
            ]
        @endphp
    @else
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
                    "name" => "Edit Lesson",
                    "route" => route('edit.lesson', ['course' => $course, "lesson" => $lesson]),
                    "active" => true
                ],
            ]
        @endphp
    @endif
    

    <x-breadcrumb :navigations="$navigations" />

    <x-page-heading>
        @if ($mode == "entry")
            Create Lesson
        @else
            Edit Lesson
        @endif
    </x-page-heading>
    
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('status') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <x-confirm-delete></x-confirm-delete>

    <x-form-container>

        <form action="@if ($mode == "entry")
                        {{ route('store.lesson', ['course' => $course, "section_id" => $section_id]) }}
                      @elseif ($mode == "edit")
                        {{ route('update.lesson', ['course' => $course, "lesson" => $lesson]) }}
                      @endif" method="POST" enctype="multipart/form-data" id="course_editor">
            @csrf
            <div class="col-12 mb-5 row">
                <div class="col-12 col-sm-3">
                    <label for="lesson_name" class="form-label">Lesson Name</label>
                </div>
                <div class="col-12 col-sm-9">
                    <input type="text" 
                    @if($mode == "edit") value="{{ $lesson->lesson_name }}" @endif 
                    class="form-control" id="lesson_name" name="lesson_name">
                </div>
            </div>

            @if ($mode == "edit")
                <div class="col-12 row">
                    <label for="page_select" class="mb-3">Select the page to be updated</label>
                    <select class="form-select mb-5" aria-label="Default select example" id="page_select" onchange="show_edit_lesson(this)">
                        @php
                            $page = 0;
                        @endphp
                        @if ($lesson->lesson_contents->count())
                            @foreach ($lesson->lesson_contents as $index=>$lesson_content)
                                <option value="{{ $lesson_content->id }}">{{ ++$page }}</option>
                            @endforeach
                        @else
                            <option selected disabled>There is no page</option>
                        @endif
                    </select>
                </div>
            @endif

            <div class="col-12 mb-4 row" id="page_container">
                    <h4 class="mb-4" id="page_number">Pages</h4>
                    @if ($mode == "entry")
                        <textarea class="summernote" name="editor_text_1"></textarea>
                    @elseif ($mode == "edit")
                        @if ($lesson->lesson_contents->count())

                            {{-- edit page is a little diffrent from entry page because it contains select box to choose the page --}}
                            @foreach ($lesson->lesson_contents as $index=>$lesson_content)
                            <div class="@if($index != 0) d-none @endif lesson_container" id={{ "lesson_".$lesson_content->id."_container" }}>
                                {{-- @if ($mode == "delete") --}}
                                    <div class="d-flex justify-content-end mb-3">
                                        <button id={{ "delete_".$lesson_content->id }} class="btn btn-danger" 
                                            value="{{ $lesson_content->id }}" onclick="delete_content(this)"
                                            data-bs-toggle="modal" data-bs-target="#confirm_delete_modal" type="button">
                                            {{ "delete page ".(++$index) }}
                                        </button>
                                    </div>
                                {{-- @endif --}}
                                <textarea class="summernote" id={{ "editor_text_".$lesson_content->id }} 
                                    name={{ "editor_text_".$lesson_content->id }}>{{ $lesson_content->content }}</textarea>
                            </div>
                            @endforeach
                        @endif
                    @else
                    <div class="alert alert-warning" role="alert">
                        There is no page right now!
                    </div>
                @endif
            </div>
            <div class="col-12 mb-4 row">
                <div class="d-flex justify-content-end py-3 create_btn" id="create_btn">
                    <button type="submit" class="btn btn-success">
                        @if ($mode == "entry")
                            Create
                        @elseif ($mode == "edit")
                            Update
                        @endif
                    </button>
                </div>
            </div>
        </form>
        @if ($mode == "entry")
            <div class="d-flex justify-content-end">
                <button class="btn btn-outline-primary d-flex align-items-center" onclick="add_page(this)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                    </svg>
                    Add Page
                </button>
            </div>
        @endif
    </x-form-container>

    {{-- <li>
        <div class="badge bg-primary text-white">
            {{ auth()->user()->username }}
        </div>
        <div>
            ${message}
        </div>
    </li> --}}
    
@endsection

@section('script')
    <script>
        // function to add a page
        function add_page(ele) {
            // get the nodes to be copied
            let text_editor = document.querySelectorAll('.summernote');
            let note_editor = document.querySelectorAll('.note-editor.note-frame');

            // clone the nodes
            let clone_text_editor = text_editor[text_editor.length - 1].cloneNode(true);
            let clone_note_editor = note_editor[note_editor.length - 1].cloneNode(true);
            
            // clean the text content of the new created note
            clone_text_editor.textContent = "";
            // get the name of the new created note
            let splitted_name = clone_text_editor.name.split('_');
            // set the new name of the new created note
            clone_text_editor.name = `editor_text_${Number(splitted_name[splitted_name.length - 1]) + 1}`;
            // get the page container
            let page_container = document.querySelector('#page_container');
            // let create_btn = document.querySelector('#create_btn');
            page_container.appendChild(clone_text_editor);
            // load summernote function again
            load_summernote();
        }

        // function to show the page to be edited when select the page name
        function show_edit_lesson(ele) {
            // unhide the page container
            console.log(ele);
            document.querySelector('#page_container').classList.remove('d-none');
            let lesson_containers = document.querySelectorAll('.lesson_container');
            lesson_containers.forEach(lesson_container => {
                lesson_container.classList.add('d-none');
                if (lesson_container.id == `lesson_${ele.value}_container`) {
                    lesson_container.classList.remove('d-none');
                }
            });
            // unhide the update btn
            document.querySelector('#create_btn').classList.remove('d-none');
        }

        // to del content id
        let to_del_content_id = null;

        
        function delete_content(ele) {
            to_del_content_id = ele.value;
            // set the add event listener to the delete content modal
            document.querySelector('#confirm_delete').addEventListener('click', delete_content_fn, false);
        }

        // function to delete the content
        async function delete_content_fn() {
            let page_select = document.querySelector('#page_select');
            let page_select_childs = document.querySelector('#page_select').children;
            for (let i = 0; i < page_select_childs.length; i++) {
                if (page_select_childs[i].value == to_del_content_id) {
                    if (page_select.children.length <= 1) {
                        page_select.removeChild(page_select_childs[i]);
                        show_edit_lesson(0);
                        document.querySelector('#page_container').removeChild(
                            document.querySelector(`#lesson_${to_del_content_id}_container`));
                    } else {
                        // console.log(page_select.firstChild);
                        page_select.removeChild(page_select_childs[i]);
                        show_edit_lesson(page_select.children[0]);
                        document.querySelector('#page_container').removeChild(
                            document.querySelector(`#lesson_${to_del_content_id}_container`));
                    }
                }
            }
            // delete inside the database
            let req_data = {content_id: to_del_content_id};
            let response = await fetch("{{ route('destroy.lesson') }}", {
                method: "POST",
                body: JSON.stringify(req_data),
                headers: {
                    'Content-Type' : 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // remove the previous event listener form the modal 
            document.querySelector('#confirm_delete').removeEventListener('click', delete_content_fn, false);
        }

    </script>
@endsection