<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;

use App\Models\Module;
use App\Models\User;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Post::class => PostPolicy::class,
        Group::class => GroupPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        $moduleList = Module::all();

        // custom Gate
        if($moduleList->count()>0){
            foreach($moduleList as $module){
                Gate::define($module->name,function(User $user) use($module){
                    $permission = $user->group->permission;
                    
                    if(!empty($permission)){
                        $roleArr = json_decode($permission,true);

                        $check = isRole($roleArr,$module->name);

                        return $check;
                    }

                    return false;
                });

                Gate::define($module->name.'.add',function(User $user) use($module){
                    $permission = $user->group->permission;
                    
                    if(!empty($permission)){
                        $roleArr = json_decode($permission,true);

                        $check = isRole($roleArr,$module->name,'add');

                        return $check;
                    }

                    return false;
                });

                Gate::define($module->name.'.edit',function(User $user) use($module){
                    $permission = $user->group->permission;
                    
                    if(!empty($permission)){
                        $roleArr = json_decode($permission,true);

                        $check = isRole($roleArr,$module->name,'edit');

                        return $check;
                    }

                    return false;
                });

                Gate::define($module->name.'.delete',function(User $user) use($module){
                    $permission = $user->group->permission;
                    
                    if(!empty($permission)){
                        $roleArr = json_decode($permission,true);

                        $check = isRole($roleArr,$module->name,'delete');

                        return $check;
                    }

                    return false;
                });

                Gate::define($module->name.'.permission',function(User $user) use($module){
                    $permission = $user->group->permission;
                    
                    if(!empty($permission)){
                        $roleArr = json_decode($permission,true);

                        $check = isRole($roleArr,$module->name,'permission');

                        return $check;
                    }

                    return false;
                });
            }
        }

        // custom policy
    }
}