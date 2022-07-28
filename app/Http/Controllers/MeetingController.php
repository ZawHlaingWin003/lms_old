<?php

# /app/Http/Controllers/Zoom/MeetingController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ZoomMeeting;
use App\Traits\ZoomJWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MeetingController extends Controller
{

    // use: to use traits
    // const xxx = <numeric>: Zoom supports 4 types of Meeting. 
    // In this time, we'll manage MEETING_TYPE_SCHEDULE type of Meeting because it's the default type.

    use ZoomJWT;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    // This section gets list of meeting rooms and their information.
    // To handle start_time with timezone easily, I add start_at property in the information.
    public function list(Request $request)
    {
        $path = 'users/me/meetings';
        $response = $this->zoomGet($path);

        $data = json_decode($response->body(), true);
        $data['meetings'] = array_map(function (&$m) {
            $m['start_at'] = $this->toUnixTimeStamp($m['start_time'], $m['timezone']);
            return $m;
        }, $data['meetings']);

        return [
            'success' => $response->ok(),
            'data' => $data,
        ];
    }

    //To create the meeting room, actually we need various properties, but in this time, we just use topic, agenda and start_time.
    // If you want to set more various options to create meeting, please read Zoom API Reference
    public function create($zoom_info)
    {
        $path = 'users/me/meetings';
        $response = $this->zoomPost($path, [
            'topic' => $zoom_info['topic'],
            'type' => self::MEETING_TYPE_SCHEDULE,
            'start_time' => $this->toZoomTimeFormat($zoom_info['start_time']),
            'duration' => 60,
            'agenda' => $zoom_info['agenda'],
            'settings' => [
                'host_video' => false,
                'participant_video' => false,
                'waiting_room' => true,
            ]
        ]);


        return [
            'success' => $response->status() === 201,
            'data' => json_decode($response->body(), true),
        ];
    }

    //Next is get a meeting information section. Using meeting room id, we can get meeting room information easily.
    public function get(Request $request, string $id)
    {
        $path = 'meetings/' . $id;
        $response = $this->zoomGet($path);

        $data = json_decode($response->body(), true);
        if ($response->ok()) {
            $data['start_at'] = $this->toUnixTimeStamp($data['start_time'], $data['timezone']);
        }

        return [
            'success' => $response->ok(),
            'data' => $data,
        ];
    }

    //The update section is almost same as create section.
    public function update($update_zoom_info, $zoom)
    {
        $path = 'meetings/' . $zoom->meeting_id;
        $response = $this->zoomPatch($path, [
            'topic' => $zoom['topic'],
            'type' => self::MEETING_TYPE_SCHEDULE,
            'start_time' => (new \DateTime($zoom['start_time']))->format('Y-m-d\TH:i:s'),
            'duration' => 60,
            'agenda' => $zoom['agenda'],
            'settings' => [
                'host_video' => false,
                'participant_video' => false,
                'waiting_room' => true,
            ]
        ]);

        return [
            'success' => $response->status() === 204,
            'data' => json_decode($response->body(), true),
        ];
    }

    // The last section is delete section. It uses when user want to delete a specific meeting.
    public function delete(ZoomMeeting $zoom)
    {
        $path = 'meetings/' . $zoom->meeting_id;
        $response = $this->zoomDelete($path);

        return [
            'success' => $response->status() === 204,
            'data' => json_decode($response->body(), true),
        ];
    }
}