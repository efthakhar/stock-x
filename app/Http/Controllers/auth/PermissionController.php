<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    function index()
    {
       $arranged_permissions = [];
       
       $permissions = DB::table('permissions')->get();

       foreach($permissions as $permission)
       {
            $arranged_permissions[$permission->permission_id] = $permission;
       }

       return response()->json($arranged_permissions);

    }
}
