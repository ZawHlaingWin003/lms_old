@props(['course', 'key'])


<div class="card course-card my-3">
    <div class="card-body d-flex gap-5">
        <div class="course-img" style="max-width: 300px;">
            <img src="{{ asset('img/course'.++$key.'.jpg') }}" alt="" class="rounded" style="height: auto; width: 100%; object-fit: contain;">
        </div>
        <div class="course-info" style="width: 100%;">
            <h4 class="fw-bold"><a href="{{ route('show.course', $course->id) }}" class="course-title stretched-link text-main">{{ $course->course_name }}</a></h4>
            <h4 class="text-secondary"><i class="fa-solid fa-clipboard-list"></i> {{ $course->course_category->category_name }}</h4>
            <p>
                {{ $course->description }}
            </p>
            <div class="row align-items-end">
                <div class="col-md-3" style="margin-bottom: -6px; padding-right: 0;">
                    <p class="mb-0 fw-bold">Current Progress</p>
                </div>
                <div class="col-md-9" style="padding-left: 0;">
                    <span class="float-end"><small>35%</small></span>
                    <div class="progress" style="height: .6rem; width: 100%; border-radius: 10px; background-color: #D8F1FF;">
                        <div class="progress-bar" role="progressbar" style="width: 35%; border-radius: 10px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>