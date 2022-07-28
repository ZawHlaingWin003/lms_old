<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Http\Request;

class CourseController extends Controller
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
    public function create()
    {
        return view('user.admin.course.create-course', [
            "categories" => CourseCategory::all(),
            "mode" => "entry"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $category = CourseCategory::find($req->course_category_id);
        // dd($req);
        $new_course = $category->courses()->create($req->only(
            'course_name','visible','from_date','to_date','course_id','description'
        ));
        return back()->with('status', 'Course is created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::with(['course_sections', 'zoom_meetings'])->find($id);
        return view('user.course', [
            "course" => $course
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('user.admin.course.create-course', [
            "course" => $course,
            "categories" => CourseCategory::all(),
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
    public function update(Request $req, Course $course)
    {
        // dd($course);
        $updated_course = $course->update($req->only(
            'course_name','course_category_id','visible','from_date','to_date','course_id','description'
        ));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
