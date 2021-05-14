<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
  /**
   * Display a listing of the tasks for login user.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $tasks = Task::where('user_id', auth()->user()->id)->orderBy('priority')->get();
    // dd($tasks);
    return view('tasks.index', compact('tasks'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('tasks.create');
  }

  /**
   * Store a newly created task in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreTaskRequest $request)
  {
    $data = $request->all();
    $data['priority'] = Task::max('priority') + 1;
    $data['user_id'] = auth()->user()->id;

    Task::create($data);
    session()->flash('success', 'Task has been created successfully');
    return redirect()->route('tasks.index');
  }

  /**
   * Show the form for editing the specified task.
   *
   * @param  Model  $task
   * @return \Illuminate\Http\Response
   */
  public function edit(Task  $task)
  {
    return view('tasks.edit', compact('task'));
  }

  /**
   * Update the specified task in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  Model  $task
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateTaskRequest $request, Task $task)
  {
    $task->update($request->all());
    session()->flash('success', 'Task has been updated successfully');
    return redirect()->route('tasks.index');
  }

  /**
   * Remove the specified task from storage.
   *
   * @param  Model  $task
   * @return \Illuminate\Http\Response
   */
  public function destroy(Task $task)
  {
    $higherTaskPrioritys = Task::where('priority', '>', $task->priority)->get();
    foreach ($higherTaskPrioritys as $higherTaskPriority) {
      $higherTaskPriority->update(['priority' => $higherTaskPriority->priority - 1]);
    }
    $task->delete();
    session()->flash('success', 'Task has been deleted successfully');
    return redirect()->route('tasks.index');
  }

  /**
   * Update the task priority with the new priority after reorder in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function updatePriority(Request $request)
  {
    foreach ($request->tasks as $task) {
      $task = Task::find($task['id'])->update(['priority' => $task['priority']]);
    }
    return response('Update Successful.', 200);
  }
}
