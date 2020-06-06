<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Super Admin' => [
                'role', 'user', 'permission', 'dictionary', 'setting'
            ], 'Normal User' => [

            ]
        ];

        $c = 0;
        foreach ($roles as $name => $menus){
            $roleId = DB::table('roles')
                ->insertGetId([
                    'name' => $name,
                    'created_at' => now()
                ]);

            foreach ($menus as $menu){
                DB::table('permissions')
                    ->where('route', 'like', "$menu.%")
                    ->get()
                    ->each(function ($permission) use ($roleId) {
                        DB::table('roles_permissions')
                            ->insert([
                                'role_id' => $roleId,
                                'permission_id' => $permission->id,
                                'created_at' => $createdAt = now(),
                                'updated_at' => $createdAt
                            ]);
                    });
            }
        }
    }
}
