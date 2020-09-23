<?php

use Illuminate\Database\Seeder;

class CurrentAccountsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('current_accounts')->insert([[
      'branch' => '1238',
      'account' => '345034'
    ], [
      'branch' => '0001',
      'account' => '10278889'
    ], [
      'branch' => '3593',
      'account' => '495027'
    ]]);
  }
}
