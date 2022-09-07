<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        Gate::define('check_permission', function (User $user, $permission_id) {

            // get currently logged in user's id
            $user_id =  Auth::id();

            // get logged in user's role_id
            $role =   DB::table('user_role')->where('user_id',$user_id)->first();

            // get all permission of logged in user's permissions 
            $user_permissions_ids = DB::table('role_permission')
            ->where('role_id',$role->role_id)
            ->pluck('permission_id')->toArray();
           
            // check if given permission id lies in user's permisssion's ids
            if(in_array($permission_id, $user_permissions_ids)){
                return true;
            }else{
                return false;
            } 


        });

       





    }
}
