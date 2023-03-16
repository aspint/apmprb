<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">Alterar Cadastro Produtor</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                        <li class="breadcrumb-item"><a href="index.html">Alterar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Alteração Cadastro Produtor</li>
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
                    <form action="{{route('atualizarProdutor')}}"  method="POST">
                        @csrf
                        {{-- <div class="card-body">
                            <h4 class="card-title">Formulario de Criação de Produtor</h4>
                        </div>
                        <hr> --}}
                        <input type="number" name="id" value="{{$edit->id}}" hidden>
                        <div class="form-body">
                            <div class="card-body">
                                <div class="row pt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Nome Completo</label>
                                            <input  type="text"
                                                    id="nome"
                                                    name="nome"
                                                    class="form-control"
                                                    value="{{$edit->nome}}"
                                                    placeholder="Ex.: Fazenda Amanhecer" required>
                                            <small class="form-control-feedback"> Informe um nome completo para o produtor (esse campo pode ser vazio) </small> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">CPF ou CNPJ</label>
                                            <input  type="text"
                                                    id="cpfcnpj"
                                                    name="cpfcnpj"
                                                    class="form-control form-control-danger"
                                                    placeholder="Ex.: 088.055.546-08"
                                                    required
                                                    value="{{$edit->cpf_cnpj}}"
                                                    >
                                            <small class="form-control-feedback"> Informe um CPF  (esse campo pode ser vazio). </small> </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row pt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">RG ou CNH:</label>
                                            <input  type="text"
                                                    id="identificacao"
                                                    name="identificacao"
                                                    class="form-control"
                                                    placeholder="Ex.: MG 12.232.122"
                                                    required
                                                    value="{{$edit->rg}}"
                                                    >
                                            <small class="form-control-feedback"> Informe um documento de identificação  (esse campo pode ser vazio)</small> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Telefone</label>
                                            <input  type="text"
                                                    id="telefone"
                                                    name="telefone"
                                                    class="form-control form-control-danger"
                                                    placeholder="Ex.:(XX) 9XXXX-XXXX"
                                                    value="{{$edit->telefone}}"
                                                    >
                                            <small class="form-control-feedback"> Informe um telefonte (esse campo pode ser vazio). </small> </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row pt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Data Nascimento</label>
                                            <input  type="date"
                                                    id="nascimento"
                                                    name="nascimento"
                                                    class="form-control"
                                                    value="{{$edit->data_nascimento}}"
                                                    >
                                            <small class="form-control-feedback"> Informe a data de nascimento (esse campo pode ser vazio) </small> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Tipo Produtor</label>
                                            <select class="form-control custom-select"
                                                    id="tipo_produtor" name="tipo_produtor" required>
                                                <option value="" ></option>
                                                @if(isset($tipoProdutores))
                                                    @foreach ( $tipoProdutores as $tipoProdutor)
                                                        <option value="{{$tipoProdutor->id}}" {{$tipoProdutor->id == $edit->tipo_produtor_id ?'selected':''}}>{{$tipoProdutor->desc_valor}}</option>
                                                    @endforeach
                                                @endif
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
                                            <input type="number"
                                                    id="inscricao"
                                                    name="inscricao"
                                                    class="form-control form-control-danger"
                                                    placeholder="Ex.: 3215"
                                                    value="{{$edit->inscricao}}"
                                                    required>
                                            <small class="form-control-feedback"> Informe a inscricao do produtor (esse campo não pode ser vazio) </small> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Associar a Usuario</label>
                                            <select class="form-control custom-select" id="users_id" name="users_id" >
                                                <option value=""></option>
                                                @foreach ($users as $user)
                                                    <option value="{{$user->id}}" {{$edit->users_id == $user->id ?'selected':''}}>{{$user->name}}</option>
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
                                    <button type="submit"
                                            class="btn btn-success">
                                                <i class="fa fa-check"></i>
                                                Alterar
                                    </button>
                                    <a class="btn  btn-info text-decoration-none"
                                        href="{{route('backFormularioProdutor')}}">
                                                <i class="fas fa-angle-left"></i>
                                                Voltar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Row -->

    </div>
</div>


