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
                "active" => true
            ],
        ]
    @endphp

    <x-breadcrumb :navigations="$navigations" />

    <x-page-heading>
        Course Category
    </x-page-heading>
    
    <div class="w-100 py-5 row bg-white justify-content-center align-items-start gap-5 ">
        <div class="col-12 col-md-4 card px-0">
            <div class="card-header py-3 d-flex flex-wrap justify-content-between align-items-center">
                <h4 class="mb-0">
                    <strong>Categories</strong>
                </h4>
                <a href="{{ route('create.courseCategory') }}" class="btn btn-sm btn-primary">
                    Create Category
                </a>
            </div>
            <ul class="list-group list-group-flush">
                @if ($categories->count())
                    @foreach ($categories as $category)
                    <li class="list-group-item list-group-item-action category_item" onclick="get_courses_by_category(this)">
                        {{ $category->category_name }}
                        <input type="hidden" value="{{ $category->id }}" class="category">
                    </li>
                    @endforeach
                @else 
                    <div class="alert alert-danger m-3 text-center" role="alert">
                        There's no course category right now!
                    </div>
                @endif
            </ul>
        </div>
        <div class="col-12 col-md-4 card px-0">
            <h4 class="card-header  py-3">
                <strong>Courses</strong>
            </h4>
            <ul class="list-group list-group-flush" id="category_courses">
                <div class="alert alert-warning m-3 text-center" role="alert">
                    Select a category!
                </div>
            </ul>
        </div>
    </div>
    
@endsection

@section('script')
    <script>
        //get courses when clicking an category
        async function get_courses_by_category(ele) {

            // remove all of the active class and insert active into this list
            let categories = document.querySelectorAll('.category_item');
            categories.forEach(category => {
                if (category.classList.contains('active')) {
                    category.classList.remove('active');
                }
            });
            ele.classList.add('active');

            // send ajax to fetch courses
            let url = '{{ route("get.coursesByCategory", ":id") }}';
            url = url.replace(":id", ele.children[0].value);
            let response = await fetch(url);
            let courses = await response.json();
            document.querySelector('#category_courses').innerHTML = course_list(courses);

        }

        function course_list(courses) {
            let course_lists = "";
            courses.forEach(course => {
                let course_url = "{{ route('show.course', ':id') }}";
                course_url = course_url.replace(":id", course["id"]);
                course_lists += `
                    <a href="${course_url}" action="GET" class="list-group-item list-group-item-action category_item">
                        ${course['course_name']}
                    </a>
                `;
            });
            return course_lists;
        }
    </script>
@endsection