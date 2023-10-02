<?php
if (!defined('RSR1937NA')) {
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
}
?>

<header>
    <nav class="navbar">
        <div class="navbar-content">
            <div class="bars">
                <i class="fa-solid fa-bars"></i>
            </div>
            <img src="http://localhost/bancoDeDados/mvcAdm/app/adms/assets/img/logo" alt="logo" class="logo" width="30">
        </div>
        <div class="navbar-content">
            <div class="notificacao">
                <i class="fa-solid fa-bell"></i>
                <span class="number">7</span>
                <div class="dropdow-menu">
                    <div class="dropdown-content">
                        <li>
                            <img src="img/homem.png" alt="avatar-usuário" width="60">
                            <div class="text">
                                5Lorem ipsum dolor officia molestiae explicabo eligendi cum suscipit.
                            </div>
                        </li>
                        <li>
                            <img src="img/homem.png" alt="avatar-usuário" width="60">
                            <div class="text">
                                8 Lorem ipsum dolor officia molestiae explicabo eligendi cum suscipit.
                            </div>
                        </li>
                    </div>
                </div>
            </div>
            <div class="avatar">
                <img src="http://localhost/bancoDeDados/mvcAdm/app/adms/assets/img/users/<?php echo $_SESSION['user_id'] . "/" . $_SESSION['user_image']; ?>" alt="imagem-usuario-jpj" class="" width="50">
                <div class="dropdow-menu setting ">
                    <div class="item">
                        <span class="fa-solid fa-user"><a href="<?php echo URLADM ?>view-profile/index">Perfil</a></i></span>
                    </div>
                    <div class="item">
                        <span id="config" class="fa-solid fa-gears"><a href="<?php echo URLADM ?>view-profile/index">Configuração</a></span>
                    </div>
                    <div class="item">
                        <span class="fa-solid fa-arrow-right-from-bracket"></i><a href="<?php echo URLADM ?>logaut/index">Sair</a></span>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
<article class="content">
    <div class="sidebar">
        <div class="">
            <a href="<?php echo URLADM; ?>dashboard/index" class="sidebar-nav active">
                <i class="icon fa-solid fa-house-user"></i><span>Menu</span></a>
        </div>
        <button class="dropdown-btn">
            <i class="icon fa-solid fa-users"></i><span>Usuários</span><i class="fa-solid fa-sort-down"></i>
        </button>
        <div class="dropdown-contener">
            <a href="<?php echo URLADM; ?>list-users/index" class="sidebar-nav ">
                <i class="icon fa-solid fa-users-line"></i><span>Listar Usuários</span></a>

            <a href="lista.html" class="sidebar-nav">
                <i class="icon fa-solid fa-user-plus"></i><span>Adicinar Usuários</span></a>

        </div>
        <button class="dropdown-btn">
            <i class="icon fa-solid fa-database"></i><span>Base de Dados</span><i class="fa-solid fa-sort-down"></i>
        </button>
        <div class="dropdown-contener">
            <a href="<?php echo URLADM; ?> add-compras/index" class="sidebar-nav ">
                <i class="icon fa-solid fa-arrow-up-short-wide"></i><span>Listar Compras</span></a>
            <a href="<?php echo URLADM; ?> result-sequencia/index" class="sidebar-nav ">
                <i class="icon fa-solid fa-calculator"></i><span>Conferir Sequencia</span></a>
            <a href="lista.html" class="sidebar-nav ">
                <i class="icon fa-solid fa-arrow-up-short-wide"></i><span>Listar Repetições</span></a>
        </div>
        <button class="dropdown-btn">
            <i class="icon fa-solid fa-calendar-days"></i><span>Calculos</span><i class="fa-solid fa-sort-down"></i>
        </button>
        <div class="dropdown-contener">
            <a href="<?php echo URLADM; ?>add-jogos/index&key=jogos" class="sidebar-nav ">
                <i class="icon fa-sharp fa-solid fa-file-import"></i><span>Gerar Jogos</span></a>

            <a href="<?php echo URLADM; ?>listar-jogos/index" class="sidebar-nav ">
                <i class="icon fa-solid fa-arrow-up-from-bracket"></i><span>Meus Jogos</span></a>

            <a href="<?php echo URLADM; ?>valores/index&key=key" class="sidebar-nav">
                <i class="icon fa-solid fa-square-poll-horizontal"></i><span>Meus Resultados</span></a>

        </div>
    </div>