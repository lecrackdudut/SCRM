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
/*        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@scrm.tk',
        ]);*/

/*        User::factory(10)->create();*/

/*        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@scrm.tk',
        ]);*/
        $user = User::factory()
            ->create([
                'name' => 'Test User',
                'email' => 'test@scrm.tk',
            ]);

        $project = Project::factory()
            ->has(Backlog::factory()
                ->has(Task::factory(10)
                )
            )
            ->create();

        ProjectMember::factory()
            ->for($user)
            ->for($project)
            ->create();


/*        Project::factory(10)
            ->has(Backlog::factory()
                ->has(Task::factory(10)
                )
            )
            ->create();*/


       /* $users = User::factory(10)->create();
        $projectMember = ProjectMember::factory(10)->create();
        $projects = Project::factory(10)
            ->has(Backlog::factory()
                ->has(Task::factory(10)
                )
            )
            ->create();



        ProjectMember::factory(5)->has(User::factory(10))->create();

        User::factory(10)
        ->has(ProjectMember::factory(1)
            ->has(Project::factory(1)
                ->has(Backlog::factory()
                    ->has(Task::factory(10)
                    )
                )
            )
        )
        ->create();*/

/*        Project::factory(3)
        ->has(Backlog::factory()
            ->has(Task::factory(10)
            )
        )
        ->create();*/

    }
}
