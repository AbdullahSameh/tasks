<div class="form-row">
  <div class="form-group col-md-6">
    <label for="inputName">Name</label>
    <input type="text" class="form-control  @error('name') is-invalid @enderror" id="inputName" name="name"
      value="{{ isset($task) ? $task->name : old('name') }}">
    @error('name')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>

  <div class="form-group col-md-6">
    <label for="inputDescription">Description</label>
    <input type="text" class="form-control  @error('description') is-invalid @enderror" id="inputDescription"
      name="description" value="{{ isset($task) ? $task->description : old('description') }}">
    @error('description')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-6">
    <label for="inputlabel">Label</label>
    <select class="custom-select   @error('label') is-invalid @enderror" name="label">
      <option selected disabled>Choose label of task</option>
      <option value="urgent" {{ isset($task) && $task->label == 'urgent' ? 'selected' : '' }}>
        {{ ucfirst('urgent') }}</option>
      <option value="high" {{ isset($task) && $task->label == 'high' ? 'selected' : '' }}>{{ ucfirst('high') }}
      </option>
      <option value="medium" {{ isset($task) && $task->label == 'medium' ? 'selected' : '' }}>
        {{ ucfirst('medium') }}</option>
      <option value="low" {{ isset($task) && $task->label == 'low' ? 'selected' : '' }}>{{ ucfirst('low') }}
      </option>
    </select>

    @error('label')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
  <div class="form-group col-md-6">
    <label for="inputDueDate">Due Date</label>
    <input type="date" class="form-control  @error('due_date') is-invalid @enderror" id="inputDueDate" name="due_date"
      value="{{ isset($task) ? $task->due_date : old('due_date') }}">

    @error('due_date')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
</div>
