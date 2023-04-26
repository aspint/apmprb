<?php

namespace App\Helper;

use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Helpers
{
    public function dataCorteInicioMes(){
        return new DateTime(Date(Date('Y').'/'.Date('m').'/'.'01'));
    }

    public function dataCorteFimMes(){
        return new DateTime( Date(Date('Y').'/'.Date('m').'/'.Date("t", mktime(0,0,0,Date('m'),'01',Date('Y')))));
    }

    public function dataCorteInicioMesPersonalizado($mes){
        return new DateTime(Date(Date('Y').'/'.$mes.'/'.'01'));
    }

    public function dataCorteFimMesPersonalizado($mes){
        return new DateTime( Date(Date('Y').'/'.$mes.'/'.Date("t", mktime(0,0,0,$mes,'01',Date('Y')))));
    }

    public function ultimoDiaMes($mesAno){
        return cal_days_in_month (CAL_GREGORIAN,  substr($mesAno,5,7), substr($mesAno,0,4));
    }


    public function removerMapaCpf(String $cpf){
        $valor = trim($cpf);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("/", "", $valor);
        if(strlen($valor)>14){
            $valor = substr($valor,0,14);
        }
        return $valor;
    }
}
