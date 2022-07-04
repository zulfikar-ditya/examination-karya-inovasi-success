<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'role_id',
        'permission_id'
    ];

    public function rules($method = 'create', $id = null)
    {
        $validate = [
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,id',
        ];
        return $validate;
    }

    public function loadModel($request) {foreach ($this->fillable as $key_field) {foreach ($request as $key_request => $value) {if ($key_field == $key_request) $this->setAttribute($key_field, $value);}}}

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    public function roles()
    {
        return $this->belongsToMany(User::class);
    }
}
