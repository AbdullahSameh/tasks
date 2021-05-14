@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 style="margin: 0;">List of your tasks</h4>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add Task</a>
          </div>

          <div class="card-body">
            <tasks-draggable :task-data="{{ $tasks }}"></tasks-draggable>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
