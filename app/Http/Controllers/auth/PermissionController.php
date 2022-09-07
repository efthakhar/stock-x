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

    // get permissions by specific role id

    function permissionsByrole($id)
    {      
       $permissions = DB::table('role_permission')
                        ->where('role_id',$id)
                        ->pluck('permission_id');
                      
       return response()->json($permissions);
    }

    function permissionsByUser($id)
    {    
       $role = DB::table('user_role')
               ->where('user_id',$id)->first();  
               
       $permissions = DB::table('role_permission')
                        ->where('role_id',$role->role_id)
                        ->pluck('permission_id');
                      
       return response()->json($permissions);
    }

    function changePermissionsByrole(Request $request,$id)
    {
        // return $request;
        DB::table('role_permission')
        ->where('role_id',$id)
        ->delete();

        foreach($request->role_sp_permissions_ids as $permission_id)
        {
            DB::table('role_permission')
                    ->insert([
                        'role_id' => $id,
                        'permission_id' => $permission_id
                    ]);

        }

        return response()->json('updated');

    }
}
