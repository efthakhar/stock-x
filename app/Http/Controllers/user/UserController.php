<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function index()
    {
       $users = DB::table('users')
       ->leftJoin('user_role', 'users.id', '=', 'user_role.user_id')
       ->leftJoin('roles', 'user_role.role_id', '=', 'roles.role_id')
        ->select('id','name','email','role_name')
       ->get();

        return response()->json($users);
    }

    function show($id)
    {
       $user = DB::table('users')
        ->leftJoin('user_role', 'users.id', '=', 'user_role.user_id')
        ->leftJoin('roles', 'user_role.role_id', '=', 'roles.role_id')
        ->select('id','name','email','roles.role_id','role_name')
        ->where('id',$id)
        ->first();

        return response()->json($user);
    }

    function store(Request $request)
    {
        $user = DB::table('users')->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'password'=> Hash::make($request->password) ,
        ]);

        DB::table('user_role')
        ->where('user_id',$user)
        ->insert([
            'user_id' => $user,
            'role_id' => $request->role_id
        ]);
        

        return response()->json('user created sucessfully');

    }

    function update(Request $request,$id)
    {
        $user = DB::table('users')
        ->where('id',$id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'password'=> Hash::make($request->password) ,
        ]);

        DB::table('user_role')
        ->where('user_id',$id)
        ->delete();

        DB::table('user_role')
        ->insert([
            'user_id' => $id,
            'role_id' => $request->role_id
        ]);
        

    //     DB::table('user_role')
    //     ->upsert(
    //         [
    //             [
    //                 'user_id' => $id,
    //                 'role_id' => $request->role_id
    //             ]
    //         ]
    //         ,
    //         ['user_id'],
    //         ['role_id'],
    //    );
        

        return response()->json('user updated sucessfully');

    }
}
