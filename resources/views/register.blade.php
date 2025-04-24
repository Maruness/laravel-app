<x-base>{{-- takes base.blade.php as a layout --}}
<title>Register</title>

<h1>Register</h1>
<form method="POST" action="/authentication/register" class="max-w-sm mx-auto">
  @csrf
  <div class="mb-5">{{-- name textbox --}}
    <label for="name" class="form-label">Name</label>
    <input type="text" id="name" name="name" class="form-box" placeholder="name" required />
  </div>
  <div class="mb-5">{{-- email textbox --}}
    <label for="email" class="form-label">Email</label>
    <input type="email" id="email" name="email" class="form-box" placeholder="email@provider.com" required />
  </div>
  <div class="mb-5">{{-- password textbox --}}
    <label for="password" class="form-label">Password</label>
    <input type="password" id="password" name="password" class="form-box" required />
  </div>
  <div class="mb-5">{{-- confirm password textbox --}}
    <label for="confirm_password" class="form-label">Confirm Password</label>
    <input type="password" id="confirm_password" name="confirm_password" class="form-box" required />
  </div>
  @if ($errors->any()){{-- scan for errors --}}
  <div>
    <ul>
      @foreach ($errors->all() as $error)
        <li class="text-red-400 text-sm">{{ $error }}</li>{{-- displays error --}}
      @endforeach
    </ul>
  </div>
  @endif
  <div class="center">
    <button type="submit" class="btn-submit">Sign Up</button>{{-- submit button --}}
  </div>
  <div class="center">
    <a class="text-white/70" href="/login">Already have an account?</a>{{-- redirect to login --}}
  </div>
</form>
</x-base>