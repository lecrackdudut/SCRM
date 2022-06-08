<?php

namespace Database\Seeders;

use App\Models\Backlog;
use App\Models\Project;
use App\Models\Task;
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
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Project::factory(3)
        ->has(Backlog::factory()
            ->has(Task::factory(10)
                ->state(function (array $attributes, Backlog $backlog) {
                        return ['backlog_id' => $backlog->id];
                    }
                )
            )
        )
        ->create();

        


    }
}
