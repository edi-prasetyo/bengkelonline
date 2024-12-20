<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceFormRequest;
use App\Http\Requests\ServiceItemFormRequest;
use App\Models\Inventory;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('id', 'ASC')->paginate(10);
        return view('admin.service.index', compact('services'));
    }
    public function create()
    {
        return view('admin.service.create');
    }
    public function store(ServiceFormRequest $request)
    {
        $validatedData = $request->validated();
        $uuid = Str::uuid();
        $slugRequest = Str::slug($request['name']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $service = new Service;

        if (Service::where('slug', $slugRequest)->exists()) {
            $service->slug = $slug;
        } else {
            $service->slug = $slugRequest;
        }
        $service->uuid = $uuid;
        $service->name = $validatedData['name'];
        $service->description = $validatedData['description'];
        $service->service_price = $validatedData['service_price'];

        $uploadPath = 'uploads/service/';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/service/', $filename);
            $service->image = $uploadPath . $filename;
        }

        $service->status = $request->status == true ? '1' : '0';
        $service->save();
        return redirect('admin/services')->with('message', 'Jasa telah di tambahkan');
    }

    public function edit(Service $service)
    {
        // $service = Service::where('id', $service)->first();
        // return $service;
        return view('admin.service.edit', compact('service'));
    }
    public function update(Request $request, int $id)
    {
        $service = Service::where('id', $id)->first();
        // return $service;

        $service->name = $request['name'];
        $service->description = $request['description'];
        $service->service_price = $request['service_price'];

        $uploadPath = 'uploads/service/';
        if ($request->hasFile('image')) {

            $path = $service->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/service/', $filename);
            $service->image = $uploadPath . $filename;
        }
        $service->status = $request->status == true ? '1' : '0';
        $service->update();
        return redirect('admin/services')->with('message', 'Jasa telah di update');
    }

    public function show(int $service_id)
    {
        $service = Service::where('id', $service_id)->first();
        $serviceItems = ServiceItem::where('service_id', $service_id)->get();
        return view('admin.service.show', compact('service', 'serviceItems'));
    }
    public function add_item(ServiceItemFormRequest $request)
    {
        $validatedData = $request->validated();
        $uuid = Str::uuid();
        $slugRequest = Str::slug($request['name']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $serviceItem = new ServiceItem;

        if (Service::where('slug', $slugRequest)->exists()) {
            $serviceItem->slug = $slug;
        } else {
            $serviceItem->slug = $slugRequest;
        }
        $serviceItem->uuid = $uuid;
        $serviceItem->service_id = $validatedData['service_id'];
        $serviceItem->name = $validatedData['name'];
        $serviceItem->description = $validatedData['description'];
        $serviceItem->price = $validatedData['price'];
        $serviceItem->meta_title = $validatedData['meta_title'];
        $serviceItem->meta_description = $validatedData['meta_description'];
        $serviceItem->meta_keyword = $validatedData['meta_keyword'];

        $uploadPath = 'uploads/service/';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/service/', $filename);
            $serviceItem->image = $uploadPath . $filename;
        }

        $serviceItem->status = $request->status == true ? '1' : '0';
        $serviceItem->internal = $request->internal == true ? '1' : '0';
        $serviceItem->save();


        $inventory = new Inventory();
        $inventory->user_id = Auth::user()->id;
        $inventory->user_name = Auth::user()->name;
        $inventory->uuid = $uuid;
        $inventory->service_item_id = $serviceItem->id;
        $inventory->date = $serviceItem->created_at;
        $inventory->description = 'Initial Stock - ' . $serviceItem->name;
        $inventory->incoming = 0;
        $inventory->outcoming = 0;
        $inventory->stock = 0;
        $inventory->save();

        return redirect()->back()->with('message', '<div class="alert alert-success">data Item telah di tambahkan</div>');
    }

    public function editItem(int $item_id)
    {
        $serviceItem = ServiceItem::where('id', $item_id)->first();
        return view('admin.service.edit_item', compact('serviceItem'));
    }
    public function updateItem(Request $request, int $item_id)
    {

        $serviceItem = ServiceItem::where('id', $item_id)->first();

        $serviceItem->name = $request['name'];
        $serviceItem->price = $request['price'];
        $serviceItem->description = $request['description'];
        $serviceItem->meta_title = $request['meta_title'];
        $serviceItem->meta_description = $request['meta_description'];
        $serviceItem->meta_keyword = $request['meta_keyword'];

        $uploadPath = 'uploads/service/';
        if ($request->hasFile('image')) {

            $path = $serviceItem->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/service/', $filename);
            $serviceItem->image = $uploadPath . $filename;
        }
        $serviceItem->status = $request->status == true ? '1' : '0';
        $serviceItem->internal = $request->internal == true ? '1' : '0';
        $serviceItem->update();
        return redirect('admin/services/show/' . $serviceItem->service_id)->with('message', 'Jasa telah di update');
    }

    public function destroy(int $service_id)
    {
        $service = Service::findOrFail($service_id);
        $path = $service->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $service->delete();
        return redirect()->back()->with('message', 'Product and Image was Deleted!');
    }
    public function destroy_item(int $item_id)
    {
        $serviceItem = ServiceItem::findOrFail($item_id);
        $path = $serviceItem->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $serviceItem->delete();
        return redirect()->back()->with('message', '<div class="alert alert-danger">Service Item was Deleted!</div>');
    }
}
