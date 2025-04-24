<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;

class AuthController extends \Illuminate\Routing\Controller
{
  public function index() {
    
  }
  
  public function login() {

  }

  public function register(Request $request) {
    try {
      $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
      ]);

      User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
      ]);

      return redirect('/')->with('success', 'User successfully registered.');
    } catch(\Exception $e) {
      echo $e;
    }
  }

  public function logout() {

  }
}
