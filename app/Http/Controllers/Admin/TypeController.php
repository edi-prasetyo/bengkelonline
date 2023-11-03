<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeFormRequest;
use App\Models\Category;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::orderBy('id', 'DESC')->paginate(10);
        return view('admin.type.index', compact('types'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.type.create', compact('categories'));
    }
    public function store(TypeFormRequest $request)
    {
        $validatedData = $request->validated();

        $slugRequest = Str::slug($validatedData['name']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $type = new Type;
        $type->name = $validatedData['name'];
        $type->category_id = $validatedData['category_id'];
        if (Type::where('slug', $slugRequest)->exists()) {
            $type->slug = $slug;
        } else {
            $type->slug = $slugRequest;
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/brand/', $filename);
            $type->image = $filename;
        }
        $type->status = $request->status == true ? '1' : '0';

        $type->save();
        return redirect('admin/types')->with('message', 'Type Has Added');
    }
    public function edit(Type $brand)
    {
        return view('admin.type.edit', compact('brand'));
    }
    public function update(TypeFormRequest $request, $brand)
    {
        $validatedData = $request->validated();
        $brand = Type::findOrFail($brand);

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
        return redirect('admin/types')->with('message', 'Brand update Succesfully');
    }
}
