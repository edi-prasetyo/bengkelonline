<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Wallet;
use App\Models\Walletlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PDF;

class OrderController extends Controller
{
    public function orders(Request $request)
    {

        $code = Str::uuid()->toString(50);
        $invoice_number = random_int(100000, 999999);
        $order = new Order;
        $order->user_id = $request['user_id'];
        $order->full_name = $request['full_name'];
        // $order->customer_email = $request['customer_email'];
        $order->phone_number = $request['phone_number'];
        $order->invoice = $invoice_number;
        $order->code = $code;
        // $order->discount = $request['discount'];
        $order->province = $request['province'];
        $order->city = $request['city'];
        $order->grand_total = $request['grand_total'];
        $order->payment_method = $request['payment_method'];
        $order->payment_status = $request['payment_status'];
        $order->home_service = $request['home_service'];
        $order->status = $request['status'];
        $order->address = $request['address'];

        $order->save();

        $cart = session()->get('cart');
        if (!$cart) {
            return redirect('services/')->with('message', 'Cart Empty');
        } else {
            foreach ($cart as $cart_item) {
                $data[] = [
                    'service_id' => $cart_item['service_id'],
                    'order_id' => $order->id,
                    'quantity' => 1,
                    'name' => $cart_item['name'],
                    'price' => $cart_item['price'],
                    'service_price' => $cart_item['service_price'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
        }
        DB::table('order_items')->insert($data);
        $request->session()->forget('cart');


        return redirect('orders/success/' . $order->code)->with('message', 'Order Successfully');
    }

    public function success($code)
    {
        $order = Order::where('code', $code)->first();
        $order_id = $order->id;
        $order_items = DB::table('order_items')->where('order_id', $order_id)
            ->join('services', 'services.id', '=', 'order_items.service_id')
            ->select('order_items.*', 'services.name as service_name', 'services.service_price as service_price')
            ->get();
        // return $order_items;
        return view('frontend.cart.success', compact('order', 'order_items'));
    }


    function payment($code)
    {
        $order = Order::where('code', $code)->first();
        $order_id = $order->id;
        $banks = Bank::all();
        $order_items = DB::table('order_items')->where('order_id', $order_id)
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->select('order_items.*', 'products.name as product_name', 'products.price as product_price', 'products.short_description as product_description')
            ->get();
        // return $order;
        return view('frontend.member.payment', compact('order', 'order', 'order_items', 'banks'));
    }
}
