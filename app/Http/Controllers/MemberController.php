<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Membership;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $project = Project::with('memberships.user')->findOrFail($id);

        $this->authorize('update', $project);

        $allUsers = User::all();
        $alreadyInProject = $project->memberships->pluck('user');
        $usersAvailable = $allUsers->except($alreadyInProject->keyBy('id')->keys()->all());

        return Inertia::render('ProjectMembers', [
            'project' => $project,
            'users' => $usersAvailable,
            'roles' => Role::cases()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $this->authorize('update', $project);

        $membership = new ProjectMember;
        $membership->role = $request->get('role');
        $membership->user()->associate(User::findOrFail($request->get('user')));
        $membership->project()->associate($project);
        $membership->save();

        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idProject, $idMember)
    {
        $project = Project::findOrFail($idProject);
        $this->authorize('update', $project);

        $projectMember = ProjectMember::findOrFail($idMember);
        $projectMember->delete();
        return back();
    }
}
