<?php

namespace App\Repository;

use App\Entidade\SaldoProdutorEntidade;

interface ISaldoRepository
{
    public function create(SaldoProdutorEntidade $produtor);
    public function read();
    public function update(SaldoProdutorEntidade $produtor);
    public function delete(SaldoProdutorEntidade $produtor);

}
