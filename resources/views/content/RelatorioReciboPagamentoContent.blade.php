<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">Relatorio de Recibos Pagamento</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                        <li class="breadcrumb-item">Relatorio</li>
                        {{-- <li class="breadcrumb-item" aria-current="page">Recibo </li> --}}
                        <li class="breadcrumb-item active" aria-current="page">Pagamentos </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    @if (session('message'))
        <div class="alert alert-danger"> <i class="ti-user"></i> {{session('message')}}
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

                    <form action="{{route('RelatorioLeiteProdutorMensalPesquisar')}}"  method="POST">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">Pesquisar relatorio de datas especificas</h4>
                        </div>
                        <hr>
                        <div class="form-body">
                            <div class="card-body">
                                <div class="row pt-6">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Data Inicio</label>
                                            <input type="month"
                                                   id="mes_inicio"
                                                   name="mes_inicio"
                                                   class="form-control"
                                                   required>
                                            <small class="form-control-feedback"> Informe um mês para inicio da pesquisa</small> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Data Fim</label>
                                            <input type="month"
                                                   id="mes_fim"
                                                   name="mes_fim"
                                                   class="form-control"
                                                   required>
                                            <small class="form-control-feedback"> Informe um mês para fim da pesquisa</small> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="card-body">
                                    <button type="submit"
                                            class="btn btn-success" disabled>
                                                <i class="fa fa-check"></i>
                                                Pesquisar
                                    </button>
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
                                <h4 class="card-title">Recibos de Pagamentos do Produtor Disponiveis</h4>
                                {{-- <h6 class="card-subtitle">Similar to tables, use the modifier classes .thead-light to make <code>&lt;thead&gt;</code>s appear light.</h6> --}}
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="text-center">Nº Recibo</th>
                                            <th scope="col" class="text-center">Data Ref.</th>
                                            <th scope="col" class="text-center">Data Inicio</th>
                                            <th scope="col" class="text-center">Data Fim</th>
                                            <th scope="col" class="text-center">Recibo</th>
                                            <th scope="col" class="text-center">Pagamento</th>
                                            <th scope="col" class="text-center">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($reciboPagamento))
                                            @foreach ( $reciboPagamento as $recibo)
                                            <tr>
                                                <th  class="align-middle text-center" scope="row">{{$recibo->id}}</th>
                                                <td  class="align-middle text-center" >{{\Carbon\Carbon::parse($recibo->mes_referencia)->format('d/m/Y')}}</td>
                                                <td  class="align-middle text-center">{{\Carbon\Carbon::parse($recibo->periodo_inicio)->format('d/m/Y')}}</td>
                                                <td  class="align-middle text-center">{{\Carbon\Carbon::parse($recibo->periodo_fim)->format('d/m/Y')}}</td>
                                                <td  class="align-middle text-center">{{$recibo->status_recibo_valor}}</td>
                                                <td  class="align-middle text-center">{{$recibo->status_pagamento_valor}}</td>
                                                {{-- <td>{{$user->perfil}}</td> --}}
                                                <td class="text-center">
                                                    <form action="{{ route('GerarPDFRelatorioLeiteProdutorMensalPesquisar') }}" method="POST" class="form-inline">
                                                        @csrf
                                                        <input type="text" name="id_recibo" id="id_recibo" value="{{$recibo->id}}" hidden/>
                                                        <input type="text" name="data_ref_recibo" id="data_ref_recibo" value="{{$recibo->mes_referencia}}" hidden/>
                                                        <button type="submit"
                                                                class="btn btn-info btn-circle ">
                                                                    <i class="far fa-file-pdf"></i>
                                                                </button>

                                                        <small class="form-control-feedback" ><br> Gerar PDF </small>
                                                        {{-- <button type='submit'>Enviar</button> --}}
                                                    </form>
                                                </td>
                                            </tr>
                                             @endforeach
                                             @endif
                                    </tbody>
                                </table>
                                @if(isset($reciboPagamento))
                                 {{$reciboPagamento->links()}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

