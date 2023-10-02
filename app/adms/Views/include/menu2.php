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
                    <img src="http://localhost/bancoDeDados/mvcAdm/app/adms/assets/img/users/<?php echo $_SESSION['user_id']."/".$_SESSION['user_image'];?>" alt="imagem-usuario-jpj" class="" width="50">
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
 

 
    
    
    
    

       