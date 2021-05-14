<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Task;

$factory->define(Task::class, function (Faker $faker) {
  static $priority = 1;
  return [
    'user_id' => 1,
    'name' => $faker->realText($maxNbChars = 30),
    'description' => $faker->text($maxNbChars = 100),
    'label' => $faker->randomElement($array = array('urgent', 'high', 'medium', 'low')),
    'priority' => $priority++,
    'due_date' => $faker->date($format = 'Y-m-d', $max = '2022-5-14')
  ];
});
