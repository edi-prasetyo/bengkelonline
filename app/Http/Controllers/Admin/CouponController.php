<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponFormRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::orderBy('id', 'DESC')->paginate(10);
        return view('admin.coupon.index', compact('coupons'));
    }
    public function create()
    {
        return view('admin.coupon.create');
    }
    public function store(CouponFormRequest $request)
    {
        $validatedData = $request->validated();

        $coupon = new Coupon;
        $coupon->name = $validatedData['name'];
        $coupon->description = $validatedData['description'];
        $coupon->code = $validatedData['code'];
        $coupon->start_date = $validatedData['start_date'];
        $coupon->end_date = $validatedData['end_date'];
        $coupon->amount = $validatedData['amount'];
        $coupon->max_redemtions = $validatedData['max_redemtions'];
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/coupon/', $filename);
            $coupon->image = $filename;
        }
        $coupon->status = $request->status == true ? '1' : '0';

        $coupon->save();
        return redirect('admin/coupons')->with('message', 'coupon Has Added');
    }
    public function edit(Coupon $coupon)
    {
        return view('admin.coupon.edit', compact('coupon'));
    }
    public function update(CouponFormRequest $request, $coupon)
    {
        $validatedData = $request->validated();
        $coupon = Coupon::findOrFail($coupon);

        $coupon->name = $validatedData['name'];
        $coupon->description = $validatedData['description'];
        $coupon->code = $validatedData['code'];
        $coupon->start_date = $validatedData['start_date'];
        $coupon->end_date = $validatedData['end_date'];
        $coupon->amount = $validatedData['amount'];

        if ($request->hasFile('image')) {

            $path = 'uploads/coupon/' . $coupon->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/coupon/', $filename);
            $coupon->image = $filename;
        }
        $coupon->status = $request->status == true ? '1' : '0';

        $coupon->update();
        return redirect('admin/coupons')->with('message', 'coupon update Succesfully');
    }
}
