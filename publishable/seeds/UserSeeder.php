<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = DB::table('users')
            ->insertGetId([
                'name' => 'Tanya Degurechaff',
                'email' => 'bake@radevlabs.com',
                'password' => bcrypt('secret123'),
                'created_at' => $createdAt = now(),
                'updated_at' => $createdAt
            ]);

        DB::table('roles')
            ->get()
            ->each(function ($role) use ($userId) {
                DB::table('users_roles')
                    ->insert([
                        'user_id' => $userId,
                        'role_id' => $role->id
                    ]);
            });
    }
}
