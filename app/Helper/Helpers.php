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
}
