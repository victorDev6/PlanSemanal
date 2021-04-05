<?php

use App\organo;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);

        $organo = new organo();
        $organo->descripcion = 'Dirección General';
        $organo->id_parent = 0;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Secretaría Particular';
        $organo->id_parent = 1;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Unidad Ejécutiva';
        $organo->id_parent = 1;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Dirección Administrativa';
        $organo->id_parent = 2;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Unidad Ejécutivo';
        $organo->id_parent = 2;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Unidad Jurídica';
        $organo->id_parent = 2;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Dirección de Planeación';
        $organo->id_parent = 2;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Dirección Técnica Académica';
        $organo->id_parent = 2;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Dirección de Vinculación';
        $organo->id_parent = 2;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Directora de Unidad de Capacitación Comitán';
        $organo->id_parent = 3;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Encargada de Unidad de Capacitación Jiquipilas';
        $organo->id_parent = 3;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Directora de Unidad de Capacitación Catazajá';
        $organo->id_parent = 3;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Encargado de Unidad de Capacitación Reforma';
        $organo->id_parent = 3;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Directora de Unidad de Capacitación Tapachula';
        $organo->id_parent = 3;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Directora de Unidad de Capacitación San Cristóbal de Las Casas';
        $organo->id_parent = 3;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Director de Unidad de Capacitación Tuxtla Gutiérrez';
        $organo->id_parent = 3;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Directora de Unidad de Capacitación Tonalá';
        $organo->id_parent = 3;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Encargado de Unidad de Capacitación Ocosingo';
        $organo->id_parent = 3;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Directora de Unidad de Capacitación Villaflores';
        $organo->id_parent = 3;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Directora de Unidad de Capacitación Yajalón';
        $organo->id_parent = 3;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Recursos Financieros';
        $organo->id_parent = 4;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Recursos Humanos';
        $organo->id_parent = 4;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Recursos Materiales';
        $organo->id_parent = 4;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Área de Desarrollo Administrativo';
        $organo->id_parent = 5;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Aréa Informática';
        $organo->id_parent = 5;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Área de Mercadotecnia';
        $organo->id_parent = 5;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Auxiliar Unidad Jurídica';
        $organo->id_parent = 6;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Programación y Presupuesto';
        $organo->id_parent = 7;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Proyectos y Análisis';
        $organo->id_parent = 7;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Organización y Evaluación';
        $organo->id_parent = 7;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Gestión Académica';
        $organo->id_parent = 8;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Certificación y Control';
        $organo->id_parent = 8;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Información e Innovación Académica';
        $organo->id_parent = 8;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Vinculación Gubernamental';
        $organo->id_parent = 9;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Vinculación Social y Empresarial';
        $organo->id_parent = 9;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Vinculación para la Competitividad';
        $organo->id_parent = 9;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Vinculación';
        $organo->id_parent = 10;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Delegación Administrativa';
        $organo->id_parent = 10;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento Académico';
        $organo->id_parent = 10;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Vinculación';
        $organo->id_parent = 11;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Delegación Administrativa';
        $organo->id_parent = 11;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento Académico';
        $organo->id_parent = 11;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Vinculación';
        $organo->id_parent = 12;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Delegación Administrativa';
        $organo->id_parent = 12;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento Académico';
        $organo->id_parent = 12;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Vinculación';
        $organo->id_parent = 13;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Delegación Administrativa';
        $organo->id_parent = 13;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento Académico';
        $organo->id_parent = 13;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Vinculación';
        $organo->id_parent = 14;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Delegación Administrativa';
        $organo->id_parent = 14;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento Académico';
        $organo->id_parent = 14;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Vinculación';
        $organo->id_parent = 15;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Delegación Administrativa';
        $organo->id_parent = 15;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento Académico';
        $organo->id_parent = 15;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Vinculación';
        $organo->id_parent = 16;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Delegación Administrativa';
        $organo->id_parent = 16;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento Académico';
        $organo->id_parent = 16;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Vinculación';
        $organo->id_parent = 17;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Delegación Administrativa';
        $organo->id_parent = 17;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento Académico';
        $organo->id_parent = 17;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Vinculación';
        $organo->id_parent = 18;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Delegación Administrativa';
        $organo->id_parent = 18;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento Académico';
        $organo->id_parent = 18;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Vinculación';
        $organo->id_parent = 19;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Delegación Administrativa';
        $organo->id_parent = 19;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento Académico';
        $organo->id_parent = 19;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento de Vinculación';
        $organo->id_parent = 20;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Delegación Administrativa';
        $organo->id_parent = 20;
        $organo->save();

        $organo = new organo();
        $organo->descripcion = 'Departamento Académico';
        $organo->id_parent = 20;
        $organo->save();

        User::create([
            'name' => 'Administrador',
            'email' => 'adminRoot6@icatech.com',
            'password' => Hash::make('superUserIcatech21'),
            'id_organo' => 1,
            'id_area' => 1,
            'telefono' => 1234567899
        ])->assignRole('Admin');
    }
}
