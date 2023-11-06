<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BrandFormRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Brand;
use App\Models\CarModel;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        $countModels = CarModel::all();
        return view('admin.brand.index', compact('brands', 'countModels'));
    }
    public function create()
    {
        return view('admin.brand.create');
    }
    public function store(BrandFormRequest $request)
    {
        $validatedData = $request->validated();

        $slugRequest = Str::slug($validatedData['name']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $brand = new Brand;
        $brand->name = $validatedData['name'];
        if (Brand::where('slug', $slugRequest)->exists()) {
            $brand->slug = $slug;
        } else {
            $brand->slug = $slugRequest;
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/brand/', $filename);
            $brand->image = $filename;
        }
        $brand->status = $request->status == true ? '1' : '0';

        $brand->save();
        return redirect('admin/brands')->with('message', 'Brands Has Added');
    }
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }
    public function update(BrandFormRequest $request, $brand)
    {
        $validatedData = $request->validated();
        $brand = Brand::findOrFail($brand);

        $brand->name = $validatedData['name'];

        if ($request->hasFile('image')) {

            $path = 'uploads/brand/' . $brand->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/brand/', $filename);
            $brand->image = $filename;
        }
        $brand->status = $request->status == true ? '1' : '0';

        $brand->update();
        return redirect('admin/brands')->with('message', 'Brand update Succesfully');
    }

    public function show(int $brand_id)
    {
        $brand = Brand::where('id', $brand_id)->first();
        $carModels = CarModel::where('brand_id', $brand_id)->get();

        return view('admin.brand.show', compact('brand', 'carModels'));
    }
    public function add_model(Request $request)
    {
        $slugRequest = Str::slug($request['name']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $carModel = new CarModel;
        $carModel->name = $request['name'];
        if (CarModel::where('slug', $slugRequest)->exists()) {
            $carModel->slug = $slug;
        } else {
            $carModel->slug = $slugRequest;
        }
        $carModel->brand_id = $request['brand_id'];
        $carModel->status = $request->status == true ? '1' : '0';

        $carModel->save();
        return redirect()->back()->with('message', '<div class="alert alert-success">Car Model Create Succesfully!</div>');
    }
}
