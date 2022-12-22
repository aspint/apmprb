<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">Relatorio Leite Diario</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                        <li class="breadcrumb-item">Relatorio</li>
                        <li class="breadcrumb-item" aria-current="page">Leite Entregue </li>
                        <li class="breadcrumb-item active" aria-current="page">Diario </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="page-content container-fluid">




        <div class="card-group">
            <div class="card p-2 p-lg-3">
                <div class="p-lg-3 p-2">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-circle btn-danger text-white btn-lg">
                        <i class="fas fa-weight"></i>
                    </button>
                        <!--<div class="ml-4" style="width: 38%;">
                            {{-- <h4 class="font-light">Total Leite Entregue</h4> --}}
                            <div class="progress">
                                <div class="progress-bar bg-danger"
                                    role="progressbar"
                                    style="width: 40%"
                                    aria-valuenow="40"
                                    aria-valuemin="0"
                                        aria-valuemax="40"></div>
                            </div>
                        </div>
                        <div class="ml-auto">-->
                        <div class="ml-4">
                            <h4 class="font-light">Total Leite Entregue</h4>
                            <h2 class="display-7 mb-0">{{isset($DashboardRelatorioLeiteProdutor) ? $DashboardRelatorioLeiteProdutor['totalLitros'] : '0'}}L</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-2 p-lg-3">
                <div class="p-lg-3 p-2">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-circle btn-cyan text-white btn-lg" href="javascript:void(0)">
                        <i class="fas fa-truck-moving"></i>
                    </button>
                       <!-- <div class="ml-4" style="width: 38%;">
                            <h4 class="font-light">Valor do Litro Leite</h4>
                            <div class="progress">
                                <div class="progress-bar bg-cyan" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>
                            </div>
                        </div>
                        <div class="ml-auto">-->
                        <div class="ml-4">
                            <h4 class="font-light">Valor do Litro Leite</h4>
                            <h2 class="display-7 mb-0">R${{isset($DashboardRelatorioLeiteProdutor)?$DashboardRelatorioLeiteProdutor['valorLeiteMes']: ' 0.00'}}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-2 p-lg-3">
                <div class="p-lg-3 p-2">
                   <div class="d-flex align-items-center">
                        <button class="btn btn-circle btn-warning text-white btn-lg" href="javascript:void(0)">
                        <i class="fas fa-prescription-bottle"></i>
                   </button>
                    <!-- <div class="ml-4" style="width: 38%;">
                            <h4 class="font-light">Valor a Receber</h4>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>
                            </div>
                        </div>
                        <div class="ml-auto">-->
                        <div class="ml-4">
                            <h4 class="font-light">Valor a Receber</h4>
                            <h2 class="display-7 mb-0">R$ {{isset($DashboardRelatorioLeiteProdutor) ? $DashboardRelatorioLeiteProdutor['valorAReceber'] : ' 0.00'}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Relatorio de Leite Entregue</h4>
                                {{-- <h6 class="card-subtitle">Similar to tables, use the modifier classes .thead-light to make <code>&lt;thead&gt;</code>s appear light.</h6> --}}
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Data da Entrega</th>
                                            <th scope="col">Periodo</th>
                                            <th scope="col">Quantidade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($RelatorioLeiteProdutor))
                                        @foreach ( $RelatorioLeiteProdutor as $entrega)
                                        <tr>
                                            <th scope="row">{{$entrega->rlpt_id}}</th>
                                            <td>{{\Carbon\Carbon::parse($entrega->data_entrega)->format('d-m-Y')}}</td>
                                            <td>{{$entrega->periodo_descricao}}</td>
                                            <td>{{$entrega->qntd_litros_entregue}}L</td>
                                        </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                @if(isset($RelatorioLeiteProdutor))
                                    {{$RelatorioLeiteProdutor->links()}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>

