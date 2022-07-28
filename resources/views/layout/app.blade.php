<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{-- Bootstrap Css & Custom Css links --}}
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{asset('css/answerpaper.css')}}">
    <link rel="stylesheet" href="{{asset('css/forum.css')}}">


    {{-- Jquery --}}
    <script src="{{url('js/jquery-3.6.0.min.js')}}"></script>


    {{-- Summernote Css --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    {{-- Fontawe Some --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    {{-- Full-Calender --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <title>Document</title>
</head>
<body>

    <div class="container-fluid p-0 mb-5 bg-white">
        @yield('navbar')
    </div>

    @yield('slidenavbar')

    {{-- @yield('messageslidebar') --}}
    <x-message-slide-bar></x-message-slide-bar>

    <div class="container">
        @yield('content')
    </div>

    
    <x-footer></x-footer>


    {{-- Bootstrap Js & Custom Js Links --}}
    <script src="{{url('js/app.js')}}"></script>
    <script src="{{url('js/category.js')}}"></script>
    <script src="{{asset('js/docs.js')}}"></script>

    {{-- Summernote Js --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    {{-- Toastr Alert --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    {{-- Socket for Chat --}}
    {{-- <script src="https://cdn.socket.io/4.5.0/socket.io.min.js" integrity="sha384-7EyYLQZgWBi67fBtVxw60/OWl1kjsfrPFcaU0pp0nAh+i8FD068QogUvg85Ewy1k" crossorigin="anonymous"></script> --}}

    @yield('script')

    <script>
        // Summernote script
        let load_summernote = function() {
            $('.summernote').summernote({
                height: 300,
            });
        };
        $(document).ready(load_summernote);


        // Toastr script
        @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.success("{{ session('message') }}");
        @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.error("{{ session('error') }}");
        @endif



        $(document).ready(()=>{


            // Sweetalert script
            const multipleChoiceDeleteBtns = document.querySelectorAll("#multiple-choice-delete-confirm");
            for (let btn of multipleChoiceDeleteBtns)
            {
                btn.addEventListener('click', function(e){
                    e.preventDefault();
                    var form =  $(this).closest("form");

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    })
                });
            }

            const essayDeleteBtns = document.querySelectorAll("#essay-delete-confirm");
            for (let btn of essayDeleteBtns)
            {
                btn.addEventListener('click', function(e){
                    e.preventDefault();
                    var form =  $(this).closest("form");

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    })
                });
            }


            const shortQuestionDeleteBtns = document.querySelectorAll("#short-question-delete-confirm");
            for (let btn of shortQuestionDeleteBtns)
            {
                btn.addEventListener('click', function(e){
                    e.preventDefault();
                    var form =  $(this).closest("form");

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    })
                });
            }

            const trueFalseDeleteBtns = document.querySelectorAll("#true-false-delete-confirm");
            for (let btn of trueFalseDeleteBtns)
            {
                btn.addEventListener('click', function(e){
                    e.preventDefault();
                    var form =  $(this).closest("form");

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    })
                });
            }
        });
    </script>

    {{-- clock.js --}}
    <script src="{{url('js/clock.js')}}"></script>

</body>
</html>
