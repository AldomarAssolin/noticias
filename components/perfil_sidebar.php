<?php

if (isset($_SESSION['login'])) {
    if ($_GET['usuario'] == $_SESSION['user']) {
        $email = $_GET['usuario'];
        $usuario = Usuario::buscarUsuario($email);
    } else {
        $email = $_GET['usuario'];
        $usuario = Usuario::buscarUsuario($email);
    }
} else {
    $email = $_GET['usuario'];
    $usuario = Usuario::buscarUsuario($email);
}

$nome = $usuario['nome'] ?? $email;
$formacao = 'Análise e Desenvolvimento de Sistemas';
$bio = $usuario['bio'] ?? 'Meu nome é Aldomar Assolin, meu apelido é Manex, fui soldador por 15 anos, Hoje faço Análise e Desenvolvimento de Sistemas, estou no 5° semestre.';

if ($usuario['img'] != NULL) {
    $img = INCLUDE_PATH_PAINEL . $usuario['img'];
} else {
    $img = INCLUDE_PATH . 'static/uploads/avatar.jpg';
}

?>

<div class="card">
    <img src="<?php echo $img ?>" class="card-img-top" alt="User Image">
    <div class="card-body">
        <h5 class="card-title"><?php echo $nome ?></h5>
        <p class="card-text"><?php echo $email ?></p>
        <p class="card-text"><?php echo $formacao ?></p>
        <p class="card-text"><?php echo $bio ?></p>
        <?php
        if ($_SESSION) {
            if ($_SESSION['user'] == $_GET['usuario']) {
        ?>
                <a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=<?php echo $_SESSION['id'] ?>" class="btn btn-primary">Editar Perfil</a>
        <?php
            }
        }
        ?>
    </div><!--card-body-->
</div><!--card-->