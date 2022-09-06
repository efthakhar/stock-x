<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    function index()
    {
       $arranged_roles = [];
       $roles = DB::table('roles')->get();
       foreach($roles as $role)
       {
            $arranged_roles[$role->role_id] = $role;
       }
       return response()->json($arranged_roles);

    }
}
