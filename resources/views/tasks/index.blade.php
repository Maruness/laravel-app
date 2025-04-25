<x-base>
<nav class="flex justify-between">
  <span class="text-white">
    <a class="btn-green float-left" href="{{ url('/profile') }}">Profile</a></span>{{-- go to profile --}}
  <span class="text-white">
    <form method="POST" action="/logout">
      @csrf
      <button type="submit" class="btn-red float-right">Logout</button>{{-- logout button --}}
    </form>
  </span>
</nav>
<div class="container mx-auto p-4">
<h1 class="text-2xl font-bold mb-4">To-Do List</h1>{{-- center title --}}
<form action="{{ route('tasks.store') }}" method="POST" class="mb-4">
  @csrf
  <div class="flex">
    <input type="text" name="title" placeholder="New Task" class="form-newtask" required maxlength="25">
    <button type="submit" class="btn-addtask">+</button>{{-- add the task after naming --}}
  </div>
</form>

@if (session('success')){{-- feedback on every action --}}
  <div class="task-success">
    {{ session('success') }}
  </div>
@endif

<ul>
  @foreach ($tasks as $task)
  <li class="task-item">{{-- start of task list --}}
    <form action="{{ route('tasks.update', $task) }}" method="POST" class="flex items-center w-full">
      @csrf
      @method('PATCH')
      <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>{{-- tickbox --}}
      <span class="{{ $task->completed ? 'line-through' : '' }} ml-2">{{ $task->title }}</span>
      <span class="ml-auto text-right text-sm text-gray-400 mx-4">
        {{ $task->created_at->format('F - d - Y - h:i A') }}{{-- date formatter --}}
      </span>
    </form>
    <form action="{{ route('tasks.destroy', $task) }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn-deletetask">X</button>{{-- delete task button --}}
    </form>
  </li>
  @endforeach
</ul>
</x-base>