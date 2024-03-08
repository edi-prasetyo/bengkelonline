<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::orderBy('id', 'asc')->paginate(10);
        return view('admin.invoice.index', compact('invoices'));
    }
    public function order()
    {
        $orders = Order::where('payment_status', 0)->paginate(10);
        return view('admin.invoice.order', compact('orders'));
    }
    // Start Cart Session
    public function addToCartInvoice($id)
    {
        $orderDetail = Order::where('id', $id)->first();
        // $id = $orderDetail->id;
        // $service_id = $serviceDetail->service_id;
        // $service = Service::where('id', $service_id)->first();
        // if (!$service) {
        //     abort(404);
        // }
        $invoicecart = session()->get('invoicecart');
        // if cart is empty then this the first product
        if (!$invoicecart) {
            $invoicecart = [
                $id => [
                    "order_id" => $orderDetail->id,
                    "fullname" => $orderDetail->fullname,
                    "uuid" => $orderDetail->uuid,

                    "grand_total" => $orderDetail->grand_total,
                    "quantity" => 1,
                ]
            ];
            session()->put('invoicecart', $invoicecart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
            // return redirect('admin/orders/invoicecart')->with('success', 'Product added to cart successfully!');
        }
        // if cart not empty then check if this product exist then increment quantity
        if (isset($invoicecart[$id])) {
            $invoicecart[$id]['quantity']++;
            session()->put('invoicecart', $invoicecart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if item not exist in cart then add to cart with quantity = 1
        $invoicecart[$id] = [
            "order_id" => $orderDetail->id,
            "name" => $orderDetail->name,
            "uuid" => $orderDetail->uuid,
            "grand_total" => $orderDetail->grand_total,
            "quantity" => 1,
        ];
        session()->put('invoicecart', $invoicecart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function remove(Request $request)
    {
        if ($request->id) {
            $invoicecart = session()->get('invoicecart');
            if (isset($invoicecart[$request->id])) {
                unset($invoicecart[$request->id]);
                session()->put('invoicecart', $invoicecart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
    public function invoicecheckout()
    {
        // $brands = Brand::all();
        // $customers = User::where('role', 4)->get();
        $customers = User::where('role', 4)->get();
        $invoicecart = session()->get('invoicecart');
        if (!$invoicecart) {
            return redirect('/admin/orders/service')->with('success', 'Cart is Empty');
        } else {
            return view('admin.order.admincheckout', compact('customers', 'brands'));
        }
    }
}
