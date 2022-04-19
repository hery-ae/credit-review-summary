<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Segmentation;
use App\Models\User as UserModel;

class User extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserModel::with([
                'userRoles' => function($query) {
                    $query->with(['role']);
                },
                'userSegmentations' => function($query) {
                    $query->with(['segmentation']);
                },
            ])
            ->latest()
            ->get();

        return view('user.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        $segmentations = Segmentation::get();

        return view('user.create', [
            'roles' => $roles,
            'segmentations' => $segmentations,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = UserModel::updateOrCreate(
                ['email' => $request->input('email')],
            );

        $user->userRoles()->whereNotIn('role_id', array_map('intval', $request->input('role-id')))->delete();
        $user->userSegmentations()->whereNotIn('segmentation_id', array_map('intval', $request->input('segmentation-id')))->delete();

        foreach (array_filter($request->input('role-id')) as $key => $value) {
            $user->userRoles()->updateOrCreate(['role_id' => ((int) $value)]);
        }

        foreach (array_filter($request->input('segmentation-id')) as $value) {
            $user->userSegmentations()->updateOrCreate(['segmentation_id' => ((int) $value)]);
        }

        return redirect()->route('users.index');
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
        $roles = Role::get();
        $segmentations = Segmentation::get();
        $user = UserModel::find($id);

        return view('user.edit', [
            'roles' => $roles,
            'segmentations' => $segmentations,
            'user' => $user,
        ]);
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
    public function destroy($id)
    {
        //
    }
}
