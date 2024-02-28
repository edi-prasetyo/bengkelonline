<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Brand;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Province;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\User;
use App\Models\UserCar;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->select('orders.*', 'users.name as order_name')
            ->paginate(10);
        // return $orders;
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
        // return $order_items;
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
        return view('admin.order.admincart');
    }
    public function update(Request $request)
    {
        if ($request->id and $request->price) {
            $admincart = session()->get('admincart');
            $admincart[$request->id]["price"] = $request->price;
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

    public function admincheckout()
    {
        $brands = Brand::all();
        // $customers = User::where('role', 4)->get();
        $customers = User::where('role', 4)->get();
        $admincart = session()->get('admincart');
        if (!$admincart) {
            return redirect('/admin/orders/service')->with('success', 'Cart is Empty');
        } else {
            return view('admin.order.admincheckout', compact('customers', 'brands'));
        }
    }
    public function adminOrder(Request $request)
    {
        $user_id = $request['user_id'];
        $customer = User::where('id', $user_id)->first();
        $userDetail = UserDetail::where('user_id', $user_id)->first();
        $province_id = $userDetail->province_id;
        $city_id = $userDetail->city_id;

        $province = Province::where('id', $province_id)->first();
        $city = City::where('id', $city_id)->first();

        $userCar = UserCar::where('user_id', $user_id)->first();

        $code = Str::uuid()->toString(50);
        $invoice_number = random_int(100000, 999999);
        $order = new Order;

        $down_payment = $request['down_payment'];
        $grand_total = $request['grand_total'] - $down_payment;

        $order->user_id = $user_id;
        $order->full_name = $customer->name;
        $order->email = $customer->email;
        $order->phone_number = $customer->whatsapp;
        $order->invoice = $invoice_number;
        $order->code = $code;
        $order->province = $province->name;
        $order->city = $city->name;
        $order->brand = $userCar->brand;
        $order->platnumber = $userCar->platnumber;
        $order->model = $userCar->model;
        $order->year = $userCar->year;
        $order->schedule_date = $request['schedule_date'];
        $order->schedule_time = $request['schedule_time'];
        $order->down_payment = $down_payment;
        $order->grand_total = $grand_total;
        $order->payment_method = $request['payment_method'];
        $order->payment_status = $request['payment_status'];
        $order->home_service = $request['home_service'];
        $order->status = $request['status'];
        $order->kilometer = $request['kilometer'];
        $order->address = $request['address'];

        $order->save();

        $admincart = session()->get('admincart');
        if (!$admincart) {
            return redirect('/admin/orders/services')->with('message', 'Cart Empty');
        } else {
            foreach ($admincart as $cart_item) {
                $data[] = [
                    'service_id' => $cart_item['service_id'],
                    'order_id' => $order->id,
                    'quantity' => $cart_item['quantity'],
                    'name' => $cart_item['name'],
                    'price' => $cart_item['price'],
                    'service_price' => $cart_item['service_price'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
        }
        DB::table('order_items')->insert($data);
        $request->session()->forget('admincart');

        return redirect('admin/orders/' . $order->id)->with('message', 'Order Berhasil Di Tambahkan');
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

        return view('admin.order.success', compact('order', 'order_items'));
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

    // Fetch User
    public function fetchCar(Request $request)
    {
        $data['usercars'] = UserCar::where("user_id", $request['user_id'])
            ->get(["id", "model",  "varian", "platnumber", "year"]);

        return response()->json($data);
    }
    // $request->user_id

    // Load Pdf
    public function invoice($order_id)
    {

        $order = Order::where('id', $order_id)->first();
        $order_items = OrderItem::where('order_id', $order_id)
            ->join('services', 'services.id', '=', 'order_items.service_id')
            ->select('order_items.*', 'services.name as service_name', 'services.service_price as service_price')
            ->get();
        $banks = Bank::all();

        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'order' => $order,
            'order_items' => $order_items,
            'banks' => $banks
        ];

        $pdf = Pdf::loadView('admin.order.invoice', $data);
        return $pdf->download($order->invoice . '.pdf');

        // return view('admin.order.invoice', $data);
    }
}
