<?php

namespace App\Entidade;

class SaldoProdutorEntidade
{
    private $id;
    private $saldo;
    private $datahora_alteracao;
    private $produtor_id;
    private $usuario;





    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of saldo
     */
    public function getSaldo()
    {
        return $this->saldo;
    }

    /**
     * Set the value of saldo
     */
    public function setSaldo($saldo): self
    {
        $this->saldo = $saldo;

        return $this;
    }

    /**
     * Get the value of datahora_alteracao
     */
    public function getDatahoraAlteracao()
    {
        return $this->datahora_alteracao;
    }

    /**
     * Set the value of datahora_alteracao
     */
    public function setDatahoraAlteracao($datahora_alteracao): self
    {
        $this->datahora_alteracao = $datahora_alteracao;

        return $this;
    }

    /**
     * Get the value of produtor_id
     */
    public function getProdutorId()
    {
        return $this->produtor_id;
    }

    /**
     * Set the value of produtor_id
     */
    public function setProdutorId($produtor_id): self
    {
        $this->produtor_id = $produtor_id;

        return $this;
    }

    /**
     * Get the value of usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     */
    public function setUsuario($usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }
}
