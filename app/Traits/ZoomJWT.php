<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait ZoomJWT
{
    //     The first method of ZoomJWT trait is generateZoomToken. To use Zoom API, 
    // we have to include JWT token on the request.
    // Using firebase/php-jwt library, it's very simple to generate JWT. 
    // It returns string type's encoded JWT token.
    private function generateZoomToken()
    {
        $key = env('ZOOM_API_KEY', '');
        $secret = env('ZOOM_API_SECRET', '');
        $payload = [
            'iss' => $key,
            'exp' => strtotime('+1 minute'),
        ];
        return \Firebase\JWT\JWT::encode($payload, $secret, 'HS256');
    }

    // Second, we will make method for get ZOOM_API_URL environment variable.
    private function retrieveZoomUrl()
    {
        return env('ZOOM_API_URL', '');
    }

    //Third method returns Request. 
    // We'll use this Request instance to send request to Zoom API end point.

    private function zoomRequest()
    {
        $jwt = $this->generateZoomToken();
        return \Illuminate\Support\Facades\Http::withHeaders([
            'authorization' => 'Bearer ' . $jwt,
            'content-type' => 'application/json',
        ]);
    }

    // These methods return Response that is used to execute GET/POST/PATCH/DELETE request.
    public function zoomGet(string $path, array $query = [])
    {
        $url = $this->retrieveZoomUrl();
        $request = $this->zoomRequest();
        return $request->get($url . $path, $query);
    }

    public function zoomPost(string $path, array $body = [])
    {
        $url = $this->retrieveZoomUrl();
        $request = $this->zoomRequest();
        return $request->post($url . $path, $body);
    }

    public function zoomPatch(string $path, array $body = [])
    {
        $url = $this->retrieveZoomUrl();
        $request = $this->zoomRequest();
        return $request->patch($url . $path, $body);
    }

    public function zoomDelete(string $path, array $body = [])
    {
        $url = $this->retrieveZoomUrl();
        $request = $this->zoomRequest();
        return $request->delete($url . $path, $body);
    }

    //The last methods are used for generate new format of datetime string.
    // I’ll use <input type="datetime-local"> format to set start time of meeting, 
    // but that form just get yyyy-MM-dd\THH:mm format of data.
    // To use Zoom API, we should change time format to yyyy-MM-dd\THH:mm:ss. 
    // That's why I'm creating these 2 methods.
    public function toZoomTimeFormat(string $dateTime)
    {
        try {
            $date = new \DateTime($dateTime);
            return $date->format('Y-m-d\TH:i:s');
        } catch(\Exception $e) {
            Log::error('ZoomJWT->toZoomTimeFormat : ' . $e->getMessage());
            return '';
        }
    }

    public function toUnixTimeStamp(string $dateTime, string $timezone)
    {
        try {
            $date = new \DateTime($dateTime, new \DateTimeZone($timezone));
            return $date->getTimestamp();
        } catch (\Exception $e) {
            Log::error('ZoomJWT->toUnixTimeStamp : ' . $e->getMessage());
            return '';
        }
    }
}