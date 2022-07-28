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
                "active" => true
            ],
        ]
    @endphp

    <x-breadcrumb :navigations="$navigations" />

    <div class="row">
        <div class="col-12 col-md-10">
            <x-page-heading>
                All Users
            </x-page-heading>
        </div>
        <div class="col-12 col-md-2">
            <a class="btn btn-primary" href="{{ route('register') }}" role="button">Add New User</a>
        </div>
    </div>
    
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('status') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="table-responsive-sm">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Role</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @if ($users->count())
                    @foreach ($users as $index=>$user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['username'] }}</td>
                            <td>{{ $user->role->role_name }}</td>
                            <td style="width: 20%;">
                                <div class="btn-group gap-2" role="group" aria-label="Basic outlined example">
                                    <form action="{{ route('editUser', $user) }}" method="GET">
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Edit</button>
                                    </form>
                                    <form action="{{ route('showUser', $user) }}" method="GET">
                                        <button type="submit" class="btn btn-sm btn-outline-success">Detail</button>
                                    </form>
                                    <form action="{{ route('destroyUser', $user) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">
                            <div class="alert alert-danger m-5 text-center" role="alert">
                                There's no user right now!
                            </div>
                        </td>
                    </tr>
                @endunless
                
            </tbody>
        </table>
    </div>
    
@endsection