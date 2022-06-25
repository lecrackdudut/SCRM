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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $membership = new ProjectMember;
        $membership->role = $request->get('role');
        $membership->user()->associate(User::findOrFail($request->get('user')));
        $membership->project()->associate(Project::findOrFail($id));
        $membership->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idProject, $idMember)
    {
        $projectMember = ProjectMember::findOrFail($idMember);
        $projectMember->delete();
        return back();
    }
}
