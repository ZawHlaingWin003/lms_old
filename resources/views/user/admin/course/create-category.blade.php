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
                "active" => false
            ],
            [
                "name" => "Course Category",
                "route" => route('get.courseCategory'),
                "active" => false
            ],
            [
                "name" => "Create Course Category",
                "route" => route('create.courseCategory'),
                "active" => true
            ],
        ]
    @endphp

    <x-breadcrumb :navigations="$navigations" />

    <x-page-heading>
        Create Course Category
    </x-page-heading>
    
    <x-form-container>
        <form action="{{ route('submit.courseCategory') }}" method="POST">
            @csrf
            <div class="col-12 mb-4 row">
                <div class="col-12 col-sm-3">
                    <label for="category_name" class="form-label">Category Name</label>
                </div>
                <div class="col-12 col-sm-9">
                    <input type="text" class="form-control" id="category_name" name="category_name">
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <input type="submit" class="btn btn-primary" value="Create">
            </div>
        </form>
    </x-form-container>
    
@endsection