<?php

//Padrao de imagem
$avatar = '';
$capa = '';
$redesImg = '';
if($avatar == null || $avatar == '' || $capa == null || $capa == '' || $redes == null || $redes == ''){
    $avatar = INCLUDE_PATH . 'static/uploads/avatar.jpg';
    $capa = INCLUDE_PATH . 'static/uploads/capa.jpeg';
    $redesImg = INCLUDE_PATH . 'static/uploads/redes_sociais.jpeg';
};

//var_dump($_SESSION);
$id = $_GET['usuario'];

//Busca View do perfil do usuário
$perfil = Perfil::viewUsuarioPerfil($id);
$redes = Perfil::getAllRedesSociais($id);
$formacao = Perfil::getFormacao($id);
$interesses = Perfil::getInteresses($id);



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
        <div class="col-md-8">
            <?php

            $usuario = $_GET;
            if (isset($_GET['usuario'])) {
                include('components/info_adicionais.php');
            } elseif (isset($_GET['usuario_edit'])) {
                include('components/edit_info_adicionais.php');
            }


            ?>
        </div><!--col-md-8-->
    </div>
</div>