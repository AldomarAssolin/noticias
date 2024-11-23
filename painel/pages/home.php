<section class="home py-3">
        <?php
        Site::updateUsusarioOnline();
        
        $usuariosOnline = Painel::listarUsuariosOnline();
        $totalDeVisitas = Painel::totalDeVisitas();
        $VisitasDoDia = Painel::VisitasDoDia();
        $totalUsuariosCadastrados = Usuario::listarUsuariosCadastrados();
        $usuariosDesativados = Usuario::listarUsuariosDesativados();

        $imagem = '../static/uploads/avatar.jpg';

        if($_SESSION['cargo'] >= 1){
                include('./components/painel_cards_usuarios.php');
                include('./components/cardUserPainel.php');
                include('./components/usuarios_desativados.php');
        }
        

        ?>

</section>