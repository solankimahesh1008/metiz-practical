<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmployeeMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Country;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $countries = Country::pluck('name', 'id');
        return view('auth.register',compact('countries'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'employee_name' => 'required|string|max:255',
            'employee_code' => 'required|string|max:255|unique:employee_masters',
            'first_name'=> 'required|string|max:255',
            'last_name'=> 'required|string|max:255',
            'username'=> 'required|string|max:255|unique:employee_masters',
            'email'=> 'required|email|unique:employee_masters',
            'phone'=> 'required',
            'password' => 'required|string|min:6',
            'address'=> 'required',
            'country_id'=> 'required',
            'state_id'=> 'required',
            'city_id'=> 'required',
            'zip'=> 'required',
        ]);

        EmployeeMaster::create([
            'employee_name' => $request->employee_name,
            'employee_code' => $request->employee_code,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'zip' => $request->zip,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. You can now log in.');
    }
}
