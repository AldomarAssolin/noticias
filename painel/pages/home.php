<section class="home py-3">

        <?php
        Site::updateUsusarioOnline('painel');
        $usuariosOnline = Painel::listarUsuariosOnline();
        $totalDeVisitas = Painel::totalDeVisitas();
        $totalUsuariosCadastrados = Usuario::listarUsuariosCadastrados(1);
        $usuariosDesativados = Usuario::listarUsuariosDesativados();

        $imagem = '../static/uploads/avatar.jpg';

        if($_SESSION['cargo'] >= 1){
                include('./components/painel_cards_info.php');
                include('./components/painel_cards_adm.php');
        }
        

        ?>

</section>