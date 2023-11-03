<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Type;

class CategoryController extends Controller
{
    public $category_id;
    public function index()
    {
        $categories =  Category::orderBy('id', 'DESC')->paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function fetchType(Request $request)
    {
        $data['types'] = Type::where("category_id", $request->category_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }

    public function create()
    {
        return view('admin.category.create');
    }
    public function store(CategoryFormRequest $request)
    {
        $validatedData = $request->validated();

        $slugRequest = Str::slug($validatedData['name']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $category = new Category;
        $category->name = $validatedData['name'];
        if (Category::where('slug', $slugRequest)->exists()) {
            $category->slug = $slug;
        } else {
            $category->slug = $slugRequest;
        }
        $category->description = $validatedData['description'];

        $uploadPath = 'uploads/category/';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/category/', $filename);
            $category->image = $uploadPath . $filename;
        }

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_description = $validatedData['meta_description'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->status = $request->status == true ? '1' : '0';

        $category->save();
        return redirect('admin/category')->with('message', 'Category Has Added');
    }
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }
    public function update(CategoryFormRequest $request, $category)
    {
        $validatedData = $request->validated();
        $category = Category::findOrFail($category);

        $category->name = $validatedData['name'];
        $category->description = $validatedData['description'];

        $uploadPath = 'uploads/category/';
        if ($request->hasFile('image')) {

            $path = 'uploads/category/' . $category->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/category/', $filename);
            $category->image = $uploadPath . $filename;
        }

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_description = $validatedData['meta_description'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->status = $request->status == true ? '1' : '0';

        $category->update();
        return redirect('admin/category')->with('message', 'Category update Succesfully');
    }

    public function destroy(Category $category)
    {
        if ($category->count() > 0) {

            $destination = $category->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $category->delete();
            return redirect()->back()->with('message', 'Image Category Delete Succesfully!');
        }
        return redirect()->back()->with('message', 'Someting Went Wrong');
    }
}
