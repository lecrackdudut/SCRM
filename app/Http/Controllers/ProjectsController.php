<?php

namespace App\Http\Controllers;

use App\Models\Backlog;
use App\Models\Project;
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
}
