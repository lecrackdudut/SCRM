<?php

namespace App\Http\Controllers;

use App\Models\Backlog;
use App\Models\Project;
use Illuminate\Console\Events\ScheduledTaskSkipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::with('backlog.tasks')->get();

        foreach ($projects as $project) {
            $project->nbSprints = $project->sprints->count();
            $project->nbTasks = $project->backlog->tasks->count();
            $project->majRelative = $project->updated_at->diffForHumans();
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
        return Inertia::render('ProjectDetail', [
            'name' => $project->name,
            'tasks' => $project->backlog->tasks()->orderBy('score', 'desc')->get(),
            "projectId" => $project->id
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

        return Redirect::route('projects.show', $project);
    }
}
