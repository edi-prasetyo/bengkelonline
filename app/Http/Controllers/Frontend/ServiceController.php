<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CarModel;
use App\Models\City;
use App\Models\Province;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('frontend.service.index', compact('services'));
    }
    public function show($slug)
    {
        $service = Service::where('slug', $slug)->first();
        $service_id = $service->id;
        $serviceItem = ServiceItem::where('service_id', $service_id)->get();

        // return $serviceItem;
        return view('frontend.service.show', compact('service', 'serviceItem'));
    }

    public function addToCart($uuid)
    {
        $serviceDetail = ServiceItem::where('uuid', $uuid)->first();
        $id = $serviceDetail->id;
        $service_id = $serviceDetail->service_id;
        $service = Service::where('id', $service_id)->first();
        if (!$service) {
            abort(404);
        }
        $cart = session()->get('cart');
        // if cart is empty then this the first product
        if (!$cart) {
            $cart = [
                $id => [
                    "name" => $serviceDetail->name,
                    "uuid" => $serviceDetail->uuid,
                    "service_id" => $service_id,
                    "service_price" => $service->service_price,
                    "quantity" => 1,
                    "price" => $serviceDetail->price,
                    "short_description" => $serviceDetail->short_description,
                    "photo" => $serviceDetail->image
                ]
            ];
            session()->put('cart', $cart);
            return redirect('cart')->with('success', 'Product added to cart successfully!');
        }
        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $serviceDetail->name,
            "uuid" => $serviceDetail->uuid,
            "service_id" => $service_id,
            "service_price" => $service->service_price,
            "quantity" => 1,
            "price" => $serviceDetail->price,
            "short_description" => $serviceDetail->short_description,
            "photo" => $serviceDetail->image
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function cart()
    {
        // $coupon = Coupon::all();
        // $userId =  Auth::user()->id;
        // $saldo = Wallet::where('user_id', $userId)->first();
        return view('frontend.cart.cart');
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

        $provinces = Province::all();
        $cart = session()->get('cart');
        $brands = Brand::all();
        if (!$cart) {
            return redirect('/cart')->with('success', 'Cart is Empty');
        } else {
            // $userId =  Auth::user()->id;
            // $saldo = Wallet::where('user_id', $userId)->first();
            // return $provinces;
            return view('frontend.cart.checkout', compact('provinces', 'brands'));
        }
    }

    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("province_id", $request->province_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }

    public function fetchModel(Request $request)
    {
        $data['carmodel'] = CarModel::where("brand_id", $request->brand_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }
}
