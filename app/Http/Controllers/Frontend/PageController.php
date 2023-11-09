<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function sitemap()
    {
        $posts = Post::where('status', 1)->orderBy('id', 'DESC')->get();
        return response()->view('frontend.sitemap', compact('posts'))->header('Content-Type', 'text/xml');
    }
}
