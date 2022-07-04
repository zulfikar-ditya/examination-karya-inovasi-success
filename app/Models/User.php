<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username',
        'email',
        'password',
        'role_id',
    ];

    public function rules($method = 'create', $id = null)
    {
        if ($method == 'create') {
            $unique = [
                'username' => 'required|string|unique:users,username|string:max:255',
                'email' => 'required|string|unique:users,email|email|string:max:255',
            ];
        } else {
            $unique = [
                'username' => 'required|string|string:max:255|unique:users,email,' . $id,
                'email' => 'required|string|email|string:max:255|unique:users,email,' . $id,
            ];
        }
        $validate = [
            'password' => 'required|string|max:255',
            'role_id' => 'nullable|exists:roles,id',
        ];
        return array_merge($validate, $unique);
    }

    public function loadModel($request) {foreach ($this->fillable as $key_field) {foreach ($request as $key_request => $value) {if ($key_field == $key_request) $this->setAttribute($key_field, $value);}}}

    public function stories()
    {
        return $this->hasMany(Stories::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
