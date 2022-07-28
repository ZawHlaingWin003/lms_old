<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Essay;
use App\Models\EssayAnswer;
use App\Models\Exam;
use App\Models\ExamAttachment;
use App\Models\MultipleChoice;
use App\Models\MultipleChoiceAnswer;
use App\Models\ShortQuestion;
use App\Models\ShortQuestionAnswer;
use App\Models\TrueFalse;
use App\Models\TrueFalseAnswer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class ExamController extends Controller
{

    public function index()
    {
        //
    }

    public function create(Course $course, $section_id)
    {
        return view('user.exam.create-exam', [
            "course" => $course,
            "section_id" => $section_id,
            "mode" => "entry"
        ]);
    }

    public function store(Request $req, Course $course, $section_id)
    {
        // dd($req->all());
        $new_exam = Exam::create(array_merge(
            $req->only('exam_name', 'start_date_time', 'end_date_time', 'description', 'duration'),
            ["course_id" => $course->id, "course_section_id" => $section_id]
        ));

        return redirect()->route('show.course', $course->id)->with('message', 'Exam Added Successfully!');
    }

    public function show(Course $course, Exam $exam)
    {
        return view('user.exam.show-exam', [
            'course' => $course,
            'exam' => $exam
        ]);
    }

    public function edit(Course $course, Exam $exam)
    {
        return view('user.exam.create-exam', [
            "course" => $course,
            "exam" => $exam,
            "mode" => "edit"
        ]);
    }

    public function update(Request $request, Course $course, Exam $exam)
    {
        $exam->exam_name = $request->exam_name;
        $exam->start_date_time = $request->start_date_time;
        $exam->end_date_time = $request->end_date_time;
        $exam->duration = $request->duration;
        $exam->description = $request->description;
        $exam->update();

        return redirect()->route('show.course', $course->id)->with('message', 'Exam Updated Successfully!');
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();
        return back()->with('message', 'Exam Deleted Successfully!');
    }

    public function chooseQuestionType(Course $course, Exam $exam)
    {
        $shortQuestions = ShortQuestion::where('exam_id', $exam->id)->get();
        $essays = Essay::where('exam_id', $exam->id)->get();
        $multipleChoices = MultipleChoice::where('exam_id', $exam->id)->get();
        $trueFalses = TrueFalse::where('exam_id', $exam->id)->get();
        return view('user.exam.choose-question-type', compact('course', 'exam', 'shortQuestions', 'essays', 'multipleChoices', 'trueFalses'));
    }

    public function answerpaper(Course $course, Exam $exam)
    {
        $shortQuestions = ShortQuestion::where('exam_id', $exam->id)->get();
        $essays = Essay::where('exam_id', $exam->id)->get();
        $multipleChoices = MultipleChoice::where('exam_id', $exam->id)->get();
        $trueFalses = TrueFalse::where('exam_id', $exam->id)->get();
        return view('user.answer-paper', compact('course', 'exam', 'shortQuestions', 'essays', 'multipleChoices', 'trueFalses'));
    }

    public function storeAnswer(Course $course, Exam $exam, Request $request)
    {
        // dd($request->all());

        if ($request->multipleChoice) {
            foreach ($request->multipleChoice as $multipleChoice) {

                MultipleChoiceAnswer::create([
                    'user_id' => auth()->user()->id,
                    'multiple_choice_id' => $multipleChoice['question_id'],
                    'student_answer' => array_key_exists('student_answer', $multipleChoice) ? $multipleChoice['student_answer'] : NULL,
                ]);
            }
        }

        if ($request->trueFalse) {
            foreach ($request->trueFalse as $trueFalse) {
                TrueFalseAnswer::create([
                    'user_id' => auth()->user()->id,
                    'true_false_id' => $trueFalse['question_id'],
                    'student_answer' => array_key_exists('student_answer', $trueFalse) ? $trueFalse['student_answer'] : NULL,
                ]);
            }
        }

        if($request->shortQuestion){
            foreach($request->shortQuestion as $shortQuestion){
                ShortQuestionAnswer::create([
                    'user_id' => auth()->user()->id,
                    'short_question_id' => $shortQuestion['question_id'],
                    'student_answer' => $shortQuestion['student_answer']
                ]);
            }
        }

        if($request->essay){
            foreach($request->essay as $essay){
                EssayAnswer::create([
                    'user_id' => auth()->user()->id,
                    'essay_id' => $essay['question_id'],
                    'student_answer' => $essay['student_answer']
                ]);
            }
        }

        if($request->hasFile("files")){
            foreach ($request->file("files") as $file) {

                $fileSize = $file->getSize();
                $fileType = $file->getClientOriginalExtension();

                $fileName = date('YmdHis')."-".strtolower(str_replace(' ', '', $file->getClientOriginalName()));
                $file->storeAs('images/exam_attachments', $fileName);

                ExamAttachment::create([
                    'user_id' => auth()->user()->id,
                    'exam_id' => $exam->id,
                    'file_name' => $fileName,
                    'file_type' => $fileType,
                    'file_size' => $fileSize
                ]);
            }
        }

        $date = Carbon::now();
        
        return redirect()->route('show.exam', [$course, $exam])->with('message', 'Successfully Submitted Your AnswerPaper!');
    }
}
