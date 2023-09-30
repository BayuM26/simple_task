<?php

namespace Database\Seeders;

use App\Models\m_category_task;
use App\Models\task;
use Illuminate\Database\Seeder;

class MCategoryTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        m_category_task::factory(20)->create();
    }
}
