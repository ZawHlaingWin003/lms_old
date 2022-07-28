<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Exam;
use App\Models\TrueFalse;
use Illuminate\Http\Request;

class TrueFalseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course , Exam $exam)
    {
        // $truefalse = TrueFalse::all();
        // dd($truefalse);
        return view('user.exam.true_false.create-true-false',[
            'course' => $course,
            'exam' => $exam,
            'mode' => 'entry'
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Course $course , Exam $exam)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);
        $truefalse = new TrueFalse();
        $truefalse->exam_id = $exam->id;
        $truefalse->question = $request->question;
        $truefalse->answer = $request->answer;
        $truefalse->save();
        return redirect()->route('chooseQuestionType.exam', [$course, $exam])->with('message', 'TrueFalse question added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course, Exam $exam, TrueFalse $trueFalse)
    {
        return view('user.exam.true_false.create-true-false', [
            'course'=>$course,
            'exam'=>$exam,
            'trueFalse' => $trueFalse,
            'mode'=>'edit'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course , Exam $exam , TrueFalse $trueFalse)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',

        ]);
        // dd($request->all());
        $trueFalse->exam_id = $exam->id;
        $trueFalse->question = $request->question;
        $trueFalse->answer = $request->answer;
        $trueFalse->update();
        return redirect()->route('chooseQuestionType.exam', [$course, $exam])->with('message', 'TrueFalse question updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trueFalse = TrueFalse::find($id);
        $trueFalse->delete();
        return redirect()->back()->with('message', 'TrueFalse Deleted successfully');
    }
}
