
<div class="p-2 m-2 shadow">
    <?php
    
    if($_SESSION['cargo'] > 1){
        include('./components/painel_cards_usuarios_online.php');
        include('./components/usuarios_cadastrados.php');
        include('./components/usuarios_desativados.php');
    }else{
        include('./pages/lista_artigos_autor.php');
    }
    
    ?>
</div>