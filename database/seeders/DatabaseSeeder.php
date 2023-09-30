<?php

namespace Database\Seeders;

use App\Models\m_category_task;
use App\Models\task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Bayu Maulana',
            'username' => 'admin',
            'password' => bcrypt(env('PASSWORDTAMBAHAN').'admin'.env('PASSWORDTAMBAHAN')),
            'hak_akses' => 'admin',
        ]);
        User::factory(20)->create();
        m_category_task::factory(20)->create();
        task::factory(20)->create();
    }
}
