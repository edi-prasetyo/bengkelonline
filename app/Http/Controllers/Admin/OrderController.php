<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->paginate(10);
        return view('admin.order.index', compact('orders'));
    }
    public function service()
    {
        $services = Service::orderBy('id', 'asc')->paginate(10);
        $serviceItems = ServiceItem::all();
        // return $serviceItems;
        return view('admin.order.service', compact('services', 'serviceItems'));
    }
    public function detail(int $id)
    {
        $service = Service::where('id', $id)->first();
        $service_id = $service->id;
        $serviceItem = ServiceItem::where('service_id', $service_id)->get();

        // return $serviceItem;
        return view('admin.order.detail', compact('service', 'serviceItem'));
    }
    public function show(int $order_id)
    {
        $order = Order::findOrFail($order_id);

        $order_items = OrderItem::where('order_id', $order_id)
            ->join('services', 'services.id', '=', 'order_items.service_id')
            ->select('order_items.*', 'services.name as service_name', 'services.service_price as service_price')
            ->get();
        return view('admin.order.show', compact('order', 'order_items'));
    }
    // Start Cart Session
    public function addToAdminCart($uuid)
    {
        $serviceDetail = ServiceItem::where('uuid', $uuid)->first();
        $id = $serviceDetail->id;
        $service_id = $serviceDetail->service_id;
        $service = Service::where('id', $service_id)->first();
        if (!$service) {
            abort(404);
        }
        $admincart = session()->get('admincart');
        // if cart is empty then this the first product
        if (!$admincart) {
            $admincart = [
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
            session()->put('admincart', $admincart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
            // return redirect('admin/orders/admincart')->with('success', 'Product added to cart successfully!');
        }
        // if cart not empty then check if this product exist then increment quantity
        if (isset($admincart[$id])) {
            $admincart[$id]['quantity']++;
            session()->put('admincart', $admincart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if item not exist in cart then add to cart with quantity = 1
        $admincart[$id] = [
            "name" => $serviceDetail->name,
            "uuid" => $serviceDetail->uuid,
            "service_id" => $service_id,
            "service_price" => $service->service_price,
            "quantity" => 1,
            "price" => $serviceDetail->price,
            "short_description" => $serviceDetail->short_description,
            "photo" => $serviceDetail->image
        ];
        session()->put('admincart', $admincart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function admincart()
    {
        // $coupon = Coupon::all();
        // $userId =  Auth::user()->id;
        // $saldo = Wallet::where('user_id', $userId)->first();
        return view('admin.order.admincart');
    }
    public function update(Request $request)
    {
        if ($request->id and $request->quantity) {
            $admincart = session()->get('admincart');
            $admincart[$request->id]["quantity"] = $request->quantity;
            session()->put('admincart', $admincart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $admincart = session()->get('admincart');
            if (isset($admincart[$request->id])) {
                unset($admincart[$request->id]);
                session()->put('admincart', $admincart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }




    // End Cart






    public function confirmation(Request $request, int $order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->payment_status = $request['payment_status'];
        $order->status = $request['status'];
        $order->update();
        return redirect()->back()->with('message', 'Pembayaran Terkonfirmasi!');
    }
}
