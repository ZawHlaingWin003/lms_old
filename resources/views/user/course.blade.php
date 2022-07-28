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
                "active" => true
            ]
        ]
    @endphp

    <x-breadcrumb :navigations="$navigations" />

    <x-page-heading>
        {{ $course->course_name }}
    </x-page-heading>

    {{-- create course section modal --}}
    <div class="modal fade" id="create_section_modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <strong>Create Course Section</strong>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4 row">
                        <div class="col-12">
                            <label for="section_name" class="form-label">Enter section name</label>
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" id="section_name" name="section_name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="add_section()">Create Section</button>
                </div>
            </div>
        </div>
    </div>

    {{-- update course section model --}}
    <div class="modal fade" id="edit_section_modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <strong>Edit Course Section</strong>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4 row">
                        <div class="col-12">
                            <label for="updated_section_name" class="form-label">Update section name</label>
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" id="updated_section_name" name="section_name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="confirm_update">Updae Section</button>
                </div>
            </div>
        </div>
    </div>

    {{-- confirm delete model --}}
    <div class="modal fade" id="confirm_delete_modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <strong>Delete</strong>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4 row">
                        <div class="col-12">
                            <p>Are you sure to delete this section?</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="confirm_delete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- section modules model --}}
    <div class="modal fade" id="section_modules_modal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <strong>Course Modules</strong>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group list-group-flush">
                        <a href="" action="GET" id="create_zoom" class="list-group-item list-group-item-action category_item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-camera-video-fill me-3 text-primary" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 4.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 13H2a2 2 0 0 1-2-2V5z"/>
                            </svg>
                            Zoom Meeting
                        </a>
                        <a href="" action="GET" id="create_lesson" class="list-group-item list-group-item-action category_item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-file-earmark-text-fill me-3 text-orange" viewBox="0 0 16 16">
                                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1h-4z"/>
                            </svg>
                            Lesson
                        </a>
                        <a href="" action="GET" id="create_exam" class="list-group-item list-group-item-action category_item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" class="bi bi-file-earmark-text-fill me-3 text-success" viewBox="0 0 576 512" fill="currentColor"><path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V299.6L289.3 394.3C281.1 402.5 275.3 412.8 272.5 424.1L257.4 484.2C255.1 493.6 255.7 503.2 258.8 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256zM564.1 250.1C579.8 265.7 579.8 291 564.1 306.7L534.7 336.1L463.8 265.1L493.2 235.7C508.8 220.1 534.1 220.1 549.8 235.7L564.1 250.1zM311.9 416.1L441.1 287.8L512.1 358.7L382.9 487.9C378.8 492 373.6 494.9 368 496.3L307.9 511.4C302.4 512.7 296.7 511.1 292.7 507.2C288.7 503.2 287.1 497.4 288.5 491.1L303.5 431.8C304.9 426.2 307.8 421.1 311.9 416.1V416.1z"/></svg>
                            Exam
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="course_container w-100">
        @if (auth()->user()->isAdmin())
            {{-- course setting section --}}
            <div class="d-flex justify-content-end mb-3" id="course_setting">
                <div class="dropdown">
                    <button class="btn bg-white" data-bs-auto-close="outside"  onclick="check_state()" type="button" id="course_setting" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="text-dark-blue" viewBox="0 0 512 512">
                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - 
                                https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M495.9 166.6C499.2 175.2 496.4 184.9 489.6 191.2L446.3 230.6C447.4 238.9 448 247.4 448 
                                256C448 264.6 447.4 273.1 446.3 281.4L489.6 320.8C496.4 327.1 499.2 336.8 495.9 345.4C491.5 357.3 
                                486.2 368.8 480.2 379.7L475.5 387.8C468.9 398.8 461.5 409.2 453.4 419.1C447.4 426.2 437.7 428.7 
                                428.9 425.9L373.2 408.1C359.8 418.4 344.1 427 329.2 433.6L316.7 490.7C314.7 499.7 307.7 506.1 
                                298.5 508.5C284.7 510.8 270.5 512 255.1 512C241.5 512 227.3 510.8 213.5 508.5C204.3 506.1 197.3 
                                499.7 195.3 490.7L182.8 433.6C167 427 152.2 418.4 138.8 408.1L83.14 425.9C74.3 428.7 64.55 426.2 
                                58.63 419.1C50.52 409.2 43.12 398.8 36.52 387.8L31.84 379.7C25.77 368.8 20.49 357.3 16.06 345.4C12.82 
                                336.8 15.55 327.1 22.41 320.8L65.67 281.4C64.57 273.1 64 264.6 64 256C64 247.4 64.57 238.9 65.67 
                                230.6L22.41 191.2C15.55 184.9 12.82 175.3 16.06 166.6C20.49 154.7 25.78 143.2 31.84 132.3L36.51 
                                124.2C43.12 113.2 50.52 102.8 58.63 92.95C64.55 85.8 74.3 83.32 83.14 86.14L138.8 103.9C152.2 
                                93.56 167 84.96 182.8 78.43L195.3 21.33C197.3 12.25 204.3 5.04 213.5 3.51C227.3 1.201 241.5 0 
                                256 0C270.5 0 284.7 1.201 298.5 3.51C307.7 5.04 314.7 12.25 316.7 21.33L329.2 78.43C344.1 84.96 
                                359.8 93.56 373.2 103.9L428.9 86.14C437.7 83.32 447.4 85.8 453.4 92.95C461.5 102.8 468.9 113.2 475.5 124.2L480.2 
                                132.3C486.2 143.2 491.5 154.7 495.9 166.6V166.6zM256 336C300.2 336 336 300.2 336 
                                255.1C336 211.8 300.2 175.1 256 175.1C211.8 175.1 176 211.8 176 255.1C176 300.2 211.8 336 256 336z"/>
                        </svg>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="course_setting">
                        <li>
                            <a class="dropdown-item" href="{{ route('edit.course', $course) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" 
                                        class="text-dark-blue me-3" viewBox="0 0 512 512">
                                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - 
                                        https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                        <path d="M495.9 166.6C499.2 175.2 496.4 184.9 489.6 191.2L446.3 230.6C447.4 238.9 448 247.4 448 
                                        256C448 264.6 447.4 273.1 446.3 281.4L489.6 320.8C496.4 327.1 499.2 336.8 495.9 345.4C491.5 357.3 
                                        486.2 368.8 480.2 379.7L475.5 387.8C468.9 398.8 461.5 409.2 453.4 419.1C447.4 426.2 437.7 428.7 
                                        428.9 425.9L373.2 408.1C359.8 418.4 344.1 427 329.2 433.6L316.7 490.7C314.7 499.7 307.7 506.1 
                                        298.5 508.5C284.7 510.8 270.5 512 255.1 512C241.5 512 227.3 510.8 213.5 508.5C204.3 506.1 197.3 
                                        499.7 195.3 490.7L182.8 433.6C167 427 152.2 418.4 138.8 408.1L83.14 425.9C74.3 428.7 64.55 426.2 
                                        58.63 419.1C50.52 409.2 43.12 398.8 36.52 387.8L31.84 379.7C25.77 368.8 20.49 357.3 16.06 345.4C12.82 
                                        336.8 15.55 327.1 22.41 320.8L65.67 281.4C64.57 273.1 64 264.6 64 256C64 247.4 64.57 238.9 65.67 
                                        230.6L22.41 191.2C15.55 184.9 12.82 175.3 16.06 166.6C20.49 154.7 25.78 143.2 31.84 132.3L36.51 
                                        124.2C43.12 113.2 50.52 102.8 58.63 92.95C64.55 85.8 74.3 83.32 83.14 86.14L138.8 103.9C152.2 
                                        93.56 167 84.96 182.8 78.43L195.3 21.33C197.3 12.25 204.3 5.04 213.5 3.51C227.3 1.201 241.5 0 
                                        256 0C270.5 0 284.7 1.201 298.5 3.51C307.7 5.04 314.7 12.25 316.7 21.33L329.2 78.43C344.1 84.96 
                                        359.8 93.56 373.2 103.9L428.9 86.14C437.7 83.32 447.4 85.8 453.4 92.95C461.5 102.8 468.9 113.2 475.5 124.2L480.2 
                                        132.3C486.2 143.2 491.5 154.7 495.9 166.6V166.6zM256 336C300.2 336 336 300.2 336 
                                        255.1C336 211.8 300.2 175.1 256 175.1C211.8 175.1 176 211.8 176 255.1C176 300.2 211.8 336 256 336z"/>
                                </svg>
                                Edit Course Setting
                            </a>
                        </li>
                        <li class="dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-fill me-3 text-dark-blue" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                                <input class="form-check-input visually-hidden" id="course_edit" type="checkbox" onchange="edit_mode()">
                                <label class="form-check-label w-100" for="course_edit" id="course_edit_label"  style="cursor: pointer;">
                                    Edit mode on
                                </label>
                        </li>
                    </ul>
                </div>
            </div>
        @endif

        {{-- course contents --}}
        <div id="sections_container">
            @if ($course->course_sections->count())
                @foreach ($course->course_sections as $section)
                    <div class="mb-5 section_container" id="{{ "section_".$section->id."_container" }}">

                        {{-- section name --}}
                        <div class="section_name rounded bg-white p-3 d-flex align-items-center mb-3 justify-content-between">
                            <div class="d-flex align-items-center">
                                <p class="mb-0 me-2 fs-4 fw-bold text-main" id="{{ "section_".$section->id."_name" }}">{{ $section->section_name }}</p>
                            {{-- <div  class="edit_btns d-none jusify-content-between bg-danger"> --}}
                                <button class="btn btn-sm btn-white edit_btns d-none text-dark-blue" onclick="update_section(this)" value="{{ $section->id }}" data-bs-toggle="modal" data-bs-target="#edit_section_modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                    </svg>
                                </button>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-white edit_btns d-none" onclick="delete_section(this)" value="{{ $section->id }}" data-bs-toggle="modal" data-bs-target="#confirm_delete_modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-trash-fill text-danger" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </button>
                            </div>
                            {{-- </div> --}}
                        </div>
                        {{-- section modules --}}
                        <ul class="list-group list-group-flush section_modules" id="{{ "section_".$section->id."_modules" }}">
                            {{-- loop zoom meetings of a section --}}
                            @if ($section->zoom_meetings->count())
                                @foreach ($section->zoom_meetings as $zoom_meeting)
                                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="{{ "zoom_".$zoom_meeting->id."_container" }}">
                                        <a href="{{ route('show.zoom', ['course' => $course, 'zoom' => $zoom_meeting]) }}" action="GET" class="d-block d-flex justify-content-between align-items-center p-2 category_item section_module_items stretched-link text-decoration-none text-dark">
                                            <div class="fs-6">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-camera-video-fill me-3 text-primary" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 4.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 13H2a2 2 0 0 1-2-2V5z"/>
                                                </svg>
                                                {{ $zoom_meeting->topic }}
                                            </div>
                                        </a>
                                        <div class="d-none edit_module_btns_container">
                                            <a href="{{ route('edit.zoom', ['course' => $course, 'zoom' => $zoom_meeting]) }}" class="btn fs-4 edit_module_btn text-success">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <button class="btn fs-4 text-danger" onclick="delete_zoom({{ $zoom_meeting->id }}, this)" value="{{ $zoom_meeting }}" data-bs-toggle="modal" data-bs-target="#confirm_delete_modal">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                            {{-- loop lessons of a section --}}
                            @if ($section->lessons->count())
                                @foreach ($section->lessons as $lesson)
                                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" 
                                            id="{{ "lesson_".$lesson->id."_container" }}">
                                    <a href="{{ route('show.lesson', ['course' => $course, 'lesson' => $lesson]) }}" action="GET" 
                                        class="d-block d-flex justify-content-between align-items-center p-2
                                        category_item section_module_items stretched-link text-decoration-none text-dark">
                                        <div class="fs-6">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-file-earmark-text-fill me-3 text-orange" viewBox="0 0 16 16">
                                                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1h-4z"/>
                                            </svg>
                                            {{ $lesson->lesson_name }}
                                        </div>
                                    </a>
                                    <div class="d-none edit_module_btns_container">
                                        <a href="{{ route('edit.lesson', ['course' => $course, 'lesson' => $lesson]) }}" class="btn fs-4 edit_module_btn text-success">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn fs-4 text-danger" onclick="delete_lesson({{ $lesson->id }})" data-bs-toggle="modal" data-bs-target="#confirm_delete_modal">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </li>
                                @endforeach
                            @endif
                            {{-- loop exams of a section --}}
                            @if ($section->exams->count())
                                @foreach ($section->exams as $exam)
                                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" 
                                            id="{{ "exam_".$exam->id."_container" }}">
                                    {{-- <a href="{{ route('show.exam', ['course' => $course, 'exam' => $exam]) }}" action="GET" 
                                        class="d-block d-flex justify-content-between align-items-center p-2
                                        category_item section_module_items stretched-link text-decoration-none text-dark"> --}}
                                    <a href="{{ route('show.exam', ['course' => $course, 'exam' => $exam]) }}" action="GET" class="d-block d-flex justify-content-between align-items-center p-2
                                    category_item section_module_items stretched-link text-decoration-none text-dark">
                                        <div class="fs-6">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" class="bi bi-file-earmark-text-fill me-3 text-success" viewBox="0 0 576 512" fill="currentColor"><path d="M0 64C0 28.65 28.65 0 64 0H224V128C224 145.7 238.3 160 256 160H384V299.6L289.3 394.3C281.1 402.5 275.3 412.8 272.5 424.1L257.4 484.2C255.1 493.6 255.7 503.2 258.8 512H64C28.65 512 0 483.3 0 448V64zM256 128V0L384 128H256zM564.1 250.1C579.8 265.7 579.8 291 564.1 306.7L534.7 336.1L463.8 265.1L493.2 235.7C508.8 220.1 534.1 220.1 549.8 235.7L564.1 250.1zM311.9 416.1L441.1 287.8L512.1 358.7L382.9 487.9C378.8 492 373.6 494.9 368 496.3L307.9 511.4C302.4 512.7 296.7 511.1 292.7 507.2C288.7 503.2 287.1 497.4 288.5 491.1L303.5 431.8C304.9 426.2 307.8 421.1 311.9 416.1V416.1z"/></svg>
                                            {{ $exam->exam_name }}
                                        </div>
                                    </a>
                                    <div class="d-none edit_module_btns_container">
                                        {{-- <a href="{{ route('edit.exam', ['course' => $course, 'exam' => $exam]) }}" class="btn btn-sm btn-success edit_module_btn">Edit</a> --}}
                                        <a href="{{ route('edit.exam', ['course' => $course, 'exam' => $exam]) }}" class="btn fs-4 edit_module_btn text-success">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        
                                        <form action="{{ route('delete.exam', ['exam' => $exam]) }}" class="d-inline" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            
                                            <button class="btn fs-4 text-danger" id="exam-delete-confirm">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                                @endforeach
                            @endif
                        </ul>
        
                        {{-- add module button --}}
                        <div class="d-none d-flex justify-content-end p-3 add_module_btn">
                            <button class="btn bg-white text-dark-blue text-decoration-underline px-4 py-2"  onclick="add_modules_create_route(this)" value="{{ $section->id }}" data-bs-toggle="modal" data-bs-target="#section_modules_modal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg me-3" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                </svg>
                                Add module
                            </button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        {{-- add course section button --}}
        <div class="d-none d-flex justify-content-end py-3 add_section_btn">
            <button class="btn bg-white text-dark-blue text-decoration-underline px-4 py-2" data-bs-toggle="modal" data-bs-target="#create_section_modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg me-3" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                </svg>
                Add course section
            </button>
        </div>
    </div>
@endsection

@section('script')
    <script>

$(document).ready(()=>{

    const examDeleteBtns = document.querySelectorAll("#exam-delete-confirm");
    for (let btn of examDeleteBtns)
    {
        btn.addEventListener('click', function(e){
            e.preventDefault();
            var form =  $(this).closest("form");

            Swal.fire({
                title: 'Are you sure?',
                text: "ဒီစာမေးပွဲကို ဖျက်မှာသေချာပြီလား။",
                icon: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    }

});

        // this function is to check the exception case because after checked, went to other page, and it will still checked 
        // withoud showing being an edit mode.
        function check_state() {
            if (document.querySelector('#course_edit').checked && 
                document.querySelector('.add_section_btn').classList.contains('d-none')) {

                document.querySelector('#course_edit').checked = false;
                document.querySelector('#course_edit').innerHTML = "Turn on edit mode";
            }
        }

        // send ajax to store the new course section
        async function CUD_section(mode, section_name, this_ele) {
            let url = null; // url for destination, change according to the mode
            let req_data = null // json to store requests
            // for storing the new section
            if (mode == "store") {
                req_data = {
                                course_id : "{{ $course->id }}",
                                section_name
                            }
                url = "{{ route('store.courseSection') }}";
            } 
            // to update the existing section
            else if(mode == "update") {
                req_data = {
                                course_id : "{{ $course->id }}",
                                section_id : this_ele.value,
                                section_name
                            }
                url = "{{ route('update.courseSection') }}";

                // remove the previous event listener form the modal 
                document.querySelector('#confirm_update').removeEventListener('click', update_section_fn, false);
            }
            // to delete the existing section
            else if(mode == "delete") {
                console.log("delete");
                req_data = {
                                course_id : "{{ $course->id }}",
                                section_id : this_ele.value
                            }
                url = "{{ route('destroy.courseSection') }}";

                // remove the previous event listener form the modal 
                document.querySelector('#confirm_delete').removeEventListener('click', delete_section_fn, false);
            }

            // send req to the specified url
            let response = await fetch(url, {
                method: "POST",
                body: JSON.stringify(req_data),
                headers: {
                    'Content-Type' : 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if (mode == "store") {
                return await response.json();
            }
        }

        // add a new course section
        async function add_section(ele) {
            // section name
            let section_name = document.querySelector('#section_name').value;

            // send ajax to store the new course section
            let new_section = await CUD_section("store", section_name, ele);

            // create new section element and insert into the section container
            document.querySelector('#sections_container').innerHTML += get_section_ele(new_section);
        }

        // section update button element
        let update_btn = null;

        // section delete button element
        let delete_btn = null;

        // zoom id to delete
        let to_del_zoom_id = null;

        // lesson id to delete
        let to_del_lesson_id = null;

        // update section function 
        function update_section_fn() {
            let updated_section_name = document.querySelector('#updated_section_name').value;

            // send ajax to update the new course section
            CUD_section("update", updated_section_name, update_btn);

            // update the new section heading
            document.querySelector(`#section_${update_btn.value}_name`).innerHTML = updated_section_name;
        }

        // delete section function 
        function delete_section_fn() {
            // send ajax to delete the new course section
            CUD_section("delete", null, delete_btn);

            // remove the deleted element from the DOM
            document.querySelector(`#section_${delete_btn.value}_container`).remove();
        }

        // update the specified section
        async function update_section(element) {
            update_btn = element;
            // add the pervious section's section name to the udpate section modal
            document.querySelector('#updated_section_name').value = document.querySelector(`#section_${update_btn.value}_name`).innerHTML;
            // set the add event listener to the update section modal
            document.querySelector('#confirm_update').addEventListener('click', update_section_fn, false);
        }

        // delete the specified section
        function delete_section(ele) {
            delete_btn = ele;
            // set the add event listener to the delete section modal
            document.querySelector('#confirm_delete').addEventListener('click', delete_section_fn, false);
        }

        //  delete the specified zoom callback funtion
        async function delete_zoom_fn() {
            // remove the deleted zoom module form the DOM
            document.querySelector(`#zoom_${to_del_zoom_id}_container`).remove();

            req_data = { zoom_id : to_del_zoom_id,
                         course_id : "{{ $course->id }}" };
            url = "{{ route('destroy.zoom') }}";

                // send req to the specified url
            let response = await fetch(url, {
                method: "POST",
                body: JSON.stringify(req_data),
                headers: {
                    'Content-Type' : 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // remove the previous event listener form the modal 
            document.querySelector('#confirm_delete').removeEventListener('click', delete_section_fn, false);
        }

        // delete the specified zoom
        function delete_zoom(zoom_id) {
            to_del_zoom_id = zoom_id;

            // set the add event listener to the delete zoom modal
            document.querySelector('#confirm_delete').addEventListener('click', delete_zoom_fn, false);
        }

        // function to delete the specified lesson
        async function delete_lesson_fn() {
            // remove the deleted zoom module form the DOM
            document.querySelector(`#lesson_${to_del_lesson_id}_container`).remove();

            req_data = { lesson_id : to_del_lesson_id,
                         course_id : "{{ $course->id }}" };
            url = "{{ route('destroy.lesson') }}";

                // send req to the specified url
            let response = await fetch(url, {
                method: "POST",
                body: JSON.stringify(req_data),
                headers: {
                    'Content-Type' : 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // remove the previous event listener form the modal 
            document.querySelector('#confirm_delete').removeEventListener('click', delete_lesson_fn, false);
        }

        // delete the specified lesson 
        function delete_lesson(lesson_id) {
            to_del_lesson_id = lesson_id;
            // set the add event listener to the delete zoom modal
            document.querySelector('#confirm_delete').addEventListener('click', delete_lesson_fn, false);
        }

        // turn on edit mode
        function edit_mode() {
            let edit_btns = document.querySelectorAll('.edit_btns');
            let add_section_btn = document.querySelector('.add_section_btn');
            let add_module_btns = document.querySelectorAll('.add_module_btn');
            let edit_module_btns_containers = document.querySelectorAll('.edit_module_btns_container');
            let section_module_items = document.querySelectorAll('.section_module_items');
            let edit_module_btns = document.querySelectorAll('.edit_module_btn');
            let course_edit_label = document.querySelector('#course_edit_label');
            let course_edit_check = document.querySelector('#course_edit');

            if(course_edit_check.checked) {
                course_edit_label.textContent = 'Turn off edit mode';
            } else {
                course_edit_label.textContent = 'Turn on edit mode';
            }

            add_section_btn.classList.toggle('d-none');
            add_module_btns.forEach(add_module_btn => {
                add_module_btn.classList.toggle('d-none');
            })
            edit_btns.forEach(edit_btn => {
                edit_btn.classList.toggle('d-none');
            });
            edit_module_btns_containers.forEach(edit_module_btns_container => {
                edit_module_btns_container.classList.toggle('d-none');
            });
            section_module_items.forEach(section_module_item => {
                section_module_item.classList.toggle('stretched-link');
                section_module_item.classList.toggle('text-decoration-none');
            });
        }

        // add section id into the new module creation routes
        function add_modules_create_route(ele) {
            let create_zoom_url = "{{ route('create.zoom', ['course' => $course, 'section_id' => ':section_id']) }}";
            create_zoom_url = create_zoom_url.replace(':section_id', ele.value);
            document.querySelector('#create_zoom').href = create_zoom_url;

            let create_lesson_url = "{{ route('create.lesson', ['course' => $course, 'section_id' => ':section_id']) }}";
            create_lesson_url = create_lesson_url.replace(':section_id', ele.value);
            document.querySelector('#create_lesson').href = create_lesson_url;

            let create_exam_url = "{{ route('create.exam', ['course' => $course, 'section_id' => ':section_id']) }}";
            create_exam_url = create_exam_url.replace(':section_id', ele.value);
            document.querySelector('#create_exam').href = create_exam_url;
        }

        // return a section element
        function get_section_ele(section) {
            return `
            <div class="mb-5 section_container"  id="section_${section['id']}_container">

                {{-- section name --}}
                <div class="section_name rounded bg-white p-3 d-flex align-items-center mb-3 justify-content-between">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 me-2 fs-4 fw-bold text-blue" id="section_${section['id']}_name">${section['section_name']}</p>
                        <button class="btn btn-sm btn-white edit_btns text-dark-blue" onclick="update_section(this)" value="${section['id']}" data-bs-toggle="modal" data-bs-target="#edit_section_modal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                            </svg>
                        </button>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-white edit_btns" onclick="delete_section(this)" value="${section['id']}" data-bs-toggle="modal" data-bs-target="#confirm_delete_modal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-trash-fill text-danger" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- section modules --}}
                <ul class="list-group list-group-flush section_modules">
                    
                </ul>

                {{-- add module button --}}
                <div class="d-flex justify-content-end p-3 add_module_btn">
                    <button class="btn bg-white text-dark-blue text-decoration-underline px-4 py-2"  onclick="add_modules_create_route(this)" value="${section['id']}" data-bs-toggle="modal" data-bs-target="#section_modules_modal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                        </svg>
                        Add module
                    </button>
                </div>
            </div>
            `;
            
        }

    </script>
@endsection