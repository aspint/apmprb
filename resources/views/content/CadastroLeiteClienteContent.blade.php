<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">Inserir Saida de Leite para Cliente</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                        <li class="breadcrumb-item"><a href="index.html">Apps</a></li>
                        <li class="breadcrumb-item" aria-current="page">Leite</li>
                        <li class="breadcrumb-item active" aria-current="page">Informar Saida</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    @if ($page['formulario'])
        <div class="alert alert-danger"> <i class="ti-user"></i> {{$page['message']}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
        </div>
    @endif
    <div class="alert alert-danger"> <i class="ti-user"></i>
        Funcionalidade ainda não concluida
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
    </div>
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="page-content container-fluid">
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    {{-- <div class="card-header bg-info">
                        <h4 class="mb-0 text-white">Formulario de Usuario</h4>
                    </div> --}}

                
                    <form action="{{route('inserirLeiteCliente')}}"  method="POST">
                        @csrf
                        {{-- <div class="card-body">
                            <h4 class="card-title">Formulario de Criação de Produtor</h4>
                        </div>
                        <hr> --}}
                        <div class="form-body">
                            <div class="card-body">
                                <div class="row pt-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Data da Entrega:</label>
                                            <input type="date" id="data-entrega" name="data-entrega"class="form-control" required  {{$page['formulario']?'disabled':''}}>
                                            <small class="form-control-feedback"> Informe a data da entrega(esse campo não pode ser vazio) </small>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Informar Cliente:</label>
                                            <select class="form-control custom-select" id="cliente-id" name="cliente-id" required {{$page['formulario']?'disabled':''}}>
                                                <option value=""></option>
                                                @if(isset($empresas))
                                                    @foreach ($empresas as $empresa)
                                                        <option value="{{$empresa->id}}"> {{$empresa->id}} | {{$empresa->nome_razao_social}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <small class="form-control-feedback"> Informe o cliente que recebe a remessa do leite(este campo não pode ser nulo). </small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Informar Valor de Venda:</label>
                                            <select class="form-control custom-select" id="valor-leite-mensal-id" name="valor-leite-mensal-id" required {{$page['formulario']?'disabled':''}}>
                                                <option value=""></option>
                                                @if(isset($valorLeiteMensal))
                                                    @foreach ($valorLeiteMensal as $valor)
                                                        <option value="{{$valor->idValor}}">R$ {{number_format($valor->valor_bruto,8, ',', '')}} | {{$valor->desc_valor}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <small class="form-control-feedback"> Informe o valor bruto do leite entregue (este campo não pode ser nulo). </small>
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="row pt-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Informe o periodo:</label>
                                            <select class="form-control custom-select" id="periodo-id" name="periodo-id" required  {{$page['formulario']?'disabled':''}}>
                                                <option value=""></option>
                                                @foreach ($periodos as $periodo)
                                                    <option value="{{$periodo->id}}">{{$periodo->periodo_valor}}</option>
                                                @endforeach
                                            </select>
                                            <small class="form-control-feedback"> Informe um periodo da entrega (esse campo não pode ser vazio)</small> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Quantidade de Leite:</label>
                                            <input type="number" step="0.01" id="quantidade-litros-leite" name="quantidade-litros-leite" class="form-control form-control-danger" placeholder="Ex.:100"  {{$page['formulario']?'disabled':''}}>
                                            <small class="form-control-feedback"> Informe uma quantidade de leite entregue (esse campo não pode ser vazio). </small> </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Tanque:</label>
                                            <select class="form-control custom-select" id="fonte-tanque" name="fonte-tanque"   {{$page['formulario']?'disabled':''}}>
                                                <option value=""></option>
                                                @foreach ($fonteTanques as $fonteTanque)
                                                    <option value="{{$fonteTanque->id}}">{{$fonteTanque->fonte_valor}}</option>
                                                @endforeach
                                            </select>
                                            <small class="form-control-feedback"> Informe o tanque do qual saiu o leite(esse campo não pode ser vazio).</small> </div>
                                    </div>
                                    <!--/span-->
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-success" {{$page['formulario']?'disabled':''}} > <i class="fa fa-check"></i>Salvar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Ultimas Entregas</h4>
                                {{-- <h6 class="card-subtitle">Similar to tables, use the modifier classes .thead-light to make <code>&lt;thead&gt;</code>s appear light.</h6> --}}
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col"  class="text-center">#</th>
                                            <th scope="col"  class="text-center">Cliente</th>
                                            <th scope="col"  class="text-center">Data entrega</th>
                                            <th scope="col"  class="text-center">Periodo entregue</th>
                                            <th scope="col"  class="text-center">Litros entregue</th>
                                            <th scope="col"  class="text-center">Valor Bruto</th>
                                            <th scope="col"  class="text-center">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($entregas))
                                        @foreach ( $entregas as $entrega)
                                        <tr>
                                            <th scope="row"  class="align-middle text-center">{{$entrega->rlpt_id}}</th>
                                            <td class="align-middle text-center">{{$entrega->nome_razao_social}}</td>
                                            <td class="align-middle text-center">{{\Carbon\Carbon::parse($entrega->data_entrega)->format('d/m/Y')}}</td>
                                            <td class="align-middle text-center">{{$entrega->periodo_descricao}}</td>
                                            <td class="align-middle text-center">{{$entrega->qntd_litros_entregue}}L</td>
                                            <td class="align-middle text-center">R$ {{number_format($entrega->valor_bruto,8, ',', '')}}</td>
                                            <td class="align-middle text-center">
                                                <form action="{{route('excluirLeiteProdutor',$entrega->rlpt_id)}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="text" name="id_usuario" id="id_usuario" value="{{$entrega->rlpt_id}}" hidden/>
                                                    <button type="submit"
                                                            class="btn btn-warning btn-circle"
                                                            onclick="return confirm(`Deseja remover
                                                                                    Produtor: {{$entrega->nome_razao_social}},
                                                                                    dia:{{\Carbon\Carbon::parse($entrega->data_entrega)->format('d-m-Y')}}
                                                                                    {{$entrega->periodo_descricao}} ?`)"
                                                            ><i class="fa fa-times"></i></button>
                                                    {{-- <label class="control-label">Excluir </label> --}}
                                                    <small class="form-control-feedback"><br> Excluir </small>
                                                    {{-- <button type='submit'>Enviar</button> --}}
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{$entregas->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


