<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;

use App\Models\Module;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        $moduleList = Module::all();

        
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
            }
        }
    }
}