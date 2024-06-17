<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            "username" => "adhe",
            "display_name" => "Administrator",
            "password_hash" => Hash::make("12"),
        ]);

        $user->save();
    }
}
