<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User Profile-->
                    <div class="user-profile text-center dropdown p-3">
                        <div class="user-pic"><img src="{{ asset('assets/images/logos/images.png') }}" alt="users" class="rounded-circle" width="50" /></div>
                        <div class="user-content hide-menu">
                            <a href="javascript:void(0)" class="mt-2" id="Userdd" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h5 class="mb-0 user-name mt-2">{{isset($response)? $response['name']:''}}<i class="fa fa-angle-down"></i></h5>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="Userdd">
                                @include('component.dropdown');
                            </div>
                        </div>
                    </div>
                    <!-- End User Profile-->
                </li>
                <li class="sidebar-item">
                    {{-- <a class="sidebar-link has-arrow waves-effect waves-dark" href="{{route('home')}}" aria-expanded="false"> --}}
                    <a class="sidebar-link waves-effect waves-dark" href="{{route('home')}}" aria-expanded="false">
                        {{-- <i class="mdi mdi-av-timer"></i> --}}
                        <i class="mdi mdi-adjust"></i>
                        <span class="hide-menu">Dashboard</span>
                        {{-- <span class="badge badge-inverse badge-pill ml-auto mr-3 font-medium px-2 py-1">6</span> --}}
                    </a>
                    {{-- <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{route('home')}}" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu"> Dashboard 1 </span>
                            </a>
                        </li>
                    </ul> --}}
                </li>
                @if ($permission->tipo_valor == 'ADM' || $permission->tipo_valor == 'FUNC')
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-apps"></i>
                            <span class="hide-menu">Apps</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a class="has-arrow sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-inbox-arrow-down"></i>
                                    <span class="hide-menu">Leite</span>
                                </a>
                                <ul aria-expanded="false" class="collapse second-level">
                                    <li class="sidebar-item">
                                        <a href="{{route('CadastroLeiteProdutor')}}" class="sidebar-link">
                                            <i class="mdi mdi-email"></i>
                                            <span class="hide-menu"> Recebimento </span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="{{route('CadastroLeiteSaida')}}" class="sidebar-link">
                                            <i class="mdi mdi-email"></i>
                                            <span class="hide-menu"> Saida </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                             <li class="sidebar-item">
                                <a href="{{route('AppRecibosPagamento')}}" class="sidebar-link">
                                    <i class="mdi mdi-comment-processing-outline"></i>
                                    <span class="hide-menu">Pagamentos</span>
                                </a>
                            </li>{{--
                            <li class="sidebar-item">
                                <a class="has-arrow sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-inbox-arrow-down"></i>
                                    <span class="hide-menu">Inbox</span>
                                </a>
                                <ul aria-expanded="false" class="collapse second-level">
                                    <li class="sidebar-item">
                                        <a href="inbox-email.html" class="sidebar-link">
                                            <i class="mdi mdi-email"></i>
                                            <span class="hide-menu"> Email </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item">
                                <a class="has-arrow sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                    <i class="ti-user"></i>
                                    <span class="hide-menu">Contacts</span>
                                </a>
                                <ul aria-expanded="false" class="collapse second-level">
                                    <li class="sidebar-item">
                                        <a href="contact-list.html" class="sidebar-link">
                                            <i class="icon-people"></i>
                                            <span class="hide-menu"> Contact List </span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="contact-grid.html" class="sidebar-link">
                                            <i class="icon-user-follow"></i>
                                            <span class="hide-menu"> Contacts Grid </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item">
                                <a class="has-arrow sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-bookmark-plus-outline"></i>
                                    <span class="hide-menu">Tickets</span>
                                </a>
                                <ul aria-expanded="false" class="collapse second-level">
                                    <li class="sidebar-item">
                                        <a href="ticket-list.html" class="sidebar-link">
                                            <i class="mdi mdi-book-multiple"></i>
                                            <span class="hide-menu"> Ticket List </span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="ticket-detail.html" class="sidebar-link">
                                            <i class="mdi mdi-book-plus"></i>
                                            <span class="hide-menu"> Ticket Detail </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item">
                                <a href="app-taskboard.html" class="sidebar-link">
                                    <i class="mdi mdi-bulletin-board"></i>
                                    <span class="hide-menu"> Taskboard </span>
                                </a>
                            </li> --}}
                        </ul>
                    </li>
                @endif
                <div class="devider"></div>


                @if ($permission->tipo_valor == 'ADM')
                    <li class="sidebar-item" >
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-clipboard-text"></i>
                            <span class="hide-menu">Cadastrar</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="{{route('userFormulario')}}" aria-expanded="false">
                                    <i class="mdi mdi-collage"></i>
                                    <span class="hide-menu">Cadastrar Usuarios</span>
                                </a>
                                {{-- <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a href="form-inputs.html" class="sidebar-link">
                                            <i class="mdi mdi-priority-low"></i>
                                            <span class="hide-menu"> Cadstro Cliente</span>
                                        </a>
                                    </li>
                                </ul> --}}
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="{{route('produtorFormulario')}}" aria-expanded="false">
                                    <i class="mdi mdi-receipt"></i>
                                    <span class="hide-menu">Cadastrar Produtores</span>
                                </a>
                                {{-- <ul aria-expanded="false" class="collapse first-level">
                                    <li class="sidebar-item">
                                        <a href="form-basic.html" class="sidebar-link">
                                            <i class="mdi mdi-vector-difference-ba"></i>
                                            <span class="hide-menu"> Basic Forms</span>
                                        </a>
                                    </li>
                                </ul> --}}
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="{{route('formularioCadastroCliente')}}" aria-expanded="false">
                                    <i class="mdi mdi-receipt"></i>
                                    <span class="hide-menu">Cadastrar Clientes</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="{{route('formularioCadastroFonte')}}" aria-expanded="false">
                                    <i class="mdi mdi-receipt"></i>
                                    <span class="hide-menu">Cadastrar Fonte Tanque</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="{{route('CadastroValorLeite')}}" aria-expanded="false">
                                    <i class="mdi mdi-receipt"></i>
                                    <span class="hide-menu">Cadastrar Valor Leite</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-table"></i>
                        <span class="hide-menu">Relatorio</span>
                        {{-- <span class="badge badge-danger text-white badge-pill ml-auto mr-3 font-medium px-2 py-1">11</span> --}}
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-border-none"></i>
                                <span class="hide-menu">Leite Entregue</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{{route('RelatorioLeiteProdutorDiario')}}" class="sidebar-link">
                                        <i class="mdi mdi-border-all"></i>
                                        <span class="hide-menu">Diario </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{route('RelatorioLeiteProdutorMensal')}}" class="sidebar-link">
                                        <i class="mdi mdi-border-all"></i>
                                        <span class="hide-menu">Mensal </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('RelatorioRecibosPagamento')}}" class="sidebar-link">
                                <i class="mdi mdi-border-top"></i>
                                <span class="hide-menu">Pagamentos</span>
                            </a>
                        </li>
                        @if ($permission->tipo_valor == 'ADM')
                            {{-- <li class="sidebar-item">
                                <a href="table-jsgrid.html" class="sidebar-link">
                                    <i class="mdi mdi-border-top"></i>
                                    <span class="hide-menu">Usuarios</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="table-responsive.html" class="sidebar-link">
                                    <i class="mdi mdi-border-style"></i>
                                    <span class="hide-menu">Clientes</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="table-footable.html" class="sidebar-link">
                                    <i class="mdi mdi-tab-unselected"></i>
                                    <span class="hide-menu">Produtores</span>
                                </a>
                            </li> --}}
                        @endif
                    </ul>
                </li>

                <div class="devider"></div>
                @if ($permission->tipo_valor == 'ADM' || $permission->tipo_valor == 'FUNC')
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-notification-clear-all"></i>
                        <span class="hide-menu">Wiki</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        {{-- <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <i class="mdi mdi-octagram"></i>
                                <span class="hide-menu"> item 1.1</span>
                            </a>
                        </li> --}}
                        <li class="sidebar-item">
                            <a class="has-arrow sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-playlist-plus"></i>
                                <span class="hide-menu">Fluxo</span>
                            </a>
                            <ul aria-expanded="false" class="collapse second-level">
                                <li class="sidebar-item">
                                    <a href="{{route('VideoPlay',['01_ApresentacaoSistema'])}}" class="sidebar-link">
                                        <i class="mdi mdi-octagram"></i>
                                        <span class="hide-menu">Apresentação Plataforma</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{route('VideoPlay',['02_FluxoPrincipalRecebimento'])}}" class="sidebar-link">
                                        <i class="mdi mdi-octagram"></i>
                                        <span class="hide-menu">Fluxo Principal Compra</span>
                                    </a>
                                </li>
                                {{-- <li class="sidebar-item">
                                    <a href="javascript:void(0)" class="sidebar-link">
                                        <i class="mdi mdi-octagram"></i>
                                        <span class="hide-menu"> item 1.3.3</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="javascript:void(0)" class="sidebar-link">
                                        <i class="mdi mdi-octagram"></i>
                                        <span class="hide-menu"> item 1.3.4</span>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>
                      {{--   <li class="sidebar-item">
                            <a class="has-arrow sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-playlist-plus"></i>
                                <span class="hide-menu">Criar Usuario</span>
                            </a>
                            <ul aria-expanded="false" class="collapse second-level">
                                <li class="sidebar-item">
                                    <a href="javascript:void(0)" class="sidebar-link">
                                        <i class="mdi mdi-octagram"></i>
                                        <span class="hide-menu"> item 1.3.1</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="javascript:void(0)" class="sidebar-link">
                                        <i class="mdi mdi-octagram"></i>
                                        <span class="hide-menu"> item 1.3.2</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="javascript:void(0)" class="sidebar-link">
                                        <i class="mdi mdi-octagram"></i>
                                        <span class="hide-menu"> item 1.3.3</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="javascript:void(0)" class="sidebar-link">
                                        <i class="mdi mdi-octagram"></i>
                                        <span class="hide-menu"> item 1.3.4</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <i class="mdi mdi-playlist-check"></i>
                                <span class="hide-menu"> item 1.4</span>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                <div class="devider"></div>
                @endif

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-settings"></i>
                        <span class="hide-menu">Configuração </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{route('configPerfil')}}" class="sidebar-link">
                                <i class="mdi mdi-comment-processing-outline"></i>
                                <span class="hide-menu"> Perfil </span>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
