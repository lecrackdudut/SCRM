<?php

namespace App\Http\Controllers;

use App\Models\Backlog;
use App\Models\Project;
use Illuminate\Console\Events\ScheduledTaskSkipped;
use Illuminate\Http\Request;
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
}
