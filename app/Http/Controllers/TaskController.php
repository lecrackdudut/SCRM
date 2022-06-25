<?php

namespace App\Http\Controllers;

use App\Models\Backlog;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # Normalement, c'est pour lister toutes les tâches malheureusement nous on veut les ressources du projet où du backlog ?

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // not needed
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
            'title' => ['required', 'max:50'],
            'description' => ['required', 'max:50'],
            'status' => ['required'],
            'score' => ['required'],
        ]);

        $task = new Task;

        $task->fill(
            $request->only('title', 'description', 'status', 'score')
        );

        $project = Project::findOrFail($request->projectId);
        //$task->backlog()->save($project->backlog);

        $user = User::findOrfail($request->userId);
        $task->author()->associate($user);
        $project->backlog->tasks()->save($task);

        $task->save();
        return Redirect::route('projects.show', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $task = Task::with('backlog.project')->with('author')->findOrFail($id);

        return Inertia::render('TaskDetail', [
            'task' => $task,
            'project' => $task->backlog->project,
            'majRelative' => $task->updated_at->diffForHumans(),
            'memberships' => $task->backlog->project->memberships->pluck("user")
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        //return Inertia::render('TaskEdition', [
        //    'task' => $this->show($id)
        //]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->score = $request->score;
        $user = User::findOrfail($request->userId);
        $task->author()->associate($user);
        $task->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        $project = $task->backlog->project;

        $task->delete();
        return Redirect::route('projects.show', $project);
    }
}
