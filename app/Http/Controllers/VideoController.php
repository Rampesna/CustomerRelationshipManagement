<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        return view('pages.video.index.index');
    }

    public function settings()
    {
        return view('pages.video.setting.index');
    }
}
