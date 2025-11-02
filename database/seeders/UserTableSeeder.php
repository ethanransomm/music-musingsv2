<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \DB::table("users")->delete();

        \DB::table("users")->insert(
            [
                [
                    'name' => 'TestUser1',
                    'email' => 'testuser1@test.com',
                    'password' => 'password1'
                ]
            ]
        );

        \DB::table("users")->insert(
            [
                [
                    'name' => 'TestUser2',
                    'email' => 'testuser2@test.com',
                    'password' => 'password2'
                ]
            ]
        );

        \DB::table("users")->insert(
            [
                [
                    'name' => 'TestUser3',
                    'email' => 'testuser3@test.com',
                    'password' => 'password3'
                ]
            ]
        );

        \DB::table("users")->insert(
            [
                [
                    'name' => 'TestUser4',
                    'email' => 'testuser4@test.com',
                    'password' => 'password4'
                ]
            ]
        );

        \DB::table("users")->insert(
            [
                [
                    'name' => 'TestUser5',
                    'email' => 'testuser5@test.com',
                    'password' => 'password5'
                ]
            ]
        );


        //
    }
}
