<?php

?>

<div class="card">
    <img src="<?php echo $perfil['avatar'] ?? $avatar ?>" class="card-img-top" alt="User Image">
    <div class="card-body">
        <h5 class="card-title"><?php echo $perfil['nome'] ?? 'Nome' ?></h5>
        <p class="card-text"><?php echo $perfil['email'] ?? 'Email' ?></p>
        <p class="card-text"><?php echo $perfil['bio'] ?? 'BIO' ?></p>
        <div class="mb-3">
            <h5 class="card-title">Endereço</h5>
            <p class="card-text"><?php echo $perfil['cidade'] . ' - ' . $perfil['uf'] ?></p>
        </div><!--endereco-->
        <div >
            <h5 class="card-title">Redes Sociais</h5>
            <p class="card-text">
                <?php
                foreach ($redes as $key => $value) {
                ?>
                    <a href="<?php echo  $value['link'] ?>" class="btn btn-outline-<?php echo  $value['cor'] ?> btn-sm">
                        <?php echo  $value['nome'] ?>
                    </a>

                <?php
                }
                ?>
            </p>
        </div><!--redes-sociais-->
    </div><!--card-body-->
    <?php
    if ($_SESSION) {
        if ($_SESSION['user'] == $_GET['usuario']) {
    ?>
            <a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=<?php echo $_SESSION['id'] ?>" class="btn btn-primary">Editar Perfil</a>
    <?php
        }
    }
    ?>
</div><!--card-->