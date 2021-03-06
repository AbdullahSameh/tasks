<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'tasks';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id',
    'name',
    'description',
    'priority',
    'position',
    'due_date',
  ];

  /**
   * Get the user that owns the task.
   */
  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }
}
