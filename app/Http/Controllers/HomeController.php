<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $count_orders = Order::where('user_id', $userId)->count();
        return view('home', compact('count_orders'));
    }
    public function orders()
    {
        $userId = Auth::user()->id;
        $orders = Order::where('user_id', $userId)->orderBy('id', 'desc')->paginate(7);
        return view('frontend.member.order', compact('orders'));
    }
    public function order_detail($code)
    {
        $order_detail = Order::where('code', $code)->first();
        $product_items = OrderItem::where('order_id', $order_detail->id)
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->select('order_items.*', 'products.name as product_name', 'products.price as product_price', 'products.file_download', 'products.short_description as product_description')
            ->get();
        // return $product_items;

        return view('frontend.member.order_detail', compact('order_detail', 'product_items'));
    }

    function downloadFile($file_download)
    {

        $file_path = public_path('downloads/' . $file_download);
        return response()->download($file_path);
    }

    public function struk(Request $request)
    {
        $order_id = $request['order_id'];
        $order = Order::findOrFail($order_id);
        $order->status = 1;

        if ($request->hasFile('struk')) {
            $file = $request->file('struk');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/struk/', $filename);
            $order->struk = $filename;
        }

        $order->update();
        return redirect('member/orders/detail/' . $order->code)->with('message', 'Order Successfully');
    }
    public function profile()
    {
        $userId = Auth::user()->id;
        $user = User::findOrFail($userId);
        return $user;
    }
    public function upgrade()
    {
        return view('frontend.member.upgrade');
    }
    public function upgrade_store(Request $request)
    {
        return view('frontend.member.upgrade');
    }
}
