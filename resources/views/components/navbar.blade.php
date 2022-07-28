<div class="container-fluid nav-container shadow-sm">
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-2 bg-white">
        <div class="container-fluid d-flex align-items-center nav-items">
            <div class="d-flex flex-row gap-2 align-items-center">
                @auth
                    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#slide_nav_bar" aria-controls="slide_nav_bar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                @endauth
                <a class="navbar-brand school_logo_container" href="#">
                    <img class="school_logo" src="{{ url('/img/motc-logo.png') }}" alt="logo">
                </a>
                <div>
                    <p class="h6 mb-0 fw-bold text-blue">UNIVERSITY OF CO-OPERATIVE AND MANAGEMENT, SAGAING</p>
                    <p class="mb-0">Learning Management System</p>
                </div>
            </div>
            <div class="d-flex flex-row gap-2 align-items-center">
                <p class="mb-0 text-center fs-6 me-3">
                    <span id="date"></span><br>
                    <span id="time"></span>
                </p>
                @auth
                    <div class="message-icon btn"  data-bs-toggle="offcanvas" data-bs-target="#msgslide_nav_bar" aria-controls="msgslide_nav_bar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat-fill text-secondary" viewBox="0 0 16 16">
                        <path d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9.06 9.06 0 0 0 8 15z"/>
                        </svg>
                    </div>
                    <div class="noti-icon mx-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bell-fill text-secondary" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                        </svg>
                    </div>
                    <p class="mb-0 mx-2">
                        {{ auth()->user()->username }}
                    </p>
                    <div class="profile_container">
                        <button class="btn bg-white p-0" data-bs-auto-close="outside" type="button" id="profile" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="profile rounded-circle"
                            {{-- src="@if(auth()->user()->isAdmin())
                                {{ url('storage/images/profiles/admins/faculty_profile.jpg') }}
                            @elseif(auth()->user()->isTeacher())
                                {{ url('storage/images/profiles/admins/instructor_profile.jpg') }}
                            @elseif(auth()->user()->isStudent())
                                {{ url('storage/images/profiles/admins/student_profile.jpg') }}
                            @endif" --}}
                            src="{{ asset('img/profile.jpg') }}"
                            alt="logo">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end px-4" aria-labelledby="profile">
                            <form action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <input type="submit" class="dropdown-item" value="Logout">
                            </form>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
</div>

