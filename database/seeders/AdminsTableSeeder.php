<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            //get image from public folder
            'image' => 'admin/admin.png',
            'password' => bcrypt('12345678'),
            'type' => 'admin',
            'status' => 1,
            'remember_token' => Str::random(10),
        ]);
    }
}
