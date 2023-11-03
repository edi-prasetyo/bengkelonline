<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BankFormRequest;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BankController extends Controller
{
    public function index()
    {
        $banks = Bank::orderBy('id', 'DESC')->paginate(10);
        return view('admin.bank.index', compact('banks'));
    }
    public function create()
    {
        return view('admin.bank.create');
    }
    public function store(BankFormRequest $request)
    {
        $validatedData = $request->validated();

        $bank = new Bank;
        $bank->name = $validatedData['name'];
        $bank->branch = $validatedData['branch'];
        $bank->account = $validatedData['account'];
        $bank->number = $validatedData['number'];
        if ($request->hasFile('bank_logo')) {
            $file = $request->file('bank_logo');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/logo/', $filename);
            $bank->bank_logo = $filename;
        }
        $bank->status = $request->status == true ? '1' : '0';

        $bank->save();
        return redirect('admin/banks')->with('message', 'Bank Has Added');
    }
    public function edit(Bank $bank)
    {
        return view('admin.bank.edit', compact('bank'));
    }
    public function update(BankFormRequest $request, $bank)
    {
        $validatedData = $request->validated();
        $bank = Bank::findOrFail($bank);

        $bank->name = $validatedData['name'];
        $bank->branch = $validatedData['branch'];
        $bank->account = $validatedData['account'];
        $bank->number = $validatedData['number'];

        if ($request->hasFile('image')) {

            $path = 'uploads/logo/' . $bank->bank_logo;
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/brand/', $filename);
            $bank->image = $filename;
        }
        $bank->status = $request->status == true ? '1' : '0';

        $bank->update();
        return redirect('admin/bank')->with('message', 'bank update Succesfully');
    }
}
