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
                    "name" => "Create Zoom Meeting",
                    "route" => route('create.zoom', ['course' => $course, 'section_id' => $section_id]),
                    "active" => true
                ],
            ]
        @endphp
    @elseif ($mode == "edit")
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
                    "name" => "Edit Zoom Meeting",
                    "route" => route('edit.zoom', ['course' => $course, 'zoom' => $zoom]),
                    "active" => true
                ],
            ]
        @endphp
    @endif

    <x-breadcrumb :navigations="$navigations" />

    <x-page-heading>
        Create Zoom Meeting
    </x-page-heading>
    
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('status') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <x-form-container>
        <fieldset>
            <form action="@if ($mode == "entry")
                                {{ route('store.zoom', ['course' => $course, "section_id" => $section_id]) }}
                            @else
                                {{ route('update.zoom', ['course' => $course, "zoom" => $zoom]) }}
                            @endif" method="POST">
                @csrf
                <div class="col-12 mb-4 row">
                    <div class="col-12 col-sm-3">
                        <label for="topic" class="form-label">Topic</label>
                    </div>
                    <div class="col-12 col-sm-9">
                        <input type="text" 
                        @if($mode == "edit") value="{{ $zoom->topic }}" @endif 
                        class="form-control" id="topic" name="topic">
                    </div>
                </div>
                <div class="col-12 mb-4 row">
                    <div class="col-12 col-sm-3">
                        <label for="agenda" class="form-label">Agenda</label>
                    </div>
                    <div class="col-12 col-sm-9">
                        <input type="text" 
                        @if($mode == "edit") value="{{ $zoom->agenda }}" @endif 
                        class="form-control" id="agenda" name="agenda">
                    </div>
                </div>
                <div class="col-12 mb-4 row">
                    <div class="col-12 col-sm-3">
                        <label for="start_time" class="form-label">Start Time</label>
                    </div>
                    <div class="col-12 col-sm-5">
                        <input type="datetime-local" 
                        @if($mode == "edit") value="{{date('Y-m-d\TH:i:s', strtotime($zoom->start_time))}}" @endif 
                        class="form-control" id="start_time" name="start_time">
                    </div>
                </div>
                <div class="col-12 mb-4 row">
                    <div class="col-12 col-sm-3">
                        <label for="description" class="form-label">Description</label>
                    </div>
                    <div class="col-12 col-sm-9">
                        <textarea name="description" class="form-control" id="description" cols="20" rows="5">@if($mode == "edit") {{ $zoom->description }}@endif</textarea>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <input type="submit" class="btn btn-primary"
                        @if($mode == "edit") value="Update" @else  value="Create" @endif>
                </div>
            </form>
        </fieldset>
    </x-form-container>
    
@endsection