<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;

class AuthController extends \Illuminate\Routing\Controller
{
  /* profile function */
  public function index(Request $request) {
    $deletion_form = $request->query('deletion_form', false);/* toggles delete account form */
    $user = Auth::user();
    return view('home', compact('user', 'deletion_form', 'password_form'));
  }

  /* login function */
  public function login(Request $request) {
    try {
      $request->validate([/* validation for indexes */
        'email' => 'required|string|max:255',
        'password' => 'required|string',
      ]);

      if(Auth::attempt($request->only('email', 'password'))) {/* login process */
        return redirect('/')->with('success', 'Login successfully.');
      }

      return redirect('/login')->with('error', 'Invalid credentials.');
    } catch (\Exception $e) {
      echo $e;
    }
  }

  /* register function */
  public function register(Request $request) {
    try {
      $request->validate([/* uses ValidatesRequests to simplify validation of data */
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
      ]);

      User::create([ /* function to create entry into the database */
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password), /* bcrypts encrypts the password for security purposes */
      ]);

      return redirect('/')->with('success', 'User successfully registered.');/* redirection to the landing page */
    } catch(\Exception $e) {
      echo $e;
    }
  }

  /* logout function */
  public function logout() {
    Auth::logout();
    return redirect('/login')->with('success', 'Logged out successfully');
  }

  /* delete account function */
  public function deleteUser(Request $request) {
    $request->validate([/* validation for matching password */
        'password' => 'required|string',
        'confirm_password' => 'required|string|same:password',
    ]);

    $user = Auth::user();
    if (!Auth::attempt(['email' => $user->email, 'password' => $request->password])) {/* validating correct password */
        return redirect('/')->with('error', 'Password is incorrect.');
    }

    $user->delete();/* delete */
    Auth::logout();
    return redirect('/register')->with('success', 'Account deleted successfully.');
  }
}
