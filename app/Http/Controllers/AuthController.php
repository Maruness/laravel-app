<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;

class AuthController extends \Illuminate\Routing\Controller
{
  /* profile function */
  public function index(Request $request) {
    $deletion_form = $request->query('deletion_form', false);/* enable delete account form */
    $password_form = $request->query('password_form', false);/* enable change password form */
    $user = Auth::user();
    return view('home', compact('user', 'deletion_form', 'password_form'));
  }

  /* login function */
  public function login(Request $request) {
    try {
      $request->validate([/* validation for constraints */
        'email' => 'required|string|max:255',
        'password' => 'required|string',
      ]);

      if(Auth::attempt($request->only('email', 'password'))) {/* login process */
        return redirect('/profile')->with('success', 'Login successfully.');
      }

      return redirect('/login')->withErrors(['error' => 'Invalid credentials.']);
    } catch (\Exception $e) {
      return redirect('/login')->withErrors(['error' => 'An unexpected error occurred. Please try again.']);
    }
  }

  /* register function */
  public function register(Request $request) {
    try {
      $request->validate([/* validation for constraints */
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
        'confirm_password' => 'required|string|same:password',
      ]);

      User::create([ /* function to create entry into the database */
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password), /* bcrypts encrypts the password for security purposes */
      ]);

      return redirect('/')->with('success', 'User successfully registered.');/* redirection to the landing page */
    } catch(ValidationException $e) {
      return redirect()->back()->withErrors($e->errors());
    } catch(\Exception $e) {
      return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again.']);
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
        return redirect()->back()->withErrors(['password' => 'Password is incorrect.']);
    }

    $user->delete();/* delete */
    Auth::logout();
    return redirect('/register')->with('success', 'Account deleted successfully.');
  }

  /* change password function */
  public function changePassword(Request $request) {
    $request->validate([/* validation for constraints */
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:8',
        'confirm_new_password' => 'required|string|same:new_password',
    ]);

    $user = Auth::user();
    if (!Auth::attempt(['email' => $user->email, 'password' => $request->current_password])) {/* validating correct password */
        return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }

    $user->password = bcrypt($request->new_password);/* changing password */
    $user->save();

    return redirect('/profile')->with('success', 'Password changed successfully.');
  }
}
