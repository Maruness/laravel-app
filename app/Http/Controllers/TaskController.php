<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
  public function index()/* display task */
  {
    $tasks = Auth::user()->tasks;/* get tasks for the authenticated user */
    return view('tasks.index', compact('tasks'));
  }

  public function store(Request $request)/* add task */
  {
    $request->validate(['title' => 'required|string|max:255']);
    Auth::user()->tasks()->create(['title' => $request->title]);/* assign task with user */
    return redirect()->back()->with('success', 'Task added successfully.');
  }

  public function update(Request $request, Task $task)/* update task */
  {
    if ($task->user_id !== Auth::id()) {
      abort(403);/* prevents unauthorized access */
    }
    $task->update(['completed' => $request->has('completed')]);
    return redirect()->back()->with('success', 'Task updated successfully.');
  }

  public function destroy(Task $task)/* delete task */
  {
    if ($task->user_id !== Auth::id()) {
      abort(403);/* prevents unauthorized access */
    }
    $task->delete();/* deletes */
    return redirect()->back()->with('success', 'Task deleted successfully.');
  }
}
