<?php

namespace App\Models;

use App\Models\Messages;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    private $rolesCache; 
    public $image_path              =   "image/user/";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('is_active', function (Builder $builder) {
            $builder->where('users.is_active', '=', 1);
        });
    }

    public function getImagePath()
    {// check file exist then return default image.
        
        if ($this->hasImage()) {
            return url("user/picture/$this->image");
        } else {
            return url('/img/user.png');
        }
    }

    public function hasImage()
    {
        if(empty($this->image)) return FALSE;
        if (Storage::exists($this->image_path.$this->image))
        {
            return TRUE;
        }
        return FALSE;
    }

    public function roles() {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

    public function hasRole($roleName)
    {
        if (empty($this->rolesCache)) {
            $this->rolesCache = $this->roles->map(function ($item, $key) {
                                        $item->name = strtolower($item->name);
                                        return $item;
                                    });
        }
        $roleName = strtolower($roleName);

        return $this->rolesCache->where("name", $roleName)->isNotEmpty();
    }

    public function hasPermission($moduleName, $access = null)
    {
        // do not check for permission if the user is admin
        if ($this->hasRole('Admin')) {
            return TRUE;
        }
        if (empty(Module::$cache)) {
            Module::$cache = Module::all()->map(function ($item) {
                $item->name = strtolower($item->name);
                return $item;
            });
        }
        $module = Module::$cache->where('name', strtolower($moduleName))->first();
        $module_id = empty($module) ? null : $module->id;

        $permissions = $this->permissions();
        if (empty($module_id) || $permissions->isEmpty()) {
            return FALSE;
        }
        $permissions = $permissions->where('module_id', $module_id);
        if (!empty($access)) {
            $permissions = $permissions->where('name', strtolower($access));
        }

        if (!$permissions->isEmpty()) {
            return TRUE;
        }

        return FALSE;
    }

    private function permissions()
    {
        // using actions method only once per page
        //testing required here .............................................................
        if (empty($this->permissionsCache)) {
            $this->permissionsCache = $this->roles->load("permissions")->pluck("permissions")
                ->collapse()->map(function ($item, $key) {
                    $item->name = strtolower($item->name);
                    return $item;
                });
        }
        return $this->permissionsCache;
    }

    public function messages()
    {
        return $this->hasMany(Messages::class, 'sender_id');
    }
}
