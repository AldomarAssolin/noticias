<section class="home py-3">
        <?php
        Site::updateUsusarioOnline();
        
        $usuariosOnline = Painel::listarUsuariosOnline();
        $totalDeVisitas = Painel::totalDeVisitas();
        $VisitasDoDia = Painel::VisitasDoDia();
        $totalUsuariosCadastrados = Usuario::listarUsuariosCadastrado();
        $usuariosDesativados = Usuario::listarUsuariosDesativados();

        $imagem = '../static/uploads/avatar.jpg';

        if($_SESSION['cargo'] >= 1){
                include('./components/cardCPainel.php');
                include('./components/cardOnlineUsers.php');
                include('./components/cardUserPainel.php');
                include('./components/usuarios_desativados.php');
        }
        

        ?>

</section>