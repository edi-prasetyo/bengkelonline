<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wallet;
use App\Models\Slider;
use App\Models\TagParrent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->orderBy('id', 'asc')->paginate(2);
        return view('frontend.product.index', compact('products'));
    }
    public function detail($products_slug)
    {
        $header = Slider::where('status', '1')->where('type', 1)->get();
        $product = Product::where('slug', $products_slug)->first();
        $images = $product->productImages;
        $tags = TagParrent::where('product_id', $product->id)
            ->join('tags', 'tagparrents.tag_id', '=', 'tags.id')->select('tags.name as tagname', 'tags.slug as tagslug')
            ->get();

        if (!Auth::check()) { //guest user identified by ip
            $cookie_name = (Str::replace('.', '', (request()->ip())) . '-' . $product->id);
        } else {
            $cookie_name = (Auth::user()->id . '-' . $product->id); //logged in user
        }
        if (Cookie::get($cookie_name) == '') { //check if cookie is set
            $cookie = cookie($cookie_name, '1', 60); //set the cookie
            $product->incrementReadCount(); //count the view

            return response()
                ->view('frontend.product.detail', [
                    'product' => $product,
                    'tags' => $tags,
                    'images' => $images,
                ])
                ->withCookie($cookie); //store the cookie
        } else {
            return view('frontend.product.detail', compact('product', 'header', 'tags', 'images'));
        }
    }

    public function addToCart($id)
    {
        $product = Product::find($id);
        if (!$product) {
            abort(404);
        }
        $cart = session()->get('cart');
        // if cart is empty then this the first product
        if (!$cart) {
            $cart = [
                $id => [
                    "name" => $product->name,
                    "product_id" => $product->id,
                    "quantity" => 1,
                    "price" => $product->price,
                    "short_description" => $product->short_description,
                    "photo" => $product->image_cover
                ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->name,
            "product_id" => $product->id,
            "quantity" => 1,
            "price" => $product->price,
            "short_description" => $product->short_description,
            "photo" => $product->image_cover
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function cart()
    {
        $userId =  Auth::user()->id;
        return view('frontend.cart.cart', compact('saldo'));
    }
    public function update(Request $request)
    {
        if ($request->id and $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
    public function checkout()
    {

        $cart = session()->get('cart');
        if (!$cart) {
            return redirect()->back()->with('success', 'Cart is Empty');
        } else {
            $userId =  Auth::user()->id;
            return view('frontend.cart.checkout', compact('saldo'));
        }
    }
}
