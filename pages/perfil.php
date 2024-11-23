<?php

//Padrao de imagem
$avatar = '';
$capa = '';
$redesImg = '';
if ($avatar == null || $avatar == '' || $capa == null || $capa == '' || $redes == null || $redes == '') {
    $avatar = INCLUDE_PATH . 'static/uploads/avatar.jpg';
    $capa = INCLUDE_PATH . 'static/uploads/capa.jpeg';
    $redesImg = INCLUDE_PATH . 'static/uploads/redes_sociais.jpeg';
};

//var_dump($_SESSION);
$id = isset($_GET['usuario']);

?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-4">
            <?php
            $usuario = $_GET;
            if (isset($_GET['usuario'])) {
                include('components/perfil_sidebar.php');
            } elseif (isset($_GET['usuario_edit'])) {
                include('components/edit_perfil.php');
            }

            ?>
        </div><!--col-md-4-->
        <div class="col-md-8 m-0">
            <?php

            $usuario = $_GET;
            if (isset($_GET['usuario'])) {
                include('components/sobre.php');
            } else if (isset($_GET['usuario_edit'])) {
                include('components/edit_info_adicionais.php');
            }
            ?>
        </div><!--col-md-8-->
    </div><!--row-->
    <?php
    if (isset($_GET['usuario'])) {
    ?>
    <div class="formacao my-3 my-md-5">
        <?php
        include('components/perfil_formacao.php');
        ?>
    </div>

    <div class="interesses-pessoais">
        <?php
        include('components/perfil_interesses_pessoais.php');
        ?>
    </div>

    <?php
    }
    ?>
</div><!--container-->