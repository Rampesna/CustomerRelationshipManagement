<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function save(Request $request)
    {
        $postService = new \App\Services\PostService;
        $postService->setPost($request->id ? \App\Models\Opportunity::find($request->id) : new \App\Models\Opportunity());
        $postService->save($request->abc);
    }
}
