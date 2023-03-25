<?php

namespace App\Models;

use App\Models\Messages;
use App\Mail\SendCodeMail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    private $rolesCache; 
    public $image_path              =   "image/user/";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'is_active'
    // ];
        protected $guarded  =   ['id'];
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
            return url("picture/$this->image");
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
        if (isset($this->is_admin)) {
            return TRUE;
        }
        // if ($this->hasRole('Admin')) {
        //     return TRUE;
        // }
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

    public function generateCode()
    {
        $code = rand(1000, 9999);

        UserCode::updateOrCreate(
                    [ 'user_id' => auth()->user()->id ],
                    [ 'code' => $code ]
                );

        try {
            $details = [
                'title' => 'Your two factor authentication code is:',
                'code' => $code
            ];

            $message            = (new SendCodeMail($details))->onQueue('emails');
            Mail::to(auth()->user()->email)->later(now()->addSeconds(1), $message);
            Session::put('user_2fa_sent', now());

        } catch (Exception $e) {
            info("Error: ". $e->getMessage());
        }
    }
}
