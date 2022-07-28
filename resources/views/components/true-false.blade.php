<div class="truefalse_all mt-5">
    <div class="truefalse_header_div">
        <h3 class="truefalse_header p-3">True or False</h3>
    </div>
    @foreach ($trueFalses as $key => $trueFalse)
        <div class="card truefalse_card">
            <div class="row">
                <div class="left_pra col-md-9">
                    <div class="truefalepra_no">
                        <p class="left_p">{{ ++$key }}.</p>
                        <p class="right_p">{!! $trueFalse->question !!}</p>
                    </div>
                    <div class="choice_true_false">
                        <p >Answer : {{$trueFalse->answer}}</p>
                    </div>
                </div>
                <div class="right_para col-md-3">
                    <div class="action_button">
                        <a class="btn text-success fs-3 fw-bold btn-sm" href="{{route('edit.trueFalse', ['course'=>$course, 'exam'=>$exam, 'trueFalse'=>$trueFalse])}}"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form class="d-inline" action="{{url('/deleteTrueFalse', $trueFalse->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn text-danger fs-3 btn-sm" id="true-false-delete-confirm"><i class="fa-regular fa-trash-can"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
