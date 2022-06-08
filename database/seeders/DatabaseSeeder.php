<?php

namespace Database\Seeders;

use App\Models\Backlog;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@scrm.tk',
        ]);

        User::factory(10)->create();

        Project::factory(3)
        ->has(Backlog::factory()
            ->has(Task::factory(10)
            )
        )
        ->create();

    }
}
