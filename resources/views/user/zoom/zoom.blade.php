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
                "name" => "Zoom Class",
                "route" => route('show.zoom', ['course' => $course, 'zoom' => $zoom]),
                "active" => true
            ],
        ]
    @endphp

    <x-breadcrumb :navigations="$navigations" />

    <x-page-heading>
        {{ Str::headline($zoom->topic) }}
    </x-page-heading>
    
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('status') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <x-form-container>

        <p class="mb-5">
            {{ $zoom->description }}
        </p>

            @php
                $datetime1 = new DateTime();
                $timestamp1 = $datetime1->getTimestamp();
                $datetime2 = new DateTime($zoom->start_time);
                $timestamp2 = $datetime2->getTimestamp();
                // $interval = $datetime1->diff($datetime2);
            @endphp
            {{-- {{ $interval->format("%Y-%m-%d %H:%i:%s") }} --}}
            {{-- {{ $timestamp1 - $timestamp2 }} --}}

        <div class="d-flex mb-5 justify-content-center">
            <a href="{{ route('enter', $zoom) }}" class="btn bg-light-green px-4 py-3">
                @if (auth()->user()->isStudent())
                    Join Class
                @else
                    Start Class                    
                @endif
            </a>
        </div>
        <div>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td class="text-end" style="width: 40%;">
                            Date Time
                        </td>
                        <td style="width: 60%;">
                            {{ $zoom->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-end" style="width: 40%;">
                            Duration
                        </td>
                        <td style="width: 60%;">
                            60 mins
                        </td>
                    </tr>
                    <tr>
                        <td class="text-end" style="width: 40%;">
                            Agenda
                        </td>
                        <td style="width: 60%;">
                            {{ $zoom->agenda }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-form-container>
    
@endsection