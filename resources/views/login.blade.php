<x-base>{{-- takes base.blade.php as a layout --}}
<title>Login</title>
<form method="POST" action="/authentication/login" class="max-w-sm mx-auto">
  @csrf
  <div class="mb-5">{{-- email textbox --}}
    <label for="email" class="form-label">Email</label>
    <input type="email" id="email" name="email" class="form-box" placeholder="email@provider.com" required />
  </div>
  <div class="mb-5">{{-- password textbox --}}
    <label for="password" class="form-label">Password</label>
    <input type="password" id="password" name="password" class="form-box" required />
  </div>
  <button type="submit" class="btn-submit">Submit</button>
</form>
</x-base>