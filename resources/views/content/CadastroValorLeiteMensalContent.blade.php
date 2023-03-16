<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">Inserir Valor de Leite Mensal</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                        <li class="breadcrumb-item"><a href="index.html">Cadastrar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cadastrar Valor Leite</li>
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
                    <form action="{{route('inserirValorLeiteMensal')}}"  method="POST">
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
                                            <label class="control-label">Data de Referencia:</label>
                                            <input type="date" id="dataReferencia" name="dataReferencia"class="form-control" required >
                                            <small class="form-control-feedback"> Informe a data da referencia(esse campo não pode ser vazio) </small> </div>


                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Tipo Produtor</label>
                                            <select class="form-control custom-select" id="tipo_produtor" name="tipo_produtor" required>
                                                <option value=""></option>
                                                @if(isset($tipoProdutores))
                                                    @foreach ( $tipoProdutores as $tipoProdutor)
                                                        <option value="{{$tipoProdutor->id}}">{{$tipoProdutor->desc_valor}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <small class="form-control-feedback"> Informe o tipo de produtor (este campo não pode ser nulo). </small> </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row pt-3">

                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Valor Bruto:</label>
                                            <input type="number" step="0.00000001"  id="valorBruto" name="valorBruto" class="form-control form-control-danger" placeholder="Ex.:100" required>
                                            <small class="form-control-feedback"> Informe uma quantidade de leite (esse campo não pode ser vazio). </small> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Valor Liquido:</label>
                                            <input type="number" step="0.00000001" id="valorLiquido" name="valorLiquido" class="form-control form-control-danger" placeholder="Ex.:100" required>
                                            <small class="form-control-feedback"> Informe uma quantidade de leite (esse campo não pode ser vazio). </small> </div>
                                    </div>
                                    <!--/span-->
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>Salvar</button>
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
                                <h4 class="card-title">Valores Cadastrados</h4>
                                {{-- <h6 class="card-subtitle">Similar to tables, use the modifier classes .thead-light to make <code>&lt;thead&gt;</code>s appear light.</h6> --}}
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Data referencia</th>
                                            <th scope="col">Tipo Produtor</th>
                                            <th scope="col">Valor Bruto</th>
                                            <th scope="col">Valor Liquido</th>
                                            <th scope="col">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($valoresLeite))
                                        <span hidden>{{$c = 0;}}</span>
                                        @foreach ( $valoresLeite as $valorLeite)
                                        <tr>
                                            <th scope="row">{{$c++/*$valorLeite->valorLeite_id*/}}</th>
                                            <td>{{\Carbon\Carbon::parse($valorLeite->data_referencia)->format('d-m-Y')}}</td>
                                            <td>{{$valorLeite->desc_valor}}</td>
                                            <td>R$ {{$valorLeite->valor_bruto}}</td>
                                            <td>R$ {{$valorLeite->valor_liquido}}</td>
                                            <td>
                                                <form action="{{route('excluirValorLeiteMensal')}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="text" name="idValorLeite" id="idValorLeite" value="{{$valorLeite->valorLeite_id}}" hidden/>
                                                    <button type="submit"
                                                            class="btn btn-warning btn-circle"
                                                            onclick="return confirm('Deseja remover a inclusao com ID {{$valorLeite->valorLeite_id}} ?')"
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
                            {{$valoresLeite->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


