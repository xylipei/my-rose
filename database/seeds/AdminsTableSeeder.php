<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\Models\Admin::class)->create([
            'name' => 'admin',
            'email' => 'm18438628633@163.com',
            'password' => bcrypt('098765'),
        ]);
    }
}
