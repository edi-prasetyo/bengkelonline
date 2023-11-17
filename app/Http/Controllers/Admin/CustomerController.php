<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserCar;
use App\Models\UserDetail;
use App\Models\Wallet;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 4)->paginate(10);
        return view('admin.customer.index', compact('customers'));
    }
    public function create(Request $request)
    {
        $user = new User;
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->whatsapp = $request['whatsapp'];

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_as' => 4,
        ]);

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
    }
}
