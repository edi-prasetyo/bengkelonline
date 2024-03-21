<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\City;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Province;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::orderBy('id', 'desc')->paginate(10);
        return view('admin.invoice.index', compact('invoices'));
    }
    public function order()
    {
        $orders = Order::orderBy('id', 'desc')->where('status', 0)->paginate(10);
        return view('admin.invoice.order', compact('orders'));
    }
    // Start Cart Session
    public function addToCartInvoice($id)
    {
        $orderDetail = Order::where('id', $id)->first();
        $invoicecart = session()->get('invoicecart');
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
            $orderDetail->status = 1;
            $orderDetail->update();
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
            "fullname" => $orderDetail->name,
            "uuid" => $orderDetail->uuid,
            "grand_total" => $orderDetail->grand_total,
            "quantity" => 1,
        ];
        session()->put('invoicecart', $invoicecart);

        $orderDetail->status = 1;
        $orderDetail->update();

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


            $orderDetail = Order::where('id', $request->id)->first();
            $orderDetail->status = 0;
            $orderDetail->update();

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
            return redirect('/admin/invoices')->with('success', 'Cart is Empty');
        } else {
            return view('admin.invoice.invoicechekcout', compact('customers', 'invoicecart'));
        }
    }

    public function invoiceOrder(Request $request)
    {
        $user_id = $request['user_id'];
        $customer = User::where('id', $user_id)->first();
        $userDetail = UserDetail::where('user_id', $user_id)->first();
        $province_id = $userDetail->province_id;
        $city_id = $userDetail->city_id;

        $province = Province::where('id', $province_id)->first();
        $city = City::where('id', $city_id)->first();

        $total = $request['grand_total'];
        $down_payment = $request['down_payment'];
        $grand_total = $total - $down_payment;

        $code = Str::uuid()->toString(50);
        $invoice_number = random_int(100000, 999999);
        $invoice = new Invoice();


        $invoice->user_id = $user_id;
        $invoice->no_invoice = $invoice_number;
        $invoice->total = $total;
        $invoice->grand_total = $grand_total;
        $invoice->customer_name = $customer->name;
        $invoice->customer_whatsapp = $customer->whatsapp;
        $invoice->customer_address = $userDetail->address;

        $invoice->customer_province = $province->name;
        $invoice->customer_city = $city->name;


        $invoice->down_payment = $down_payment;
        $invoice->payment_method = $request['payment_method'];
        $invoice->payment_status = $request['payment_status'];


        $invoice->save();

        $invoicecart = session()->get('invoicecart');
        if (!$invoicecart) {
            return redirect('/admin/invoices/order')->with('message', 'Cart Empty');
        } else {
            foreach ($invoicecart as $cart_item) {
                $data[] = [
                    'order_id' => $cart_item['order_id'],
                    'invoice_id' => $invoice->id,
                    'total' => $cart_item['grand_total'],
                ];
            }
        }

        DB::table('invoice_items')->insert($data);

        $request->session()->forget('invoicecart');

        return redirect('admin/invoices/')->with('message', 'Invoice Berhasil Di Tambahkan');
    }

    public function show($id)
    {
        $invoice = Invoice::where('id', $id)->first();

        $invoice_item = InvoiceItem::select('invoice_items.*', 'orders.brand as car_brand', 'orders.model as car_model', 'orders.platnumber as car_number')
            ->join('orders', 'orders.id', '=', 'invoice_items.order_id')
            ->where('invoice_id', $invoice->id)
            ->get();
        $order_items  = OrderItem::all();
        // return $invoice_item;
        return view('admin.invoice.show', compact('invoice', 'invoice_item', 'order_items'));
    }

    public function download($invoice_id)
    {

        $invoice = Invoice::where('id', $invoice_id)->first();
        $invoice_items = InvoiceItem::select('invoice_items.*', 'orders.brand as car_brand', 'orders.model as car_model', 'orders.platnumber as car_number')
            ->where('invoice_id', $invoice_id)
            ->join('orders', 'orders.id', '=', 'invoice_items.order_id')
            ->get();
        $banks = Bank::all();

        $data = [
            'title' => 'Invoice Bengkel Online',
            'date' => date('m/d/Y'),
            'invoice' => $invoice,
            'invoice_items' => $invoice_items,
            'banks' => $banks
        ];

        $pdf = Pdf::loadView('admin.invoice.download', $data);
        return $pdf->download($invoice->id . '.pdf');
        // return $invoice;

        // return view('admin.invoice.download', $data);
    }
}
