<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">Cadastro Cliente</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                        <li class="breadcrumb-item"><a href="index.html">Cadastrar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cliente</li>
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
                    <form action="#">
                        {{-- <div class="card-body">
                            <h4 class="card-title">Formulario de Criação de Usuarios do sistema</h4>
                        </div> --}}
                        {{-- <hr> --}}
                        <div class="form-body">
                            <div class="card-body">
                                <div class="row pt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> Nome / Razão Social</label>
                                            <input type="text" id="firstName" class="form-control" placeholder="Ex.: Alvorada Leite LTDA ">
                                            <small class="form-control-feedback"> Informe a razão social ou nome  </small> </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="control-label">CPF / CNPJ</label>
                                            <input type="text" id="lastName" class="form-control form-control-danger" placeholder="Ex.: 00.000.000/0001-00">
                                            <small class="form-control-feedback"> Informar CPF ou CNPJ. </small> </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <h4 class="card-title mt-5">Address</h4>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10 ">
                                        <div class="form-group">
                                            <label>Rua</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2 ">
                                        <div class="form-group">
                                            <label>Numero</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Bairro</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Cidade</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Estado</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>CEP</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
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
                                <h4 class="card-title">Clientes Cadastrados</h4>
                                {{-- <h6 class="card-subtitle">Similar to tables, use the modifier classes .thead-light to make <code>&lt;thead&gt;</code>s appear light.</h6> --}}
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Razão Social</th>
                                            <th scope="col">CNPJ</th>
                                            <th scope="col"> Data Inclusão</th>
                                            <th scope="col">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                </tbody>
                            </table>
                            {{-- {{$entregas->links()}} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
