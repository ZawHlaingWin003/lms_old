<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonContent;
use Illuminate\Http\Request;

class LessonController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course, $section_id)
    {
        return view('user.lesson.create-lesson', [
            "course" => $course,
            "section_id" => $section_id,
            "mode" => "entry"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req, Course $course, $section_id)
    {
        // dd($req->all());
        $new_lesson = Lesson::create([
            "lesson_name" => $req->lesson_name,
            "course_id" => $course->id,
            "course_section_id" => $section_id
        ]);

        // loop the new lesson contents, filter out "_token" and "lesson_name"
        foreach ($req->all() as $key => $lesson_content) {
           if($key != "_token" && $key != "lesson_name"){
            LessonContent::create([
                "lesson_id" => $new_lesson->id,
                "content" => $lesson_content,
            ]);
           }
        }

        return redirect()->route('show.course', $course->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, Lesson $lesson)
    {
        $lesson_content = $lesson->lesson_contents()->paginate(1);
        // dd($lesson_content);
        return view('user.lesson.lesson', [
            "course" => $course,
            "lesson" => $lesson,
            "lesson_contents" => $lesson_content
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course,Lesson $lesson)
    {
        return view('user.lesson.create-lesson', [
            "course" => $course,
            "lesson" => $lesson,
            "mode" => "edit"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Course $course, Lesson $lesson)
    {
        // loop the new lesson contents, filter out "_token" and "lesson_name"
        foreach ($req->all() as $key => $lesson_content) {
            if($key != "_token") {
                if($key == "lesson_name") {
                    $lesson->update([
                        'lesson_name' => $lesson_content
                    ]);
                } else {
                    $lesson_content_id = substr($key, 12);
                    $lesson = LessonContent::find($lesson_content_id)->update([
                        'content' => $lesson_content
                    ]);
                }
            }
         }

        return redirect()->route('show.course', $course->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        $lesson = $req->json()->all();
        if(array_key_exists('lesson_id', $lesson)) {
            $res = Lesson::find($lesson['lesson_id'])->delete();
        } else if (array_key_exists('content_id', $lesson)) {
            $res = LessonContent::find($lesson['content_id'])->delete();
        }
        return response()->json($res);
    }
}
