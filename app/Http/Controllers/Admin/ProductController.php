<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\ProductFormRequest;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Models\TagParrent;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(10);
        // $taglist = TagParrent::where('product_id', $product_id)->get();
        return view('admin.products.index', compact('products'));
    }
    public function create()
    {
        $categories = Category::all();
        // dd($categories);
        return view('admin.products.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $slugRequest = Str::slug($request['name']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $category = Category::findOrFail($request['category_id']);


        $product = new Product;
        $product->category_id = $request['category_id'];
        $product->name = $request['name'];
        if (Product::where('slug', $slugRequest)->exists()) {
            $product->slug = $slug;
        } else {
            $product->slug = $slugRequest;
        }
        $product->description = $request['description'];
        $product->price_product = $request['price_product'];
        $product->price_service = $request['price_service'];
        $category->status = $request->status == true ? '1' : '0';
        $product->meta_title = $request['meta_title'];
        $product->meta_description = $request['meta_description'];
        $product->meta_keyword = $request['meta_keyword'];


        $uploadPath = 'uploads/products/';
        if ($request->hasFile('image_cover')) {
            $file = $request->file('image_cover');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/products/', $filename);
            $product->image_cover = $uploadPath . $filename;
        }

        $product->save();

        if ($request->hasFile('image')) {
            $uploadPath = 'uploads/products/';
            $i =  1;
            foreach ($request->file('image') as $imageFile) {
                $extention = $imageFile->getClientOriginalExtension();
                $filename = time() . $i++ . '.' . $extention;
                $imageFile->move($uploadPath, $filename);
                $finalImanePathName = $uploadPath  . $filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImanePathName,
                ]);
            }
        }

        return redirect('admin/products')->with('message', 'Product Added Succesfully!');
    }

    public function edit(int $product_id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($product_id);
        // return $tags;
        return view('admin.products.edit', compact('categories', 'product'));
    }
    public function update(ProductFormRequest $request, int $product_id)
    {
        $validatedData = $request->validated();
        $category = Category::findOrFail($request['category_id']);
        $product = Category::findOrFail($validatedData['category_id'])
            ->products()->where('id', $product_id)->first();
        if ($product) {
            $product->update([

                $product->description = $request['description'],
                $product->price_product = $request['price_product'],
                $product->price_service = $request['price_service'],
                $category->status = $request->status == true ? '1' : '0',
                $product->meta_title = $request['meta_title'],
                $product->meta_description = $request['meta_description'],
                $product->meta_keyword = $request['meta_keyword'],


            ]);

            $uploadPath = 'uploads/products/';
            if ($request->hasFile('image_cover')) {

                $path = 'uploads/products/' . $product->image_cover;
                if (File::exists($path)) {
                    File::delete($path);
                }

                $file = $request->file('image_cover');
                $ext = $file->getClientOriginalExtension();
                $filename = time() . '.' . $ext;
                $file->move('uploads/products/', $filename);
                $category->image_cover = $uploadPath . $filename;
            }

            if ($request->hasFile('image')) {
                $uploadPath = 'uploads/products/';
                $i =  1;
                foreach ($request->file('image') as $imageFile) {
                    $extention = $imageFile->getClientOriginalExtension();
                    $filename = time() . $i++ . '.' . $extention;
                    $imageFile->move($uploadPath, $filename);
                    $finalImanePathName = $uploadPath  . $filename;

                    $product->productImages()->create([
                        'product_id' => $product->id,
                        'image' => $finalImanePathName,
                    ]);
                }
            }

            return redirect('admin/products')->with('message', 'Product Updated Succesfully!');
        } else {
            return redirect('admin/products')->with('message', 'No Such Product ID Found ');
        }
    }
    public function destroyImage(int $product_image_id)
    {
        $productImage = ProductImage::findOrFail($product_image_id);
        if (File::exists($productImage->image)) {
            File::delete($productImage->image);
        }
        $productImage->delete();
        return redirect()->back()->with('message', 'Product Image Deleted!');
    }
    public function destroy(int $product_id)
    {
        $product = Product::findOrFail($product_id);
        if ($product->productImages) {
            foreach ($product->productImages as $image) {
                if (File::exists($image->image)) {
                    File::delete($image->image);
                }
            }
        }
        $product->delete();
        return redirect()->back()->with('message', 'Services was Deleted!');
    }
}
