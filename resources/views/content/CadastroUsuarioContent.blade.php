<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">Cadastro Usuario</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                        <li class="breadcrumb-item"><a href="index.html">Cadastrar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cadastro Usuario</li>
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

                    <form action="{{route('inserirUsuario')}}"  method="POST">
                        @csrf
                        {{-- <div class="card-body">
                            <h4 class="card-title">Formulario de Criação de usuários do sistema</h4>
                        </div>
                        <hr> --}}
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
                                                   placeholder="João Silva"
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
                                                   placeholder="jogao@apmprbm.com.br"
                                                   required>
                                            <small class="form-control-feedback"> Informe um e-mail, para entrar no sistema. </small> </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Perfil</label>
                                            <select class="form-control custom-select" id="perfil" name="perfil" required>
                                                <option value=""></option>
                                                <option value="1">Administrador</option>
                                                <option value="2">Produtor</option>
                                                <option value="3">Funcionário</option>
                                            </select>
                                            <small class="form-control-feedback"> Informe qual nivel de acesso </small> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Password </label>
                                            <input type="password"
                                                   id="password"
                                                   name="password"
                                                   class="form-control form-control-danger"
                                                   placeholder="password"
                                                   required>
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
                                                Salvar
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
                                <h4 class="card-title">Usuarios Cadastrados</h4>
                                {{-- <h6 class="card-subtitle">Similar to tables, use the modifier classes .thead-light to make <code>&lt;thead&gt;</code>s appear light.</h6> --}}
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nome Completo</th>
                                            <th scope="col">E-mail</th>
                                            <th scope="col">Criado em</th>
                                            <th scope="col">Perfil Usuario</th>
                                            <th scope="col">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($users))
                                            @foreach ( $users as $user)
                                            <tr>
                                                <th scope="row">{{$user->id}}</th>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{\Carbon\Carbon::parse($user->inclusao)->format('d-m-Y')}}</td>
                                                <td>{{$user->perfil}}</td>
                                                <td>
                                                    <form action="{{ route('excluirUsuario') }}" method="POST">
                                                        @csrf
                                                        <input type="text" name="id_usuario" id="id_usuario" value="{{$user->id}}" hidden/>
                                                        <button type="submit"
                                                                class="btn btn-warning btn-circle"
                                                                onclick="return confirm('Deseja remover {{$user->name}} ?')">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
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
                                {{$users->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


