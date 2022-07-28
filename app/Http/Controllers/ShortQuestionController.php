<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Exam;
use App\Models\ShortQuestion;
use Illuminate\Http\Request;

class ShortQuestionController extends Controller
{

    public function index()
    {
        //
    }

    public function create(Course $course, Exam $exam)
    {
        return view('user.exam.short_question.create-short-question', [
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

        $shortQuestion = new ShortQuestion();
        $shortQuestion->exam_id = $exam->id;
        $shortQuestion->question = $request->question;
        $shortQuestion->save();

        return redirect()->route('chooseQuestionType.exam', [$course, $exam])->with('message', 'Short question added successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit(Course $course, Exam $exam, ShortQuestion $shortQuestion)
    {
        return view('user.exam.short_question.create-short-question', [
            'course' => $course,
            'exam' => $exam,
            'shortQuestion' => $shortQuestion,
            'mode' => 'edit'
        ]);
    }

    public function update(Request $request, Course $course, Exam $exam, ShortQuestion $shortQuestion)
    {
        $request->validate([
            'question' => 'required'
        ]);

        $shortQuestion->exam_id = $exam->id;
        $shortQuestion->question = $request->question;
        $shortQuestion->update();

        return redirect()->route('chooseQuestionType.exam', [$course, $exam])->with('message', 'Short question updated successfully!');
    }

    public function destroy(ShortQuestion $shortQuestion)
    {
        $shortQuestion->delete();
        return back()->with('message', 'Short question deleted successfully!');
    }
}
