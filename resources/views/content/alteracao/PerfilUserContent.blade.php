
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <h5 class="font-medium text-uppercase mb-0">Perfil de Usuario</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                        <li class="breadcrumb-item"><a href="index.html">Configuração</a></li>
                        <li class="breadcrumb-item" aria-current="page">Perfil</li>
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

    <div class="alert alert-danger"> <i class="ti-user"></i> FUNCIONALIDADE AINDA NÃO CONCLUIDA
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
    </div>

    <div class="page-content container-fluid">
    <div class="row">
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <center class="mt-4"> <img src="{{asset('assets/images/logos/logo-icon-coop.png')}}" class="rounded-circle" width="150" />
                            <h4 class="card-title mt-2">{{$response['name']}}</h4>
                            <h6 class="card-subtitle">{{$response['name_full']}}</h6>
                            {{-- <div class="row text-center justify-content-md-center">
                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">254</font></a></div>
                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div>
                            </div> --}}
                        </center>
                    </div>
                    <div>
                        <hr> </div>
                    <div class="card-body"> <small class="text-muted">Email address </small>
                        <h6>{{$response['email']}}</h6> <small class="text-muted pt-4 db">Phone</small>
                        <h6>+91 654 784 547</h6> <small class="text-muted pt-4 db">Address</small>
                        <h6>71 Pilgrim Avenue Chevy Chase, MD 20815</h6>

                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <!-- Tabs -->
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="true">Setting</a>
                        </li>
                    </ul>
                    <!-- Tabs -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade  show active" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <form class="form-horizontal form-material" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <label class="col-md-12">Nome Completo</label>
                                        <div class="col-md-12">
                                            <input  type="text"
                                                    placeholder="Johnathan Doe"
                                                    class="form-control form-control-line"
                                                    value="{{$response['name_full']}}"
                                                    {{-- disabled --}}
                                                    >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input  type="email"
                                                    placeholder="johnathan@admin.com"
                                                    class="form-control form-control-line"
                                                    name="example-email"
                                                    id="example-email"
                                                    value="{{$response['email']}}"
                                                    >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Password</label>
                                        <div class="col-md-12">
                                            <input  type="password"
                                                    class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">CPF</label>
                                        <div class="col-md-12">
                                            <input  type="text"
                                                    placeholder="123.456.789-01" 
                                                    class="form-control form-control-line cpf"
                                                    value="{{$response['cpf']}}"
                                                    disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Nova imagem</label>
                                        <div class="col-md-12">
                                            <input  type="file"
                                                    placeholder="Johnathan Doe"
                                                    class="form-control form-control-line"

                                                    >
                                        </div>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label class="col-md-12">Message</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" class="form-control form-control-line"></textarea>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="form-group">
                                        <label class="col-sm-12">Select Country</label>
                                        <div class="col-sm-12">
                                            <select class="form-control form-control-line">
                                                <option>London</option>
                                                <option>India</option>
                                                <option>Usa</option>
                                                <option>Canada</option>
                                                <option>Thailand</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success">Atualizar Perfil</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>












    </div>
</div>
