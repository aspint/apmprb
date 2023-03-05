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
            'tipo_valor' => 'PROD',
            'descricao' => 'Usuarios de sistema produtor',
            'data_inclusao' => new \DateTime()
        ]);

        DB::table('tipo_usuario')->insert([
            'tipo_valor' => 'FUNC',
            'descricao' => 'Funcionario Associação',
            'data_inclusao' => new \DateTime()
        ]);


        DB::table('tipo_produtor')->insert([
            'tipo_valor' => 'PROD_ASS',
            'desc_valor' => 'Produtor Associação',
            'datahora_inclusao' => new \DateTime(),
            'datahora_atualizacao' => new \DateTime(),
            'usuario' => 'usuario.batch'
        ]);

        DB::table('tipo_produtor')->insert([
            'tipo_valor' => 'PROD_TERCEIRO',
            'desc_valor' => 'Produtor Terceiro',
            'datahora_inclusao' => new \DateTime(),
            'datahora_atualizacao' => new \DateTime(),
            'usuario' => 'usuario.batch'
        ]);

        DB::table('tipo_acao_leite')->insert([
            'tipo_acao_valor' => 'ENTRADA',
            'tipo_acao_descricao' => 'Entrada do leite na associaçao',
            'datahora_inclusao' => new \DateTime(),
            'datahora_atualizacao' => new \DateTime(),
            'usuario' => 'usuario.batch'
        ]);

        DB::table('tipo_acao_leite')->insert([
            'tipo_acao_valor' => 'SAIDA',
            'tipo_acao_descricao' => 'Saida do leite na associaçao',
            'datahora_inclusao' => new \DateTime(),
            'datahora_atualizacao' => new \DateTime(),
            'usuario' => 'usuario.batch'
        ]);

        DB::table('periodo')->insert([
            'periodo_valor' => 'MANHA',
            'periodo_descricao' => 'Periodo da Manhã',
            'data_inclusao' => new \DateTime(),
            'data_alteracao' => new \DateTime(),
            'usuario' => 'usuari.batch'
        ]);

        DB::table('periodo')->insert([
            'periodo_valor' => 'TARDE',
            'periodo_descricao' => 'Periodo da Tarde',
            'data_inclusao' => new \DateTime(),
            'data_alteracao' => new \DateTime(),
            'usuario' => 'usuari.batch'
        ]);

        DB::table('periodo')->insert([
            'periodo_valor' => 'NOITE',
            'periodo_descricao' => 'Periodo da Noite',
            'data_inclusao' => new \DateTime(),
            'data_alteracao' => new \DateTime(),
            'usuario' => 'usuari.batch'
        ]);

        DB::table('fonte_tanque')->insert([
            'fonte_valor' => 'MATRIZ',
            'fonte_descricao' => 'Fonte principal da associação',
            'total_leite' => 0.0,
            'datahora_inclusao' =>new \DateTime(),
            'datahora_atualizacao' =>new \DateTime(),
            'usuario' => 'usuario.batch'
        ]);

        \App\Models\User::create([
            'name'=>'Administrador',
            'email' =>'admin@apmprbm.com.br',
            'cpf' => '00000000001',
            'password' => Hash::make('123456'),
            'tipo_usuario_id' => 1,
        ]);

        \App\Models\User::create([
            'name'=>'Produtor Teste',
            'email' =>'prod@apmprbm.com.br',
            'cpf' => '00000000002',
            'password' => Hash::make('123456'),
            'tipo_usuario_id' => 2,
        ]);

        \App\Models\User::create([
            'name'=>'Funcionario Teste',
            'email' =>'func@apmprbm.com.br',
            'cpf' => '00000000003',
            'password' => Hash::make('123456'),
            'tipo_usuario_id' => 3,
        ]);

        DB::table('status_pagamento')->insert([
            'valor' => 'PAGO',
            'descricao' => 'Pagamento efetuado',
            'datahora_inclusao' =>new \DateTime(),
            'datahora_atualizacao' =>new \DateTime(),
            'usuario' => 'usuario.batch'
        ]);

        DB::table('status_pagamento')->insert([
            'valor' => 'PENDENTE',
            'descricao' => 'Pagamento pendente',
            'datahora_inclusao' =>new \DateTime(),
            'datahora_atualizacao' =>new \DateTime(),
            'usuario' => 'usuario.batch'
        ]);

        DB::table('status_recibo')->insert([
            'valor' => 'ABERTO',
            'descricao' => 'Pagamento pendente de gerar recibo',
            'datahora_inclusao' =>new \DateTime(),
            'datahora_atualizacao' =>new \DateTime(),
            'usuario' => 'usuario.batch'
        ]);

        DB::table('status_recibo')->insert([
            'valor' => 'FECHADO',
            'descricao' => 'Recibo Gerado e Pagamento pendente ',
            'datahora_inclusao' =>new \DateTime(),
            'datahora_atualizacao' =>new \DateTime(),
            'usuario' => 'usuario.batch'
        ]);


    }
}
