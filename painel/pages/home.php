<section class="home py-3">
        <?php
        Site::updateUsusarioOnline('painel');
        $usuariosOnline = Painel::listarUsuariosOnline();
        $totalDeVisitas = Painel::totalDeVisitas();
        $VisitasDoDia = Painel::VisitasDoDia();
        $totalUsuariosCadastrados = Usuario::listarUsuariosCadastrados(1);
        $usuariosDesativados = Usuario::listarUsuariosDesativados();

        $imagem = '../static/uploads/avatar.jpg';

        if($_SESSION['cargo'] >= 1){
                include('./components/cardCPainel.php');
                include('./components/painel_cards_usuarios.php');
        }
        

        ?>

</section>