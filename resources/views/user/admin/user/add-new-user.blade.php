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
                "name" => "All Users",
                "route" => route('showAllUser'),
                "active" => false
            ],
            [
                "name" => "Add A New User",
                "route" => route('register'),
                "active" => true
            ]
        ]
    @endphp

    <x-breadcrumb :navigations="$navigations" />

    <p class="h2 mb-5 fw-bold">
        @if ($mode == "detail")
            User Detail
        @elseif ($mode == "edit")
            Edit User
        @elseif ($mode == "entry")
            Add A New User
        @endif
    </p>

    <x-form-container>
        <fieldset @if($mode == "detail") disabled @endif>
            <form action="@if($mode == "entry")
                    {{ route('register.submit') }}
                @elseif ($mode == "edit")
                    {{ route('updateUser', $user) }}
                @endif" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 mb-4 row">
                        <div class="col-12 col-sm-3">
                            <label for="register_uname" class="form-label">Username</label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <input type="text" @if($mode == "detail") class="form-control-plaintext" readonly @else class="form-control" @endif 
                                                @if($mode == "edit" or $mode == "detail") value="{{ $user['username'] }}" @endif id="register_uname" name="uname">
                        </div>
                    </div>
                    @if ($mode == "entry")
                        <div class="col-12 mb-4 row">
                            <div class="col-12 col-sm-3">
                                <label for="register_pass" class="form-label">Password</label>
                            </div>
                            <div class="col-12 col-sm-9">
                                <input type="password" class="form-control" id="register_pass" name="pass">
                            </div>
                        </div>
                    @endif
                    <div class="col-12 mb-4 row">
                        <div class="col-12 col-sm-3">
                            <label for="register_name" class="form-label">Name</label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <input type="text" @if($mode == "detail") class="form-control-plaintext" readonly @else class="form-control" @endif 
                                                @if($mode == "edit" or $mode == "detail") value="{{ $user['name'] }}" @endif id="register_name" name="name">
                        </div>
                    </div>
                    <div class="col-12 mb-4 row">
                        <div class="col-12 col-sm-3">
                            <label for="register_email" class="form-label">Email Address</label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <input type="email" @if($mode == "detail") class="form-control-plaintext" readonly @else class="form-control" @endif
                                            @if($mode == "edit" or $mode == "detail") value="{{ $user['email'] }}" @endif id="register_email" name="email">
                        </div>
                    </div>
                    <div class="col-12 mb-4 row">
                        <div class="col-6 col-sm-3">
                            <label for="register_city_town" class="form-label">User Role</label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <select name="role" id="register_role"
                                @if($mode == "detail") class="form-control-plaintext" readonly @else class="form-select" @endif>
                                @if ($roles->count())
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" @if($mode == "edit" or $mode == "detail") @if($user['role_id'] == $role->id) selected @endif @endif>{{ $role->role_name }}</option>
                                    @endforeach
                                @else
                                    <option value="">No role found</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-12 mb-4 row">
                        <div class="col-12 col-sm-3">
                            <label for="register_city_town" class="form-label">City/Town</label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <input type="text" @if($mode == "detail") class="form-control-plaintext" readonly @else class="form-control" @endif
                            @if($mode == "edit") value="{{ $user['address'] }}" @endif id="register_city_town" name="city_town">
                        </div>
                    </div>
                    <div class="col-12 mb-4 row">
                        <div class="col-12 col-sm-3">
                            <label for="register_description" class="form-label">Description</label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <textarea name="description" @if($mode == "detail") class="form-control-plaintext" readonly @else class="form-control" @endif
                             id="register_description" cols="20" rows="5">@if($mode == "edit" or $mode == "detail") {{ $user['description'] }} @endif</textarea>
                        </div>
                    </div>

                    <div class="col-12 mb-4 row">
                        <div class="col-12 col-sm-3">
                            <label for="register_user_img" class="form-label">User's Image</label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <input class="form-control" type="file" id="register_user_img" name="user_img">
                        </div>
                    </div>

                    {{-- user's zoom info --}}
                    <div class="col-12 mb-4 row">
                        <div class="col-12 col-sm-3">
                            <label for="zoom_username" class="form-label">User's Zoom Username</label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <input type="text" @if($mode == "detail") class="form-control-plaintext" readonly @else class="form-control" @endif
                            @if($mode == "edit" or $mode == "detail") value="{{ $zoom['zoom_username'] }}" @endif id="zoom_username" name="zoom_username">
                        </div>
                    </div>

                    <div class="col-12 mb-4 row">
                        <div class="col-12 col-sm-3">
                            <label for="zoom_email" class="form-label">User's Zoom Email</label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <input type="text" @if($mode == "detail") class="form-control-plaintext" readonly @else class="form-control" @endif
                            @if($mode == "edit" or $mode == "detail") value="{{ $zoom['zoom_email'] }}" @endif id="zoom_email" name="zoom_email">
                        </div>
                    </div>

                    <div class="col-12 mb-4 row">
                        <div class="col-12 col-sm-3">
                            <label for="api_key" class="form-label">User's Zoom Api Key</label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <input type="text" @if($mode == "detail") class="form-control-plaintext" readonly @else class="form-control" @endif
                            @if($mode == "edit" or $mode == "detail") value="{{ $zoom['api_key'] }}" @endif id="api_key" name="api_key">
                        </div>
                    </div>

                    <div class="col-12 mb-4 row">
                        <div class="col-12 col-sm-3">
                            <label for="api_secret" class="form-label">User's Zoom Api Secret</label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <input type="text" @if($mode == "detail") class="form-control-plaintext" readonly @else class="form-control" @endif
                            @if($mode == "edit" or $mode == "detail") value="{{ $zoom['api_secret'] }}" @endif id="api_secret" name="api_secret">
                        </div>
                    </div>


                    @unless ($mode == "detail")
                        <div class="col-12 d-flex justify-content-end">
                            <input type="submit" class="btn btn-primary" value="@if($mode == "edit") Update @else Submit @endif">
                        </div>
                    @endunless
                </div>
            </form>
        </fieldset>
    </x-form-container>
@endsection