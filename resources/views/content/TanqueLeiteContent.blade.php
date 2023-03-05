<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">Cadastro Fonte Tanque</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                        <li class="breadcrumb-item"><a href="index.html">Cadastrar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cadastro Fonte Tanque</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

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
                    <form action="{{route('criarTanqueFonte')}}"  method="POST">
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
                                            <label class="control-label">Identificação</label>
                                            <input type="text" id="identificacao" name="identificacao" class="form-control form-control-danger remove-espace" placeholder="Ex.: TANQUE01_ALVORADA" required>
                                            <small class="form-control-feedback"> Informe uma identificação sem espaço  (Espaços e caracteres especiais serão removidos e será usado maiusculas). </small> </div>
                                    </div>
                                     <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Descrição</label>
                                            <input type="text" id="desc" name="desc"class="form-control" placeholder="Ex.: Tanque 01 alvorada" required>
                                            <small class="form-control-feedback"> Detalhe informações do tanque </small> </div>
                                    </div>
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


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Fonte Tanque Cadastrados</h4>
                                {{-- <h6 class="card-subtitle">Similar to tables, use the modifier classes .thead-light to make <code>&lt;thead&gt;</code>s appear light.</h6> --}}
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Identificação</th>
                                            <th scope="col">Descricao</th>
                                            <th scope="col">Total Leite</th>
                                            <th scope="col">Incluido em</th>
                                            <th scope="col">Atualizado em</th>
                                            <th scope="col">Por Usuario</th>
                                            <th scope="col">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($FonteTanqueLeite))
                                            @foreach ( $FonteTanqueLeite as $tanque)
                                            <tr>
                                                <th scope="row">{{$tanque->id}}</th>
                                                <td>{{$tanque->fonte_valor}}</td>
                                                <td>{{$tanque->fonte_descricao}}</td>
                                                <td>{{$tanque->total_leite}}</td>
                                                <td>{{\Carbon\Carbon::parse($tanque->datahora_inclusao)->format('d/m/Y - H:m')}}</td>
                                                <td>{{\Carbon\Carbon::parse($tanque->datahora_atualizacao)->format('d/m/Y - H:m')}}</td>
                                                <td>{{$tanque->usuario}}</td>
                                                <td>
                                                    <form action="{{ route('excluirFonte', $tanque->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <input type="text" name="id_usuario" id="id_usuario" value="{{$tanque->id}}" hidden/>
                                                        <button type="submit"
                                                                class="btn btn-warning btn-circle"
                                                                onclick="return confirm('Deseja remover {{$tanque->fonte_valor}} ?')"
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
                                {{$FonteTanqueLeite->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


