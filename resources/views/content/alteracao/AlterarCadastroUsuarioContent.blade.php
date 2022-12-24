<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">Alterar Cadastro Usuario</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                        <li class="breadcrumb-item"><a href="index.html">Cadastrar</a></li>
                        <li class="breadcrumb-item" aria-current="page">Cadastro Usuario</li>
                        <li class="breadcrumb-item active" aria-current="page">Alterar</li>
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

                    <form action="{{route('atualizaUsuario')}}"  method="POST">
                        @csrf
                        {{-- <div class="card-body">
                            <h4 class="card-title">Formulario de Criação de usuários do sistema</h4>
                        </div>
                        <hr> --}}
                        <input type="number" name="id" value="{{$edit->id}}" hidden>
                        <div class="form-body">
                            <div class="card-body">
                                <div class="row pt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Nome Completo</label>
                                            <input type="text"
                                                   id="name"
                                                   name="name"
                                                   class="form-control"
                                                   value="{{$edit->name}}"
                                                   required>
                                            <small class="form-control-feedback"> Informe seu nome completo </small> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">E-mail</label>
                                            <input type="email"
                                                   id="email"
                                                   name="email"
                                                   class="form-control form-control-danger"
                                                   value="{{$edit->email}}"
                                                   placeholder="jogao@apmprbm.com.br">
                                            <small class="form-control-feedback"> Informe um e-mail. </small> </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Perfil</label>
                                            <select class="form-control custom-select"
                                                    id="perfil"
                                                    name="perfil"
                                                    required>
                                                <option value="1" {{$edit->tipo_usuario_id == 1 ?'selected':''}}>Administrador</option>
                                                <option value="2" {{$edit->tipo_usuario_id == 2 ?'selected':''}}>Produtor</option>
                                                <option value="3" {{$edit->tipo_usuario_id == 3 ?'selected':''}}>Funcionário</option>
                                            </select>
                                            <small class="form-control-feedback"> Informe qual nivel de acesso </small> </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">CPF</label>
                                            <input type="text"
                                                   id="cpf"
                                                   name="cpf"
                                                   class="form-control form-control-danger cpf"
                                                   value="{{$edit->cpf}}"
                                                   placeholder="123.456.789.01"
                                                   required>
                                            <small class="form-control-feedback"> Informe um cpf, para entrar no sistema. </small> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Password </label>
                                            <input type="password"
                                                   id="password"
                                                   name="password"
                                                   class="form-control form-control-danger"
                                                   placeholder="password"
                                                   >
                                            <small class="form-control-feedback"> Informe a senha padrão </small> </div>
                                    </div>
                                    <!--/span-->
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="card-body">
                                    <button type="submit"
                                            class="btn btn-success">
                                                <i class="fa fa-check"></i>
                                                Alterar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</div>


