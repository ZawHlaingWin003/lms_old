<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Essay;
use App\Models\Exam;
use Illuminate\Http\Request;

class EssayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create(Course $course, Exam $exam)
    {
        return view('user.exam.essay.create-essay', [
            'course' => $course,
            'exam' => $exam,
            'mode' => 'entry'
        ]);
    }

    public function store(Request $request, Course $course, Exam $exam)
    {
        $request->validate([
            'question' => 'required'
        ]);

        $essay = new Essay();
        $essay->exam_id = $exam->id;
        $essay->question = $request->question;
        $essay->save();

        return redirect()->route('chooseQuestionType.exam', [$course, $exam])->with('message', 'Essay question added successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit(Course $course, Exam $exam, Essay $essay)
    {
        return view('user.exam.essay.create-essay', [
            'course' => $course,
            'exam' => $exam,
            'essay' => $essay,
            'mode' => 'edit'
        ]);
    }

    public function update(Request $request, Course $course, Exam $exam, Essay $essay)
    {
        $request->validate([
            'question' => 'required'
        ]);

        $essay->exam_id = $exam->id;
        $essay->question = $request->question;
        $essay->update();

        return redirect()->route('chooseQuestionType.exam', [$course, $exam])->with('message', 'Essay question updated successfully!');
    }

    public function destroy(Essay $essay)
    {
        $essay->delete();
        return back()->with('message', 'Essay question deleted successfully!');
    }
}
