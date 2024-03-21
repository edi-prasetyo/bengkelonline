<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InventoryController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.inventory.index', compact('services'));
    }
    public function item($id)
    {
        $service_items = ServiceItem::where(['service_id' => $id, 'internal' => 1])->paginate(50);

        return view('admin.inventory.item', compact('service_items'));
    }
    public function stock($service_item_id)
    {
        $service_item = ServiceItem::orderBy('id', 'desc')->where('id', $service_item_id)->first();
        $inventories = Inventory::orderBy('id', 'desc')->where('service_item_id', $service_item_id)->paginate(20);
        return view('admin.inventory.stock', compact('service_item', 'inventories'));
    }
    public function create($service_item_id)
    {
        $service_item = ServiceItem::where('id', $service_item_id)->first();
        return view('admin.inventory.create', compact('service_item'));
    }
    public function store(Request $request, $service_item_id)
    {
        $uuid = Str::uuid();

        $service_item = Inventory::orderBy('id', 'desc')->where('service_item_id', $service_item_id)->first();
        // $stock = $service_item->stock;
        $incoming = $request['incoming'];

        $finalstock = $service_item->stock +  $incoming;

        $inventory = new Inventory();

        $inventory->user_id = Auth::user()->id;
        $inventory->user_name = Auth::user()->name;
        $inventory->uuid = $uuid;
        $inventory->service_item_id = $service_item_id;
        $inventory->date = $request['date'];
        $inventory->description = $request['description'];
        $inventory->incoming = $incoming;
        $inventory->outcoming = 0;
        $inventory->stock = $finalstock;

        $inventory->save();

        // $service_item->stock = $finalstock;
        // $service_item->update();

        return redirect('admin/inventories/stock/' . $service_item_id)->with('message', 'Data Stok telah di tambahkan');
    }
}
