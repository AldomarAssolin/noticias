<section class="home py-3">
        <?php
        Site::updateUsusarioOnline();
        
        $usuariosOnline = Painel::listarUsuariosOnline();
        $totalUsuariosCadastrados = Painel::listarUsuariosCadastrado();
        $totalDeVisitas = Painel::totalDeVisitas();
        $VisitasDoDia = Painel::VisitasDoDia();

        include('./components/cardCPainel.php');
        include('./components/cardOnlineUsers.php');
        include('./components/cardUserPainel.php');

        ?>

</section>