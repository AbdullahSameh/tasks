@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h4>Edit Your task</h4>
          </div>

          <div class="card-body">
            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
              @csrf
              @method('put')

              @include('tasks.form')

              <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
