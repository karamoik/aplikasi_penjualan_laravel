<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $password = Hash::make('12345678');

        $userCreateAdmin = User::create([
            'name'=>'Admin',
            'email'=>'admin@email.com',
            'password'=>$password,
            'role'=>User::ROLE_ADMIN
        ]);

        $userCreateUser = User::create([
            'name' => 'Admin',
            'email' => 'user@email.com',
            'password' => $password,
            'role' => User::ROLE_USER
        ]);
    }
}
