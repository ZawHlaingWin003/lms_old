<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MeetingController;
use App\Models\Course;
use App\Models\ZoomMeeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ZoomController extends Controller
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

    // generate signature and enter into the zoom class by zoom sdk
    public function enter(ZoomMeeting $zoom) {
        $response = Http::post('http://localhost:4000', [
            "meetingNumber" => $zoom->meeting_id,
            "role" => auth()->user()->isStudent() ? 0 : 1
        ]);
        $signature = json_decode($response->body());
        // dd($signature);
        return view('user.zoom.start-or-join-zoom', [
            "signature" => $signature->signature,
            "sdkkey" => "ZcMDGHtOiDl4u86z1oqFq6Tl1QcAXOx65WvS", // 
            "username" => auth()->user()->username,
            "meetingnumber" => $zoom->meeting_id,
            "password" => $zoom->meeting_password
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course, $section_id)
    {
        // dd($course, $section_id);
        return view('user.zoom.create-zoom-meeting', [
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
        
        $this->validate($req, [
            'topic' => 'required|string',
            'start_time' => 'required|date',
            'agenda' => 'string|nullable',
            'description' => 'string|nullable'
        ]);

        // dd($req->all(), $course->id, $section_id);

        // create meetingcontroller obj
        $meeting = new MeetingController();

        // create a meeting 
        $response = $meeting->create($req->only(['topic', 'start_time', 'agenda']));
        // dd($response['data']);
        $new_zoom_meeting = ZoomMeeting::create([
            'course_id' => $course->id,
            'course_section_id' => $section_id,
            'topic' => $response['data']['topic'],
            'start_time' => $req->start_time,
            'agenda' => $response['data']['agenda'],
            'meeting_id' => $response['data']['id'],
            'start_url' => $response['data']['start_url'],
            'join_url' => $response['data']['join_url'],
            'meeting_password' => $response['data']['password'],
            'description' => $req->description,
        ]);

        

        // dd($new_zoom_meeting);
        return redirect()->route('show.course', $course->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, ZoomMeeting $zoom)
    {
        return view('user.zoom.zoom', [
            "course" => $course,
            "section_id" => $zoom->section_id,
            "zoom" => $zoom  
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course ,ZoomMeeting $zoom)
    {
        return view('user.zoom.create-zoom-meeting', [
            "course" => $course,
            "zoom" => $zoom,
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
    public function update(Request $req, Course $course ,ZoomMeeting $zoom)
    {
        $zoom->update($req->only(['topic', 'start_time', 'agenda', 'description']));

        // create meeting controller 
        $update_zoom = new MeetingController();

        // update the meeting information form zoom server
        $update_zoom->update($req->only(['topic', 'start_time', 'agenda', 'description']), $zoom);

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
        $zoom_info = $req->json()->all();

        $zoom = ZoomMeeting::find($zoom_info['zoom_id']);

        // create meeting controller 
        $delete_zoom = new MeetingController();

        // update the meeting information form zoom server
        $delete_zoom->delete($zoom);
        
        // delete from the database
        $zoom->delete();

        return redirect()->route('show.course', $zoom_info['course_id']);
    }
}
