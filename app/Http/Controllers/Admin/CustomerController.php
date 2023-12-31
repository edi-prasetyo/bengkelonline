<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerFormRequest;
use App\Models\Brand;
use App\Models\User;
use App\Models\UserCar;
use App\Models\UserDetail;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $usersCars = UserCar::all();
        $customers = User::where('role', 4)->paginate(10);
        // return $usersCars;
        return view('admin.customer.index', compact('customers', 'usersCars'));
    }
    public function store(CustomerFormRequest $request)
    {
        $validatedData = $request->validated();

        $password = $validatedData['password'];

        $user = new User;
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->whatsapp = $validatedData['whatsapp'];
        $user->password = Hash::make($password);
        $user->role = 4;

        $user->save();


        Wallet::create([
            'user_id' => $user->id,
            'amount'    => 0,
        ]);

        UserDetail::create([
            'user_id' => $user->id,
        ]);
        UserCar::create([
            'user_id' => $user->id,
        ]);

        return redirect()->back()->with('message', 'Customer Create Succesfully!');
    }
    public function car(User $user)
    {
        $cars = UserCar::where('user_id', $user->id)->paginate(5);
        $customer = User::where('id', $user->id)->first();
        $brands = Brand::all();



        return view('admin.customer.car', compact('cars', 'customer', 'brands', 'user'));
    }
    public function addCar(Request $request, int $user_id)
    {

        $brand_id = $request['brand_id'];
        $brand = Brand::where('id', $brand_id)->first();

        $userCar = new UserCar;

        $userCar->user_id = $user_id;
        $userCar->brand = $brand->name;
        $userCar->model = $request['car_model'];
        $userCar->varian = $request['varian'];
        $userCar->year = $request['car_year'];
        $userCar->platnumber = $request['platnumber'];

        $userCar->save();
        return redirect()->back()->with('success', 'Car added successfully!');
    }
}
