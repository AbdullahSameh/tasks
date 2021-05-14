<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    User::updateOrCreate([
      'name' => 'Abdullah Sameh',
      'email' => 'admin@admin.com',
      'password' => bcrypt('password')
    ]);
  }
}
