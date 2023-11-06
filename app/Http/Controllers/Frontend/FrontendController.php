<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Category;


class FrontendController extends Controller
{
    public function index()
    {

        // $sliders = Slider::where('status', '1')->get();
        $categories = Category::where('status', 1)->get();
        return view('frontend.index', compact('sliders', 'categories'));
    }
    public function categories()
    {
        $categories = Category::where('status', 1)->get();
        return view('frontend.category.index', compact('categories'));
    }
    public function products($category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        if ($category) {
            $products =  $category->products()->get();
            return view('frontend.category.products', compact('products', 'category'));
        } else {
            return redirect()->back();
        }
    }
    public function booking()
    {
        return view('frontend.booking');
    }
    public function contact()
    {
        return view('frontend.contact');
    }
}
