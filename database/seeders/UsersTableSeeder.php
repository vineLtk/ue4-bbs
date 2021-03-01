<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::factory()->count(20)->create();

        $user = User::find(1);
        $user->name = "liutk";
        $user->email = "961510893@qq.com";
        $user->password = bcrypt('123456');
        $user->assignRole('Founder');
        $user->save();
    }
}
