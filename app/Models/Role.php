<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table    =   'roles';
    protected $guarded  =   'id';

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id'); 
    }

    public function permissions() 
    {
        return $this->belongsToMany(Permission::class,'role_permissions','role_id','permission_id');
    }

    public function hasPermission($moduleName, $access = null)
    {
        if(empty(Module::$cache))
        {
            Module::$cache = Module::all()->map(function($module,$key){
                $module->name = strtolower($module->name);
                return $module;
            });
        }
        
        $module = Module::$cache->where('name', strtolower($moduleName))->first();
        $module_id = empty($module)? null : $module->id;

        $permissions = $this->permissions->map(function ($permission, $key) {
            $permission->name = strtolower($permission->name);
            return $permission;
        });;

        if(empty($module_id) || $permissions->isEmpty())
        {
            return FALSE;
        }
        $result = $permissions->where('module_id', $module_id);
        if(!empty($access))
        {
            $result = $result->where('name', strtolower($access));
        }
        
        if($result->isEmpty())
        {
            return False;
        }
        return true;
    }
}
