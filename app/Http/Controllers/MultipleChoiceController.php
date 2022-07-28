<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Exam;
use App\Models\MultipleChoice;
use Illuminate\Http\Request;

class MultipleChoiceController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Course $course, Exam $exam)
    {
        return view('user.exam.multiple_choice.create-multiple-choice', [
            'course' => $course,
            'exam' => $exam,
            'mode' => 'entry'
        ]);
    }

    public function store(Request $request, Course $course, Exam $exam)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        $multipleChoice = new MultipleChoice();
        $multipleChoice->exam_id = $exam->id;
        $multipleChoice->question = $request->question;
        $multipleChoice->choice_1 = $request->choice_1;
        $multipleChoice->choice_2 = $request->choice_2;
        $multipleChoice->choice_3 = $request->choice_3;
        $multipleChoice->choice_4 = $request->choice_4;
        $multipleChoice->answer = $request->answer;
        $multipleChoice->save();

        return redirect()->route('chooseQuestionType.exam', [$course, $exam])->with('message', 'Multiple choice question added successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit(Course $course, Exam $exam, MultipleChoice $multipleChoice)
    {
        return view('user.exam.multiple_choice.create-multiple-choice', [
            'course' => $course,
            'exam' => $exam,
            'multipleChoice' => $multipleChoice,
            'mode' => 'edit'
        ]);
    }

    public function update(Request $request, Course $course, Exam $exam, MultipleChoice $multipleChoice)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        $multipleChoice->exam_id = $exam->id;
        $multipleChoice->question = $request->question;
        $multipleChoice->choice_1 = $request->choice_1;
        $multipleChoice->choice_2 = $request->choice_2;
        $multipleChoice->choice_3 = $request->choice_3;
        $multipleChoice->choice_4 = $request->choice_4;
        $multipleChoice->answer = $request->answer;
        $multipleChoice->update();

        return redirect()->route('chooseQuestionType.exam', [$course, $exam])->with('message', 'Multiple choice question updated successfully!');
    }

    public function destroy(MultipleChoice $multipleChoice)
    {
        $multipleChoice->delete();
        return back()->with('message', 'Multiple choice question deleted successfully!');
    }
}
