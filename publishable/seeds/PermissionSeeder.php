<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            'authentication' => [
                'role', 'user', 'permission'
            ], 'setting' => [
                'dictionary', 'setting'
            ]
        ];

        $icons = [
            // global icons
            'read' => 'fa-eye',
            'edit' => 'fa-edit',
            'add' => 'fa-plus',
            'delete' => 'fa-trash',

            // menu
            'dictionary' => 'fa-language',
            'user' => 'fa-users',
            'role' => 'fa-key',
            'permission' => 'fa-lock',
            'setting' => 'fa-cog'
        ];

        $menuCounter = 0;
        foreach ($groups as $group => $menus){
            foreach ($menus as $menu){
                foreach (['browse', 'read', 'edit', 'add', 'delete'] as $bread){
                    DB::table('permissions')
                        ->insert([
                            'name' => ($bread == 'browse')
                                ? ucwords($menu)
                                : ucwords($bread.' '.$menu),
                            'menu' => $bread == 'browse',
                            'group' => $group,
                            'icon' => ($icons[$menu] ?? $icons[$bread]),
                            'order' => ($bread == 'browse')
                                ? $menuCounter++
                                : null,
                            'route' => $menu.'.'.$bread,
                            'uri' => !in_array($bread, ['browse', 'add'])
                                ? $menu.'/'.$bread.'/{id}'
                                : $menu.'/'.$bread,
                            'note' => 'Admin can '.$bread.' '.$menu,
                            'created_at' => $createdAt = now(),
                            'updated_at' => $createdAt
                        ]);
                }
            }
        }

        DB::table('permissions')
            ->where('name', 'Setting')
            ->update(['name' => 'More Settings']);
    }
}
