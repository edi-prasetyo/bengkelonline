<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::where('status', 1)->paginate(10);
        return view('admin.province.index', compact('provinces'));
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
        $slugRequest = Str::slug($request['name']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $province = new Province();

        if (Province::where('slug', $slugRequest)->exists()) {
            $province->slug = $slug;
        } else {
            $province->slug = $slugRequest;
        }
        $province->name = $request['name'];
        $province->status = $request->status == true ? '1' : '0';

        $province->save();
        return redirect()->back()->with('messsage', 'Provinsi berhasi di buat');
    }
    public function edit($province)
    {
    }
    public function update(Request $request)
    {
    }
    public function destroy()
    {
    }

    // Function City
    public function city($id)
    {
        $province = Province::where('id', $id)->first();
        $cities = City::where(['province_id' => $id, 'status' => 1])->paginate(10);
        return view('admin.province.city', compact('province', 'cities'));
    }
    public function store_city(Request $request)
    {
        $slugRequest = Str::slug($request['name']);
        $code = random_int(00, 99);
        $slug = $slugRequest . '-' . $code;

        $city = new City();

        if (City::where('slug', $slugRequest)->exists()) {
            $city->slug = $slug;
        } else {
            $city->slug = $slugRequest;
        }
        $city->province_id = $request['province_id'];
        $city->name = $request['name'];
        $city->status = $request->status == true ? '1' : '0';

        $city->save();
        return redirect()->back()->with('messsage', 'Kota berhasi di buat');
    }
    public function edit_city()
    {
    }
    public function update_city(Request $request)
    {
    }
    public function destroy_city()
    {
    }
}
