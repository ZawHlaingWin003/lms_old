@extends('layout.app')

@section('navbar')
    <x-navbar></x-navbar>
@endsection

@section('slidenavbar')
    <x-slide-nav-bar></x-slide-nav-bar>
@endsection

@section('content')
    <x-page-heading>
        Adding A New Forum
    </x-page-heading>

    @php
        $authUser = auth()->user()->role->role_name
    @endphp

    <div class="forum p-0">
        {{-- Teacher To Stuedent --}}
        <div class="teacher_to_student">
            {{-- Mainpost --}}
            <div class="card forum_card">
                <div class="profile_img_name_position">
                    <img class="profile_img" src="/img/profile.jpg" alt="" width="70px">
                    <div class="name_and_position">
                        <h6 class="profile_name">{{ $authUser }}</h6>
                        <p class="position">Teacher</p>
                    </div>
                </div>
                <div class="description">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium commodi, voluptatibus quod et
                        iusto
                        optio facere? Rem sunt quos iusto atque libero at, quae distinctio! Quisquam corrupti vero mollitia
                        officia. Accusantium commodi, voluptatibus quod et iusto
                        optio facere? Rem sunt quos iusto atque libero at, quae distinctio! Quisquam corrupti vero mollitia
                        officia.
                    </p>
                </div>
                <div class="action_button row mt-3">
                    <div class="col-md-6 left"></div>
                    <div class="col-md-6 text-center right">
                        <a href="">Edit</a>
                        <a href="">Delete</a>
                        <a href="">Reply</a>
                    </div>
                </div>
            </div>
            {{-- Oneline Reply --}}
            <div class="oneline_reply row">
                <div class="col-md-1 col-sm-1"></div>
                <div class="col-md-11 col-sm-11 card">
                    <div class="profile_img_name_position">
                        <img class="profile_img" src="/img/profile.jpg" alt="" width="70px">
                        <div class="name_and_position">
                            <h6 class="profile_name">{{ $authUser }}</h6>
                            <p class="position">Student</p>
                        </div>
                    </div>
                    <div class="description">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium commodi, voluptatibus quod
                            et iusto
                            optio facere? Rem sunt quos iusto atque libero at, quae distinctio! Quisquam corrupti vero
                            mollitia
                            officia.
                        </p>
                    </div>
                    <div class="action_button row mt-3">
                        <div class="col-md-6 left"></div>
                        <div class="col-md-6 text-center right">
                            <a href="">Edit</a>
                            <a href="">Delete</a>
                            <a href="">Reply</a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Secondline --}}
            <div class="oneline_reply row">
                <div class="col-md-2 col-sm-2"></div>
                <div class="col-md-10 col-sm-10 card">
                    <div class="profile_img_name_position">
                        <img class="profile_img" src="/img/profile.jpg" alt="" width="70px">
                        <div class="name_and_position">
                            <h6 class="profile_name">{{ $authUser }}</h6>
                            <p class="position">Teacher</p>
                        </div>
                    </div>
                    <div class="description">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium commodi, voluptatibus quod
                            et iusto
                            optio facere? Rem sunt quos iusto atque libero at, quae distinctio! Quisquam corrupti vero
                            mollitia
                            officia.
                        </p>
                    </div>
                    <div class="action_button row mt-3">
                        <div class="col-md-6 left"></div>
                        <div class="col-md-6 text-center right">
                            <a href="">Edit</a>
                            <a href="">Delete</a>
                            <a href="">Reply</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--Student To Teacher --}}
        <div class="student_to_teacher">
            {{-- Mainpost --}}
            <div class="card forum_card">
                <div class="profile_img_name_position">
                    <img class="profile_img" src="/img/profile.jpg" alt="" width="70px">
                    <div class="name_and_position">
                        <h6 class="profile_name">{{ $authUser }}</h6>
                        <p class="position">Teacher</p>
                    </div>
                </div>
                <div class="description">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium commodi, voluptatibus quod et
                        iusto
                        optio facere? Rem sunt quos iusto atque libero at, quae distinctio! Quisquam corrupti vero mollitia
                        officia. Accusantium commodi, voluptatibus quod et iusto
                        optio facere? Rem sunt quos iusto atque libero at, quae distinctio! Quisquam corrupti vero mollitia
                        officia.
                    </p>
                </div>
                <div class="action_button row mt-3">
                    <div class="col-md-6 left"></div>
                    <div class="col-md-6 text-center right">
                        <a href="">Edit</a>
                        <a href="">Delete</a>
                        <a href="">Reply</a>
                    </div>
                </div>
            </div>
            {{-- Oneline Reply --}}
            <div class="oneline_reply row">
                <div class="col-md-1 col-sm-1"></div>
                <div class="col-md-11 col-sm-11 card mb-5">
                    <div class="profile_img_name_position">
                        <img class="profile_img" src="/img/profile.jpg" alt="" width="70px">
                        <div class="name_and_position">
                            <h6 class="profile_name">{{ $authUser }}</h6>
                            <p class="position">Student</p>
                        </div>
                    </div>
                    <div class="description">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium commodi, voluptatibus quod
                            user_name
                            user_name
                            user_name   et iusto
                            optio facere? Rem sunt quos iusto atque libero at, quae distinctio! Quisquam corrupti vero
                            mollitia
                            officia.
                        </p>
                    </div>
                    <div class="action_button row mt-3">
                        <div class="col-md-6 left"></div>
                        <div class="col-md-6 text-center right">
                            <a href="">Edit</a>
                            <a href="">Delete</a>
                            <a href="">Reply</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection