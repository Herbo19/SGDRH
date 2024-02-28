<hr class="sidebar-divider">

<div class="sidebar-heading">
    Empresa
</div>

<!--Secção do Funcionario - Menu-->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#funcMenu"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-users"></i>
        <span>Funcionário</span>
    </a>
    <div id="funcMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opções:</h6>
            <a class="collapse-item" href="{{url('funcionario')}}">Ver todos</a>
            <a class="collapse-item" href="{{url('funcionario/create')}}">Adicionar novo</a>
        </div>
    </div>
</li>
<!-- FIM Secção do Funcionario - Menu-->

<!--Secção do Departamento - Menu-->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#depMenu"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-building"></i>
        <span>Departamento</span>
    </a>
    <div id="depMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opções:</h6>
            <a class="collapse-item" href="{{url('depart')}}">Ver todos</a>
            <a class="collapse-item" href="{{url('depart/create')}}">Adicionar novo</a>
        </div>
    </div>
</li>
<!-- FIM Secção do Departamento - Menu-->

<!--Secção do Cargo - Menu-->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#cargoMenu"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-briefcase"></i>
        <span>Cargo</span>
    </a>
    <div id="cargoMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opções:</h6>
            <a class="collapse-item" href="{{url('cargo')}}">Ver todos</a>
            <a class="collapse-item" href="{{url('cargo/create')}}">Adicionar novo</a>
        </div>
    </div>
</li>
<!-- FIM Secção do Cargo - Menu-->


<!-- Divider -->
<hr class="sidebar-divider">


         <!-- Heading -->
          <div class="sidebar-heading">
            Complementos
        </div>

        <!--Secção do Usuários - Menu-->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#usuaMenu"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-user"></i>
                <span>Usuários</span>
            </a>
            <div id="usuaMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Opções:</h6>
                    <a class="collapse-item" href="{{url('/usuario')}}">Ver Todos</a>
                    <a class="collapse-item" href="{{url('/usuario/create')}}">Adicionar novo</a>
                    <a class="collapse-item" href="{{url('/usuario/tipo/mostrar')}}">Tipo</a>
                </div>
            </div>
        </li>
        <!--FIM Secção do Usuários - Menu-->

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#equipaDefMenu"
            aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Equipa</span>
            </a>
            <div id="equipaDefMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Opções:</h6>
                    <a class="collapse-item" href="{{ url('equipas/create') }}">Adicionar Novo</a>
                    <a class="collapse-item" href="{{ url('/metas/equipa/criar') }}">Criar Meta</a>
                    <a class="collapse-item" href="{{ url('equipa/metas/todas') }}">Mostrar Todas Metas</a>
                </div>
            </div>
        </li>
        <!--FIM Secção do Definição de equipa - Menu-->


    <!-- End of Sidebar -->
