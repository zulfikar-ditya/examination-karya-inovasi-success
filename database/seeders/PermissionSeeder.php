<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'admin' => [
                'user' => ['create', 'read', 'update', 'delete'],
                'category' => ['create', 'read', 'update', 'delete'],
                'article' => ['create', 'read', 'update', 'delete'],
                'role' => ['create', 'read', 'update', 'delete'],
                'permission' => ['create', 'read', 'update', 'delete'],
            ],
            'user' => [
                'category' => ['create', 'read', 'update', 'delete'],
            ]
        ];

        foreach ($permissions as $permission_key => $permission) {
            $role = Role::create([
                'name' => $permission_key,
            ]);
            
            foreach ($permission as $permission_key_2 => $value) {

                foreach ($value as $key => $value) {
                    # code...
                    $model = Permission::create([
                        'name' => $value . $permission_key_2,
                    ]);
                    RolePermission::create([
                        'role_id' => $role->id,
                        'permission_id' => $model->id
                    ]);
                }

            }
        }

    }
}
