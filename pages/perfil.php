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

            include('components/info_adicionais.php');
            
            ?>
        </div><!--col-md-8-->
    </div>
</div>