<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->delete();
        $this->createAdminUser();
        $this->createManagerUser();
        $this->CreateReqularUser();
//        User::factory()->create(10);
    }

    private function createAdminUser()
    {
        return User::query()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456'),
            'type'=>User::TYPE_ADMIN
        ]);
    }

    private function createManagerUser()
    {
        return User::query()->create([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456'),
            'type'=>User::TYPE_MANAGER
        ]);
    }

    private function CreateReqularUser()
    {
        return User::query()->create([
            'name' => 'reza_h11',
            'email' => 'reza_h11@yahoo.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456')
        ]);
    }
}
