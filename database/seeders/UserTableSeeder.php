<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('users')->insert([
      'name' => 'Admin',
      'email' => 'admin@mail.com',
      'role' => 'admin',
      'password' => bcrypt('password'),
      'created_at' => date("Y-m-d H:i:s"),
    ]);
    DB::table('users')->insert([
      'name' => 'Lodge 1',
      'email' => 'lodge@mail.com',
      'role' => 'lodge',
      'password' => bcrypt('password'),
      'created_at' => date("Y-m-d H:i:s"),
    ]);
    DB::table('users')->insert([
      'name' => 'Citizen 1',
      'email' => 'citizen@mail.com',
      'role' => 'citizen',
      'password' => bcrypt('password'),
      'created_at' => date("Y-m-d H:i:s"),
    ]);
    DB::table('users')->insert([
      'name' => 'Hotel 1',
      'email' => 'hotel@mail.com',
      'role' => 'hotel',
      'password' => bcrypt('password'),
      'created_at' => date("Y-m-d H:i:s"),
    ]);
  }
}
