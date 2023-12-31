<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

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
        'password' => 'hashed',
    ];

    public static function getGroupPermission()
    {
        return DB::table('permissions')->select("group_name")->groupBy("group_name")->get();
    }

    public static function getPermissionByGroupname($group_name)
    {
        return DB::table('permissions')->where("group_name", $group_name)->select("name", "id")->get();
    }

    public static function hasRolesPermission($role, $permissions)
    {
        $result = false;
        foreach ($permissions as $permission) {
            if ($role->hasPermissionTo($permission->name)) {
                $result = true;
            }
        }
        return $result;
    }
}
