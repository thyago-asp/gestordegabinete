<ul class="navbar-nav bg-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/view/main">
        <img style="width: 100%" src="/img/Logo-GestorDeGabinete.png" />
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/view/main/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Painel</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu principal
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePessoas" aria-expanded="true" aria-controls="collapsePessoas">
            <i class="fas fa-user-friends"></i>
            <span>Pessoas</span>
        </a>
        <div id="collapsePessoas" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu pessoas</h6>
                <a class="collapse-item" href="/view/pessoas/cadastrar">Cadastrar pessoa</a>
                <a class="collapse-item" href="/view/pessoas/listar">Listar pessoas</a>
                <a class="collapse-item" href="/view/pessoas/visitas">Cadastrar visitas</a>
                <a class="collapse-item" href="/view/pessoas/visitalistar">Listar visitas</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmendas" aria-expanded="true" aria-controls="collapsePessoas">
            <i class="fas fa-user-friends"></i>
            <span>Emendas orçamentarias</span>
        </a>
        <div id="collapseEmendas" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu emendas</h6>
                <a class="collapse-item" href="/view/emendasOrcamentarias/">Emendas Orçamentarias</a>
                <a class="collapse-item" href="/view/emendasOrcamentarias/cadastrar/">Cadastrar emenda</a>
                <a class="collapse-item" href="/view/emendasOrcamentarias/listar/">Listar emendas</a>
              
            </div>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="/view/agenda/">
            <i class="fas fa-calendar-alt"></i>
            <span>Agenda</span></a>
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed" href="/view/requerimentos" data-toggle="collapse" data-target="#collapseReq" aria-expanded="true" aria-controls="collapseReq">
            <i class="fas fa-fw fa-folder"></i>
            <span>Requerimentos</span>
        </a>
        <div id="collapseReq" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div id="requerimentos" class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Cadastros</h6>
                <a class="collapse-item link" value="pedidos" href="/view/requerimentos/cadastrar?pg=pedidos">Pedidos de informações</a>
                <a class="collapse-item link" value="envio" href="/view/requerimentos/cadastrar?pg=envio">Envio de expediente</a>
                <a class="collapse-item link" value="voto" href="/view/requerimentos/cadastrar?pg=voto">Voto de louvor e pesar</a>
                <a class="collapse-item link" value="diversos" href="/view/requerimentos/cadastrar?pg=diversos">Diversos</a>
                <a class="collapse-item link" value="declaracoes" href="/view/requerimentos/cadastrar?pg=declaracoes">Declarações de presenças</a>
                <div class="collapse-divider"></div>
                <a class="collapse-item" href="/view/requerimentos/listar">Listar</a>

            </div>
        </div>
    </li>



    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOficios" aria-expanded="true" aria-controls="collapseOficios">
            <i class="fas fa-fw fa-folder"></i>
            <span>Oficios</span>
        </a>
        <div id="collapseOficios" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Cadastros</h6>
                <a class="collapse-item" href="/view/oficios/cadastrar?pg=informacoes">Informações</a>
                <a class="collapse-item" href="/view/oficios/cadastrar?pg=pedidos">Pedidos</a>
                <a class="collapse-item" href="/view/oficios/cadastrar?pg=respostas">Respostas</a>
                <div class="collapse-divider "></div>
                <a class="collapse-item" href="/view/oficios/listar">Listar</a>
            </div>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePL" aria-expanded="true" aria-controls="collapsePL">
            <i class="fas fa-fw fa-folder"></i>
            <span>Projetos de lei</span>
        </a>
        <div id="collapsePL" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Cadastros</h6>
                <a class="collapse-item" href="/view/projetosDeLei/cadastrar?pg=projetosDeLei">Projetos de lei</a>
                <a class="collapse-item" href="/view/projetosDeLei/cadastrar?pg=projetosDeResolucao">Projetos de resolução</a>
                <a class="collapse-item" href="/view/projetosDeLei/cadastrar?pg=projetosDeLeiComplementar">Projetos de lei complementar</a>
                <a class="collapse-item" href="/view/projetosDeLei/cadastrar?pg=emendaLegislativa">Emenda legislativa</a>
                <a class="collapse-item" href="/view/projetosDeLei/cadastrar?pg=emendaConstitucional">Emenda constitucional</a>
                <div class="collapse-divider "></div>
                <a class="collapse-item" href="/view/projetosDeLei/listar">Listar</a>

            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Administrador
    </div>

    <!-- Nav Item - Pages Collapse Menu -->



    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsUS" aria-expanded="true" aria-controls="collapsUS">
            <i class="fas fa-fw fa-cog"></i>
            <span>Usuarios do sistema</span>
        </a>
        <div id="collapsUS" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Usuarios</h6>
                <a class="collapse-item" href="/view/usuariosdosistema/cadastrar/">Cadastrar</a>
                <a class="collapse-item" href="/view/usuariosdosistema/listar/">Listar</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>