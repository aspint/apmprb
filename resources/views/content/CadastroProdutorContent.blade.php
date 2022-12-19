<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">Cadastro Produtor</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                        <li class="breadcrumb-item"><a href="index.html">Cadastrar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cadastro Produtor</li>
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
                    <form action="{{route('criarProdutor')}}"  method="POST">
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
                                            <label class="control-label">Nome Completo</label>
                                            <input type="text" id="nome" name="nome"class="form-control" placeholder="Ex.: Fazenda Amanhecer">
                                            <small class="form-control-feedback"> Informe um nome completo para o produtor (esse campo pode ser vazio) </small> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">CPF ou CNPJ</label>
                                            <input type="text" id="cpfcnpj" name="cpfcnpj" class="form-control form-control-danger" placeholder="Ex.: 088.055.546-08">
                                            <small class="form-control-feedback"> Informe um CPF  (esse campo pode ser vazio). </small> </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row pt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">RG ou CNH:</label>
                                            <input type="text" id="identificacao" name="identificacao"class="form-control" placeholder="Ex.: MG 12.232.122">
                                            <small class="form-control-feedback"> Informe um documento de identificação  (esse campo pode ser vazio)</small> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Telefone</label>
                                            <input type="text" id="telefone" name="telefone" class="form-control form-control-danger" placeholder="Ex.:(XX) 9XXXX-XXXX">
                                            <small class="form-control-feedback"> Informe um telefonte (esse campo pode ser vazio). </small> </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row pt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Data Nascimento</label>
                                            <input type="date" id="nascimento" name="nascimento"class="form-control" >
                                            <small class="form-control-feedback"> Informe a data de nascimento (esse campo pode ser vazio) </small> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Tipo Produtor</label>
                                            <select class="form-control custom-select" id="tipo_produtor" name="tipo_produtor">
                                                <option value=""></option>
                                                <option value="1">Produtor Associação</option>
                                                <option value="2">Produtor Terceiro</option>
                                            </select>
                                            <small class="form-control-feedback"> Informe o tipo de produtor (este campo não pode ser nulo). </small> </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row pt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Inscricao:</label>
                                            <input type="text" id="inscricao" name="inscricao" class="form-control form-control-danger" placeholder="Ex.: 3215">
                                            <small class="form-control-feedback"> Informe a inscricao do produtor (esse campo não pode ser vazio) </small> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Associar a Usuario</label>
                                            <select class="form-control custom-select" id="usuario" name="usuario" >
                                                <option value=""></option>
                                                @foreach ($users as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                            <small class="form-control-feedback"> Informe qual usuario pode ser usado por esse cliente(este campo não pode ser nulo). </small> </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
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
                                <h4 class="card-title">Usuarios Cadastrados</h4>
                                {{-- <h6 class="card-subtitle">Similar to tables, use the modifier classes .thead-light to make <code>&lt;thead&gt;</code>s appear light.</h6> --}}
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nome Completo</th>
                                            <th scope="col">CPF ou CNPJ</th>
                                            <th scope="col">Inscricao</th>
                                            <th scope="col">Identidade</th>
                                            <th scope="col">Tipo produtor</th>
                                            <th scope="col">Incluido em</th>
                                            <th scope="col">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($produtores))
                                            @foreach ( $produtores as $produtor)
                                            <tr>
                                                <th scope="row">{{$produtor->id}}</th>
                                                <td>{{$produtor->nome}}</td>
                                                <td>{{$produtor->cpf_cnpj}}</td>
                                                <td>{{$produtor->inscricao}}</td>
                                                <td>{{$produtor->rg}}</td>
                                                <td>{{$produtor->tipo}}</td>
                                                <td>{{\Carbon\Carbon::parse($produtor->inclusao)->format('d-m-Y')}}</td>
                                                <td>
                                                    <form action="{{ route('excluirProdutor', $produtor->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <input type="text" name="id_usuario" id="id_usuario" value="{{$produtor->id}}" hidden/>
                                                        <button type="submit"
                                                                class="btn btn-warning btn-circle"
                                                                onclick="return confirm('Deseja remover {{$produtor->nome}} ?')"
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
                                {{$produtores->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


