<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PassportController extends Controller
{
  public function register(Request $request)
  {
    $validateData = $request->validate([
      'name' => 'required|max:55',
      'email' => 'email|required|unique:users',
      'password' => 'required|confirmed',
      'address' => 'nullable',
      'phone' => 'nullable',
      'role' => 'nullable',
    ]);

    $validateData['password'] = bcrypt($request->password);

    $user = User::create($validateData);

    $accessToken = $user->createToken('authToken')->accessToken;

    return response(['user' => $user, 'access_token' => $accessToken]);
  }

  public function login(Request $request)
  {
    $loginData = $request->validate([
      'email' => 'email|required',
      'password' => 'required'
    ]);

    if (!auth()->attempt($loginData)) {
      return response(['message' => 'Invalid Credentials']);
    }

    $accessToken = auth()->user()->createToken('authToken')->accessToken;
    return response(['user' => auth()->user(), 'access_token' => $accessToken]);
  }

  public function checkuser()
  {
    // $user  = Auth::user();
    // Log::debug($user);
    // return $user['role'];
    if (Auth::check()) {
      Log::debug("True");
    } else {
      Log::debug("False");
    }
  }

  public function getAllUsers(Request $request)
  {
    $users = User::when($request->searchKey, function ($q) use ($request) {
      $q->where($request->searchType, 'LIKE', '%' . $request->searchKey . '%');
    })->paginate(10);
    // dd($request);
    // $users = User::where($request->searchType, 'LIKE', '%' . $request->searchKey . '%')
    // ->paginate(10);

    return response([
      'data' => $users
      // 'data' => $request
    ]);
  }

  public function getUser($id)
  {
    return User::findOrFail($id);
  }

  public function updateUser(Request $request, $id)
  {
    return User::whereId($id)->update($request->all());
  }

  public function getUserByRole($role)
  {
    if ($role == "all") {
      // $users = User::all();
      $users = User::paginate(10);
    } else {
      // $users = User::where('role', $role)->get();
      $users = User::where('role', $role)->paginate(10);
    }
    return response(
      [
        'data' => $users
      ]
    );
  }

  public function deleteUser($id)
  {
    return [
      'data' => User::destroy($id)
    ];
  }
}
