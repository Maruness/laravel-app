<x-base>
<div class="profile-info">
  <h2>Welcome! <span>{{ $user->name }}</span></h2>
  <p>ID: <span>{{ $user->id }}</span></p>
  <p>Name: <span>{{ $user->name }}</span></p>
  <p>Email: <span>{{ $user->email }}</span></p>
  <p>Join Date: <span>{{ $user->created_at }}</span></p>
  <p>Password: <span><a class="text-blue-500 hover:cursor-pointer">Change Password</a></span></p>
  <p><span><a class="text-red-700 hover:cursor-pointer" href="{{ url('/?deletion_form=true') }}">Delete Account</a></span></p>
  <div>
    <form method="POST" action="/logout">
      @csrf
      <button type="submit" class="btn-red float-right">Logout</button>
    </form>
  </div>
</div>

@if($deletion_form)
<div id="delete-account-modal">
  <div class="delete-account-form">
    <h2>Confirm Account Deletion</h2>
    <form method="POST" action="/authentication/user/{{ $user->id }}">
      @csrf
      @method('DELETE')
      <label for="password" class="form-label">Password</label>
      <input type="password" id="password" name="password" class="form-box" required>
      <label for="confirm_password" class="form-label">Confirm Password</label>
      <input type="password" id="confirm_password" name="confirm_password" class="form-box" required>
      <div class="flex justify-end mt-4">
        <a href="{{ url('/') }}" class="btn-red" formnovalidate>Cancel</a>
        <button type="submit" class="btn-red">Confirm Deletion</button>
      </div>
    </form>
  </div>
</div>
@endif
</x-base>