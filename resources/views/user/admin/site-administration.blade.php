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
                "name" => "Site Administration",
                "route" => route('admin.siteAdministration'),
                "active" => true
            ],
        ]
    @endphp

    <x-breadcrumb :navigations="$navigations" />

    <p class="h2 mb-5 fw-bold">
        Site Administration
    </p>
    
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-user-tab" data-bs-toggle="tab" data-bs-target="#nav-user" type="button" role="tab" aria-controls="nav-home" aria-selected="true">User</button>
          <button class="nav-link" id="nav-course-tab" data-bs-toggle="tab" data-bs-target="#nav-course" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Course</button>
          <button class="nav-link" id="nav-grade-tab" data-bs-toggle="tab" data-bs-target="#nav-grade" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Grade</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-user" role="tabpanel" aria-labelledby="nav-user-tab">
            
            <div class="row text-center p-5 gap-3">
                <div class="col-12">
                    <a href="{{ route('register') }}" class="fs-5">
                        Add a new user
                    </a>
                </div>
                <div class="col-12">
                    <a href="{{ route('showAllUser') }}"  class="fs-5">
                        Browse all users
                    </a>
                </div>
            </div>

        </div>
        <div class="tab-pane fade" id="nav-course" role="tabpanel" aria-labelledby="nav-course-tab">
            
            <div class="row text-center p-5 gap-3">
                <div class="col-12">
                    <a href="{{ route("get.courseCategory") }}" class="fs-5">
                        Course category
                    </a>
                </div>
                <div class="col-12">
                    <a href="{{ route('create.course') }}"  class="fs-5">
                        Create Course
                    </a>
                </div>
                <div class="col-12">
                    <a href="" class="fs-5">
                        Manage Course
                    </a>
                </div>
                <div class="col-12">
                    <a href=""  class="fs-5">
                        Restore Course
                    </a>
                </div>
            </div>

        </div>
        <div class="tab-pane fade" id="nav-grade" role="tabpanel" aria-labelledby="nav-grade-tab">

            Grade

        </div>
    </div>  
@endsection