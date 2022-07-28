

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
            ]
        ]
    @endphp

    <x-breadcrumb :navigations="$navigations" />

    <x-page-heading>
        Summernote
    </x-page-heading>
    
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('status') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <x-form-container>

        <div class="lesson_content">
            {!! $new_summer_note->content !!}
        </div>

        <iframe src="https://www.youtube.com/embed/ByH9LuSILxU" width="420" height="315" frameborder="0">
        </iframe>
        
        <video width="320" height="240" controls>
            <source src="https://www.youtube.com/embed/ByH9LuSILxU" type="video/mp4">
        </video>
        
    </x-form-container>
@endsection

@section('script')
    <script>

        // make all of the images inside the page to be downloadable

        // get all of the images
        let imgs = document.querySelectorAll('.lesson_content img');
        
        // add the download feature to each of the image
        imgs.forEach(img => {
            // select the parent element of the specific image
            let img_p_tag = img.parentElement;

            // change the style of the parent element of the specified image
            img_p_tag.style.position = 'relative';
            img_p_tag.style.display = 'inline-block';
            img_p_tag.classList.add('border');
            img_p_tag.classList.add('p-3');

            // add the downloadable feature button inside the parent element of the specified image
            let a = document.createElement('a');
            a.classList.add('btn');
            a.classList.add('btn-success');
            a.classList.add('shadow');
            a.classList.add('p-2');
            console.log(img.src);
            a.href = img.src;
            a.style.position = 'absolute';
            a.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z"/>
            </svg>
            `;
            a.style.top = '10px';
            a.style.right = '10px';
            a.setAttribute('download', '');
            img_p_tag.appendChild(a);
        });
    </script>
@endsection