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
                    "name" => "Site Administration",
                    "route" => route('admin.siteAdministration'),
                    "active" => false
                ],
                [
                    "name" => "Create Course",
                    "route" => route('create.course'),
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
                    "name" => "Edit Course",
                    "route" => route('edit.course', $course),
                    "active" => true
                ],
            ]
        @endphp
    @endif

    <x-breadcrumb :navigations="$navigations" />

    <x-page-heading>
        @if ($mode == "entry")
            Create Course
        @elseif($mode == "edit")
            Edit Course
        @endif
    </x-page-heading>
    
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('status') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <x-form-container>
        <fieldset>
            <form @if ($mode == "entry")
                        action="{{ route('submit.course') }}"
                    @elseif($mode == "edit")
                        action="{{ route('update.course', $course) }}"
                    @endif method="POST">
                @csrf
                <div class="col-12 mb-4 row">
                    <div class="col-12 col-sm-3">
                        <label for="category_name" class="form-label">Course Name</label>
                    </div>
                    <div class="col-12 col-sm-9">
                        <input type="text" @if($mode == "edit") value="{{ $course->course_name }}" @endif class="form-control" id="course_name" name="course_name">
                    </div>
                </div>
                <div class="col-12 mb-4 row">
                    <div class="col-12 col-sm-3">
                        <label for="course_category_id" class="form-label">Course Category</label>
                    </div>
                    <div class="col-12 col-sm-9">
                        <select name="course_category_id" class="form-select" id="course_category_id">
                            @if ($categories->count())
                                @foreach ($categories as $category)
                                    <option @if($mode == "edit") 
                                                @if($course->course_category->id == $category->id) selected @endif 
                                            @endif value="{{ $category->id }}">
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            @else
                                <option value="">No category found</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-12 mb-4 row">
                    <div class="col-12 col-sm-3">
                        <label for="visible" class="form-label">Course visibility</label>
                    </div>
                    <div class="col-12 col-sm-9">
                        <select name="visible" class="form-select" id="visible">
                            <option @if($mode == "edit") 
                                        @if($course->visible == "1") selected @endif 
                                    @endif value="1">Show</option>
                            <option @if($mode == "edit") 
                                        @if($course->visible == "0") selected @endif 
                                    @endif value="0">Hide</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 mb-4 row">
                    <div class="col-12 col-sm-3">
                        <label for="from_date" class="form-label">Course Start Date</label>
                    </div>
                    <div class="col-12 col-sm-5">
                        <input type="date" @if($mode == "edit") value="{{ $course->from_date }}" @endif class="form-control" id="from_date" name="from_date">
                    </div>
                </div>
                <div class="col-12 mb-4 row">
                    <div class="col-12 col-sm-3">
                        <label for="to_date" class="form-label">Course End Date</label>
                    </div>
                    <div class="col-12 col-sm-5">
                        <input type="date" @if($mode == "edit") value="{{ $course->to_date }}" @endif class="form-control" id="to_date" name="to_date">
                    </div>
                </div>
                <div class="col-12 mb-4 row">
                    <div class="col-12 col-sm-3">
                        <label for="course_id" class="form-label">Course ID</label>
                    </div>
                    <div class="col-12 col-sm-9">
                        <input type="text" @if($mode == "edit") value="{{ $course->course_id }}" @endif class="form-control" id="course_id" name="course_id">
                    </div>
                </div>
                <div class="col-12 mb-4 row">
                    <div class="col-12 col-sm-3">
                        <label for="description" class="form-label">Description</label>
                    </div>
                    <div class="col-12 col-sm-9">
                        <textarea name="description" class="form-control" id="description" cols="20" rows="5">@if($mode == "edit") {{ $course->description }}@endif</textarea>
                    </div>
                </div>
    
                <div class="col-12 d-flex justify-content-end">
                    <input type="submit" class="btn btn-primary" @if($mode == "edit") value="Update" @else  value="Create" @endif>
                </div>
            </form>
        </fieldset>
    </x-form-container>
    
@endsection