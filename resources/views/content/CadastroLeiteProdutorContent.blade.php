<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">Inserir Recebimento de Leite</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                        <li class="breadcrumb-item"><a href="index.html">Apps</a></li>
                        <li class="breadcrumb-item" aria-current="page">Leite</li>
                        <li class="breadcrumb-item active" aria-current="page">Informar Recebimento</li>
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

                    {{-- <form action="{{route('inserirUsuario')}}"  method="POST"> --}}
                    <form action="{{route('inserirLeiteProdutor')}}"  method="POST">
                        @csrf
                        {{-- <div class="card-body">
                            <h4 class="card-title">Formulario de Criação de Produtor</h4>
                        </div>
                        <hr> --}}
                        <div class="form-body">
                            <div class="card-body">
                                <div class="row pt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Data da Entrega:</label>
                                            <input type="date" id="dataEntrega" name="dataEntrega"class="form-control" required  {{$page['formulario']?'disabled':''}}>
                                            <small class="form-control-feedback"> Informe a data da entrega(esse campo não pode ser vazio) </small>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Informar Produtor:</label>
                                            <select class="form-control custom-select" id="produtor" name="produtor" required {{$page['formulario']?'disabled':''}}>
                                                <option value=""></option>
                                                @foreach ($produtores as $produtor)
                                                    <option value="{{$produtor->id}}"> {{$produtor->inscricao}} - {{$produtor->nome}}</option>
                                                @endforeach
                                            </select>
                                            <small class="form-control-feedback"> Informe o produtor que fez a entrega(este campo não pode ser nulo). </small>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    {{-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Informar Valor Leite:</label>
                                            <select class="form-control custom-select"
                                                     id="valorLeiteMensal"
                                                     name="valorLeiteMensal"
                                                     required {{$page['formulario']?'disabled':''}}>
                                                <option value=""></option>
                                                @foreach ($valorLeiteMensal as $valorLeite)
                                                    <option
                                                        value="{{$valorLeite->id}}">
                                                        {{$valorLeite->desc_valor}} | Vencimento: {{\Carbon\Carbon::parse($valorLeite->data_referencia)->format('d-m-Y')}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="form-control-feedback"> Escolha o valor vigente para o produtor. </small>
                                        </div>
                                    </div> --}}
                                </div>
                                <!--/row-->
                                <div class="row pt-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Informe o periodo:</label>
                                            <select class="form-control custom-select" id="periodo" name="periodo" required  {{$page['formulario']?'disabled':''}}>
                                                <option value=""></option>
                                                @foreach ($periodos as $periodo)
                                                    <option value="{{$periodo->id}}">{{$periodo->periodo_valor}}</option>
                                                @endforeach
                                            </select>
                                            <small class="form-control-feedback"> Informe um periodo de entrega (esse campo não pode ser vazio)</small> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Quantidade de Leite:</label>
                                            <input type="number" step="0.01" id="quantidadeLitros" name="quantidadeLitros" class="form-control form-control-danger" placeholder="Ex.:100"  {{$page['formulario']?'disabled':''}}>
                                            <small class="form-control-feedback"> Informe uma quantidade de leite (esse campo não pode ser vazio). </small> </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Tanque:</label>
                                            <select class="form-control custom-select" id="fonteTanque" name="fonteTanque"   {{$page['formulario']?'disabled':''}}>
                                                <option value=""></option>
                                                @foreach ($fonteTanques as $fonteTanque)
                                                    <option value="{{$fonteTanque->id}}">{{$fonteTanque->fonte_valor}}</option>
                                                @endforeach
                                            </select>
                                            <small class="form-control-feedback"> Informe um tanque (esse campo não pode ser vazio)</small> </div>
                                    </div>
                                    <!--/span-->
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-success" {{$page['formulario']?'disabled':''}}> <i class="fa fa-check"></i>Salvar</button>
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
                                <h4 class="card-title">Ultimos Recebimentos</h4>
                                {{-- <h6 class="card-subtitle">Similar to tables, use the modifier classes .thead-light to make <code>&lt;thead&gt;</code>s appear light.</h6> --}}
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Produtor</th>
                                            <th scope="col">Data entrega</th>
                                            <th scope="col">Periodo entregue</th>
                                            <th scope="col">Litros entregue</th>
                                            <th scope="col">Valor Bruto</th>
                                            <th scope="col">Valor Liquido</th>
                                            <th scope="col">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($entregas))
                                        @foreach ( $entregas as $entrega)
                                        <tr>
                                            <th scope="row">{{$entrega->rlpt_id}}</th>
                                            <td>{{$entrega->nome}}</td>
                                            <td>{{\Carbon\Carbon::parse($entrega->data_entrega)->format('d-m-Y')}}</td>
                                            <td>{{$entrega->periodo_descricao}}</td>
                                            <td>{{$entrega->qntd_litros_entregue}}L</td>
                                            <td>R$ {{number_format($entrega->valor_bruto,8, ',', '')}}</td>
                                            <td>R$ {{number_format($entrega->valor_liquido,8, ',', '')}}</td>
                                            <td>
                                                <form action="{{route('excluirLeiteProdutor',$entrega->rlpt_id)}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="text" name="id_usuario" id="id_usuario" value="{{$entrega->rlpt_id}}" hidden/>
                                                    <button type="submit"
                                                            class="btn btn-warning btn-circle"
                                                            onclick="return confirm(`Deseja remover
                                                                                    Produtor: {{$entrega->nome}},
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


