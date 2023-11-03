<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use App\Models\TagParrent;
use Illuminate\Http\Request;

class TagController extends Controller
{
    function index()
    {
        $tags = Tag::all();
        return view('frontend.tag.index', compact('tags'));
    }
    function products($tag_slug)
    {
        $tag = Tag::where('slug', $tag_slug)->first();
        $tagProduct = TagParrent::where('tag_id', $tag->id)
            ->join('products', 'products.id', '=', 'tagparrents.product_id')
            ->get(['products.*', 'products.name']);

        // return $tagProduct;
        return view('frontend.tag.product', compact('tag', 'tagProduct'));
    }
}
