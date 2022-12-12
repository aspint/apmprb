<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;
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

        // \App\Models\User::factory(10)->create();

        DB::table('tipo_usuario')->insert([
            'tipo_valor' => 'ADM',
            'descricao' => 'Administrador do sistema',
            'data_inclusao' => new \DateTime()
        ]);

        DB::table('tipo_usuario')->insert([
            'tipo_valor' => 'COMUM',
            'descricao' => 'Usuarios comum do sistema, como produtor',
            'data_inclusao' => new \DateTime()
        ]);

        DB::table('tipo_usuario')->insert([
            'tipo_valor' => 'FUNC',
            'descricao' => 'funcionario da associação',
            'data_inclusao' => new \DateTime()
        ]);


        DB::table('tipo_produtor')->insert([
            'tipo_valor' => 'COMUM',
            'desc_valor' => 'Produtor Comum',
            'datahora_inclusao' => new \DateTime(),
            'datahora_atualizacao' => new \DateTime(),
            'usuario' => 'usuario.batch'
        ]);

        DB::table('tipo_produtor')->insert([
            'tipo_valor' => 'TERCEIRO',
            'desc_valor' => 'Produtor Terceiro',
            'datahora_inclusao' => new \DateTime(),
            'datahora_atualizacao' => new \DateTime(),
            'usuario' => 'usuario.batch'
        ]);

        \App\Models\User::create([
            'name'=>'Administrador',
            'email' =>'admin@apmprbm.com.br',
            'password' => Hash::make('123456'),
            'tipo_usuario_id' => 1,
        ]);


    }
}
