<?php

namespace Database\Seeders;

use App\Models\Likeable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class likes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('likable')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        Likeable::factory(20)->create();
    }
}
