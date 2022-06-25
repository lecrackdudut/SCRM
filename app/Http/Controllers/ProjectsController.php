<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\Backlog;
use App\Models\Project;
use App\Models\ProjectMember;
use Illuminate\Console\Events\ScheduledTaskSkipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Laravel\Jetstream\Role;

use function GuzzleHttp\Promise\task;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::with('backlog.tasks')->get();

        foreach ($projects as $project) {
            $project->nbSprints = $project->sprints->count();
            $project->nbTasks = $project->backlog->tasks->count();
            $project->majRelative = $project->updated_at->diffForHumans();
            if($project->memberships()->where("role", "scrum_master")->first()) {
                $project->author = $project->memberships()->where("role", "scrum_master")->first()->user->name;
            }
        }

        return Inertia::render('Projects', [
            'projects' => $projects
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function show(Project $project)
    {
        $tasks = $project->backlog->tasks()->orderBy('score', 'desc')->get()->map(function ($task) {
            switch ($task->status->value) {
                case 'in_progress':
                    $task->statusOrdered = 1;
                    return $task;
                    break;
                case 'open':
                    $task->statusOrdered = 2;
                    return $task;
                    break;
                case 'closed':
                    $task->statusOrdered = 3;
                    return $task;
            }
        });

        $orderedTasks = $tasks->sortBy('statusOrdered')->values()->all();
        
        return Inertia::render('ProjectDetail', [
            'name' => $project->name,
            'tasks' => $orderedTasks,
            "project" => $project
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:50'],
            'description' => ['required', 'max:50'],
        ]);

        $project = new Project;

        $project->fill(
            $request->only('name', 'description')
        );

        $project->save();
        $backlog = new Backlog;
        $project->backlog()->save($backlog);

        $membership = new ProjectMember;
        $membership->user()->associate(Auth::user());
        $membership->project()->associate($project);
        $membership->role = 'scrum_master';
        $membership->save();

        return Redirect::route('projects.show', $project);
    }
}
