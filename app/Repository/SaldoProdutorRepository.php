<?php

namespace App\Repository;

use App\Entidade\SaldoProdutorEntidade;
use App\Helper\UserHelper;
use Illuminate\Support\Facades\DB;

class SaldoProdutorRepository implements ISaldoRepository{

    public function create(SaldoProdutorEntidade $produtor)
    {
       try {
            DB::table('saldo_produtor')->insert([
                'saldo' => $produtor->getSaldo() == null ? 0.0 : $produtor->getSaldo(),
                'datahora_alteracao' =>new \DateTime(),
                'produtor_id' => $produtor->getProdutorId(),
                'usuario' =>UserHelper::getNameUserLogged(),
            ]);
       } catch (\Throwable $th) {
            echo 'Erro ao inserir na base comunique ao administrador';
            throw $th;
       }

    }

    public function read()
    {

    }

    public function update(SaldoProdutorEntidade $produtor)
    {
        try {
            DB::table('saldo_produtor')->update([
                'saldo' =>$produtor->getSaldo(),
                'datahora_alteracao' =>new \DateTime(),
                'produtor_id' => $produtor->getProdutorId(),
                'usuario' =>UserHelper::getNameUserLogged(),
            ]);
        } catch (\Throwable $th) {
            echo 'Erro ao inserir na base comunique ao administrador';
            throw $th;
        }

    }

    public function delete(SaldoProdutorEntidade $produtor)
    {

    }
}
