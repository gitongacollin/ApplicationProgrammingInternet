<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Role::create(['name'=>'writer']);
        //$permission = Permission::create(['name'=>'Edit Post']); 

        //$role = Role::findById(1);
        //$permission = Permission::findById(1);
        //$role->givePermissionTo($permission);
        //$permission->removeRole($role);
        //$role->revokePermissionTo($permission);

        //auth()->user()->givePermissionTo('Edit Post');


        return view('home');
    }
}
