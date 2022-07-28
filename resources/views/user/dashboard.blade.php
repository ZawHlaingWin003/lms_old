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
            "active" => true
        ]
    ]
    @endphp

    <x-breadcrumb :navigations="$navigations" />

    <div class="card mb-5 py-3">
        <div class="card-body d-flex align-items-center gap-5 px-5">
            <div class="profile-img">
                <img
                    {{-- src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" --}}
                    src="{{ asset('img/profile.jpg') }}"
                    alt="user-img"
                    class="rounded-circle"
                    width="150px"
                    height="150px"
                    
                />
            </div>
            <div class="biography">
                <h3 class="fw-bold text-main">{{ auth()->user()->name }}</h3>
                <p class="mb-0">{{ auth()->user()->description }}</p>
            </div>
        </div>
    </div>

    <x-page-heading>
        Courses
    </x-page-heading>

    <div class="course_card_container">
        @if ($courses->count())
            @foreach ($courses as $key => $course)
                <x-course-card :key="$key" :course="$course"></x-course-card>
            @endforeach
        @else
            <div class="alert alert-danger m-3 text-center" role="alert">
                There's no courses right now!
            </div>
        @endif
    </div>
@endsection