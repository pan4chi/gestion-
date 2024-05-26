<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Stagiaire;
use Database\Factories\EmployeeFactory;
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
        \App\Models\Post::factory(15)->create();
        \App\Models\Employee::factory(30)->create();
        //Stagiaire::factory(20)->create();
        /**\App\Models\User::factory()->create([
            'name' => 'Test User',
             'email' => 'test@example.com',
         ]);**/
    }
}
