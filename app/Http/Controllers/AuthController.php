<?php

namespace App\Http\Controllers;

use App\Models\DistrictMetaData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
  public function login()
  {
    return view('auth.login');
  }

  public function postLogin(Request $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->remember)) {
      $request->session()->regenerate();

      $current_user_role = Auth::user()->role;

      $parameter = [
        'email' => $request['email'],
        'password' => $request['password']
      ];

      return redirect('/admin')->with($parameter);
    }
    return back()->withInput()->withErrors(
      [
        'email' => 'The provided credentials do not match our records.',
      ]
    );
  }

  public function getRegister()
  {
    $districts = DistrictMetaData::get();
    return view('auth.register', compact('districts'));
  }

  public function register(Request $request)
  {
    $request->validate([
      'name' => ['required'],
      'email' => ['required', 'email', 'unique:users,email'],
      'role' => ['required'],
      'district_id' => ['required'],
      'password' => ['required', 'confirmed', 'min:6'],
      'address' => ['required'],
      'phone' => ['required', 'unique:users,phone'],
    ]);
    info($request->all());

    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;
    $user->phone = $request->phone;
    $user->address = $request->address;
    $user->district_meta_data_id = $request->district_id;
    $user->password = bcrypt($request->password);
    $user->save();

    $request->session()->regenerate();

    $parameter = [
      'email' => $request['email'],
      'password' => $request['password']
    ];

    Auth::login($user);
    return redirect('/admin')->with($parameter);
  }
}
