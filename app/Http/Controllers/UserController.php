<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Role;
use App\Models\Role_User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $newUser = new User;
        $newUser->badge_id = $request->badge;
        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->password = bcrypt($request->password);
        $newUser->save();
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (Gate::any(['admin']))
        {
            // The user can update or delete the user...
            $roles = Role::all();
            return view('users.edit',['user' => $user, 'roles' => $roles]);
        }
        else
        {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $roles = Role::all();
        foreach ($roles as $role)
        {
            if (!is_null($request->input($role->name)))
            { // role is checked
                if (!$user->containsRole($role->name))
                { // insert role_user other wise alread in db
                    $roleuser = new Role_User;
                    $roleuser->user_id = $user->id;
                    $roleuser->role_id = $role->id;
                    $roleuser->save();
                }
            }
            else
            { // role is not checked
                if ($user->containsRole($role->name))
                { // delete role_user other wise alread in db
                    Role_User::where('user_id',$user->id)->where('role_id',$role->id)->delete();
                }
            }
        }
        $user->name = $request->name;
        $user->badge_id = $request->badge;
        $user->email = $request->email;
        if (strlen($request->password) > 0)
        {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
