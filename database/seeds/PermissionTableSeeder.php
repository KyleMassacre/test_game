<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $roles = [
            config('core.player_roles'),
            config('core.staff_roles')
        ];

        $arr = \Arr::collapse($roles);

        $arr = array_map(function($arr) {
            return ['name' => $arr];
        }, $arr);

        foreach ($arr as $a)
        {
            Role::create($a);
        }
    }
}
