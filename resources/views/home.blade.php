<x-base>{{-- takes base.blade.php as a layout --}}

<button class="btn-green float-right" onclick="window.location.href='/'">Go to Task List</button>{{-- go to task list button --}}

<div class="profile-info">{{-- whole profile box --}}
  <h2>Welcome! <span>{{ $user->name }}</span></h2>
  <p>ID: <span>{{ $user->id }}</span></p>
  <p>Name: <span>{{ $user->name }}</span></p>
  <p>Email: <span>{{ $user->email }}</span></p>
  <p>Join Date: <span>{{ $user->created_at }}</span></p>
  <p><span><a class="text-blue-500 hover:cursor-pointer" 
    href="{{ url('/profile/?password_form=true') }}">Change Password</a></span></p>{{-- pop up button for changing password --}}
  <p><span><a class="text-red-700 hover:cursor-pointer" 
    href="{{ url('/profile/?deletion_form=true') }}">Delete Account</a></span></p>{{-- pop up button for deletion form --}}
  <div>
    <form method="POST" action="/logout">
      @csrf
      <button type="submit" class="btn-red float-right">Logout</button>{{-- logout button --}}
    </form>
  </div>
</div>

@if($deletion_form){{-- pop up form for deletion of account --}}
<div id="modal">{{-- background blur --}}
  <div class="form">
    <h2>Confirm Account Deletion</h2>
    <form method="POST" action="/authentication/user/{{ $user->id }}">
      @csrf
      @method('DELETE'){{-- method --}}
      <label for="password" class="form-label">Password</label>
      <input type="password" id="password" name="password" class="form-box" required>
      <label for="confirm_password" class="form-label">Confirm Password</label>
      <input type="password" id="confirm_password" name="confirm_password" class="form-box" required>
      @if ($errors->any()){{-- scans for errors --}}
      <div>
        <ul>
          @foreach ($errors->all() as $error)
            <li class="text-red-400 text-sm">{{ $error }}</li>{{-- displays the error --}}
          @endforeach
        </ul>
      </div>
      @endif
      <div class="flex justify-end mt-4">
        <a href="{{ url('/profile') }}" class="btn-red" formnovalidate>Cancel</a>{{-- closes the form --}}
        <button type="submit" class="btn-red">Confirm Deletion</button>{{-- proceed to deletion --}}
      </div>
    </form>
  </div>
</div>
@endif

@if($password_form){{-- pop up form for changing password --}}
<div id="modal">{{-- background blur --}}
  <div class="form">
    <h2>Change Password</h2>
    <form method="POST" action="/authentication/user/{{ $user->id }}">
      @csrf
      @method('PUT'){{-- method --}}
      <label for="current_password" class="form-label">Current Password</label>
      <input type="password" id="current_password" name="current_password" class="form-box" required>
      <label for="new_password" class="form-label">New Password</label>
      <input type="password" id="new_password" name="new_password" class="form-box" required>
      <label for="confirm_new_password" class="form-label">Confirm New Password</label>
      <input type="password" id="confirm_new_password" name="confirm_new_password" class="form-box" required>
      @if ($errors->any()){{-- scans for errors --}}
      <div>
        <ul>
          @foreach ($errors->all() as $error)
            <li class="text-red-400 text-sm">{{ $error }}</li>{{-- displays errors --}}
          @endforeach
        </ul>
      </div>
      @endif
      <div class="flex justify-end mt-4">
        <a href="{{ url('/profile') }}" class="btn-red" formnovalidate>Cancel</a>{{-- closes the form --}}
        <button type="submit" class="">Change Password</button>{{-- proceed to change the password --}}
      </div>
    </form>
  </div>
</div>
@endif
</x-base>