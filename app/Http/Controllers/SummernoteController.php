<?php

namespace App\Http\Controllers;

use App\Models\Summernote;
use Illuminate\Http\Request;

class SummernoteController extends Controller
{
    public function index(Request $req)
    {
        dd($req->all());
        $new_summer_note = Summernote::create([
            'content' => $req->editordata
        ]);
        return view('test.show-summernote-result', [
            'new_summer_note' => $new_summer_note
        ]);
    }

    public function show($id) {
        return view('test.show-summernote-result', [
            'new_summer_note' => Summernote::find($id)
        ]);
    }
}
