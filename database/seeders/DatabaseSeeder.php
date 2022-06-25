<?php

namespace Database\Seeders;

use App\Models\Backlog;
use App\Models\Project;
use App\Models\ProjectMember;
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
        $user = User::factory()
            ->create([
                'name' => 'Test User',
                'email' => 'test@scrm.tk',
            ]);

        $project = Project::factory()
            ->has(Backlog::factory()
                ->has(Task::factory(30)
                )
            )
            ->create();

        ProjectMember::factory()
            ->for($user)
            ->for($project)
            ->create();

        
        User::factory(10)->create();

    }
}
