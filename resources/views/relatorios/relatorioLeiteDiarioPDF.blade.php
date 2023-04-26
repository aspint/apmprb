<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
	*, *:after,*:before {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
		text-decoration: none;

	}
    .page-break {
        page-break-after: always;
    }
    .container{
		padding: 25px;
		display: grid;
    }
	.column-1{
		display: grid;
		grid-template-columns:auto;
		height:3vh;
	}
	.column-2{
		display: grid;
		grid-template-columns:auto auto;
		height:3vh;
	}
	.column-3{
		display: grid;
		grid-template-columns:auto auto auto;
		height:3vh;
	}
	.column-4{
		display: grid;
		grid-template-columns:auto auto auto auto;
		height:3vh;
	}

	.hr{
		border-top: 2px solid #000;
	}

	.padding-1{
		padding: 1px;
	}
	.padding-2{
		padding: 2px;
	}
	.padding-3{
		padding: 3px;
	}
	.padding-4{
		padding: 4px;
	}
	.padding-5{
		padding: 5px;
	}
	.padding-6{
		padding: 6px;
	}
	.padding-7{
		padding: 7px;
	}
	.padding-8{
		padding: 8px;
	}.padding-9{
		padding: 9px;
	}
	.padding-10{
		padding: 10px;
	}


	.mb-1{
		margin-bottom: 1px;
	}

	.mb-2{
		margin-bottom: 2px;
	}

	.mb-3{
		margin-bottom: 3px;
	}

	.mb-4{
		margin-bottom: 4px;
	}

	.mb-5{
		margin-bottom: 5px;
	}
    .mb-6{
		margin-bottom: 6px;
	}
    .mb-7{
		margin-bottom: 7px;
	}
    .mb-8{
		margin-bottom: 8px;
	}

	.table {
		margin:auto;
		border-bottom: 1px solid #4d4c4c;
		/*		border:1px solid black;*/
        font-size: 15px;
		text-align: center;
	}
    .table-row {

		border-bottom: 1px solid #c0bcbc;
		/*		border:1px solid black;*/
        padding-bottom: 3px;
	}

	.table-th{
		background-color: #C0C0C0;
		height: 25px;
	}

	.fixar-rodape{
		border-top: 1px solid #333;
		bottom: 0;
		left: 0;
		height: 40px;
		position: fixed;
		width: 100%;
		}

</style>

</head>
<body>
    <div class="container" >
		<h2 style="text-align: center;"> APMPRBM </h2>
        <h3 class="mb-5" style="text-align: center;">ASSOCIAÇÃO DE PEQUENOS E MÉDIOS PRODUTORES RURAIS DE BONFINOPOLIS DE MINAS</h3>
        <div class="hr padding-5"></div>

		<div >
            <table class=" mb-4" width="100%">
                <tr>
                  <td width="auto">Nome: <strong>{{$produtor->nome}}</strong></td>
                  <td width="auto">Inscricao: <strong>{{$produtor->inscricao}}</strong></td>
                  <td width="auto">Tipo Cooperado: <strong> {{$produtor->desc_valor}}</strong></td>
                </tr>
            </table>
		</div>
        <div class=" mb-5">
            <table width="mb-4 " width="100%">
                <tr>
                  <td width="auto">Endereço: <strong></strong></td>
                  <td width="auto">Telefone:<strong></strong> </td>
                  <td width="auto">Mês Referência:<strong>
                    {{\Carbon\Carbon::parse($mesReferencia)->format('m/Y')}}</strong></td>
                </tr>
            </table>
		</div>

		<div class="hr mb-4"></div>
        <h4 class="mb-4" style="text-align: center;">RELATORIO DE CONTROLE DE LEITE DIÁRIO</h4>
        <div class="hr mb-8"></div>
        <div class="column-1 mb-4">
			<table class="table " width="90%">
                <thead>
                    <tr>
				        <th class="table-th" width="5%">#</th>
                        <th class="table-th">DATA ENTREGA</th>
                        <th class="table-th">PERIODO ENTREGA</th>
                        <th class="table-th">QUANTIDADE DE LITROS</th>
                    </tr>
                </thead>
                <tbody>
                @if(isset($relatoriEntregas))
                        @foreach ($relatoriEntregas as $rle )
                        <tr>
                            <td  class="table-row">{{$rle->rlpt_id}}</td>
                            <td  class="table-row">{{\Carbon\Carbon::parse($rle->data_entrega)->format('d/m/Y')}}</td>
                            <td  class="table-row">{{$rle->periodo_valor}}</td>
                            <td  class="table-row">{{$rle->qntd_litros_entregue}}</td>
                        </tr>
                        @endforeach
                        <tr><td height="30px"></td></tr>
                </tbody>
                <tfoot >
                    <tr>
                        <th class="table-th" colspan="3"  style="text-align: right; padding-right:25px;">TOTAL</th><th class="table-th">{{$totalLitros}}L</th>
                    </tr>
                    <tr>
                        <th class="table-th" colspan="3" style="text-align: right; padding-right:25px;">VALOR LITRO LEITE MES</th><th class="table-th" >R$ {{number_format($valorLeiteMes,8, ',', '')}}</th>
                    </tr>
                    <tr>
                        <th class="table-th" colspan="3" style="text-align: right; padding-right:25px;">VALOR RECEBER</th><th class="table-th">R$  {{number_format($valorAReceber,2, ',', '.')}}</th>
                    </tr>
                </tfoot>
                @endif
			</table>
		</div>

</body>
</html>
