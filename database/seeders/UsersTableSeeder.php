<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [];
        $password = bcrypt('password');
        $count = 100;
        dump("creating $count admins");
        for ($i = 0; $i < $count; $i++) {
            $users [] = [
                'name' => "admin$i",
                'email' => "admin$i@example.com",
                'password' => $password,
                'is_admin' => true,
            ];
        }

        $count = 10000;
        dump("creating $count users");
        for ($i = 0; $i < $count; $i++) {
            $users [] = [
                'name' => "user$i",
                'email' => "user$i@example.com",
                'password' => $password,
                'is_admin' => false,
            ];
        }
        $chunks = array_chunk($users, 100);
        foreach ($chunks as $chunk) {
            User::insert($chunk);
        }

    }
}
