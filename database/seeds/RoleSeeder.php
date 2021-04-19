<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $role1 = Role::create(['name' => 'Areas']);
        $role2 = Role::create(['name' => 'Directores']);
        $role3 = Role::create(['name' => 'Validadores']);
        $role4 = Role::create(['name' => 'Direccion']);
        $role5 = Role::create(['name' => 'Admin']);

        Permission::create(['name' => 'actividades.inicio'])->assignRole($role1);
        Permission::create(['name' => 'vtoBueno.inicio'])->assignRole($role2);
        Permission::create(['name' => 'validacion.inicio'])->assignRole($role3);
        Permission::create(['name' => 'plan.inicio'])->assignRole($role4);
        Permission::create(['name' => 'registro.inicio'])->assignRole($role5);
        Permission::create(['name' => 'usuarios.inicio'])->assignRole($role5);
    }
}
