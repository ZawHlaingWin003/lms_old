@props(['course', 'exam', 'essays'])


<div class="longanswer_all mt-5">
    <div class="longanswer_header_div">
        <h3 class="longanswer_header">Essay</h3>
    </div>
    @foreach ($essays as $essay)
        <div class="card longanswer_card">
            <div class="row">
                <div class="longanswer_pnadno col-md-9">
                    <p class="left_p">{{ $loop->iteration }}. </p>
                    <p class="right_p">{!! $essay->question !!}</p>
                </div>
                <div class="action_buttons col-md-3">
                    <a href="{{ route('edit.essay', ['course' => $course, 'exam' => $exam, 'essay' => $essay]) }}"
                        class="btn text-success fs-3 fw-bold btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                    <form action="{{ route('delete.essay', ['essay' => $essay]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn text-danger fs-3 fw-bold btn-sm" id="essay-delete-confirm"><i class="fa-regular fa-trash-can"></i></button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
