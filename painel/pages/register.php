<?php

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];
    $confirme_senha = $_POST['confirme_senha'];


    $usuario = new Usuario();
    $usuario_existente = $usuario->buscarUsuario($email);

    if (empty($email)) {
        $message = Painel::alert('erro', 'Preencha o campo email!');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = Painel::alert('erro', 'Email inválido!');
    } elseif (empty($senha)) {
        $message = Painel::alert('erro', 'Preencha o campo senha!');
    } elseif ($usuario_existente) {
        $message = Painel::alert('erro', 'Usuário já cadastrado!');
    } elseif ($senha !== $confirme_senha) {
        $message = Painel::alert('erro', 'As senhas não conferem!');
    } elseif (strlen($senha) < 8) {
        $message = Painel::alert('erro', 'A senha deve ter no mínimo 8 caracteres!');
    } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $senha)) {
        $message = Painel::alert('erro', 'A senha deve ter pelo menos 8 caracteres, incluindo uma letra, um número e um caractere especial!');
    } else {
        if (empty($message)) {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $usuario_id = $usuario->create($email, $senha_hash);

            if ($usuario_id) {
                $perfil = new Perfil();
                $perfil->createPerfil($usuario_id);
                $message = Painel::alert('sucesso', 'Usuário cadastrado com sucesso!');
                $_SESSION['mensagem'] = $message;
                //header('Location: login.php');
            } else {
                $message = Painel::alert('erro', 'Erro ao cadastrar usuário!');
            }
        }
    }
}
?>

<!doctype html>
<html lang="pt-br" data-bs-theme="auto">

<head>
    <script src="<?php echo INCLUDE_PATH ?>assets/js/color-modes.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars(NOME_EMPRESA) ?> | Registrar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH ?>assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo URL_STATIC ?>css/login.css" rel="stylesheet">
    <link href="<?php echo URL_STATIC ?>css/css.css" rel="stylesheet">
</head>

<body>
    <?php
    if (!empty($message)) {
        echo $_SESSION['mensagem'];
    }
    ?>
    <div class="container login">
        <div class="row justify-content-center">
            <div class="col-md-6 shadow pb-3">
                <div class="form-group text-center">
                    <h2 class="text-center mt-5">Faça seu registro</h2>
                    <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-center" href="<?php echo INCLUDE_PATH ?>" title="Voltar a navegação">
                        <?php echo htmlspecialchars(NOME_EMPRESA) ?>
                        <i class="bi bi-box-arrow-in-down-right"></i>
                    </a>
                </div>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="form-group p-2 mb-2">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group p-2 mb-2">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>
                    <div class="form-group p-2 mb-2">
                        <label for="confirme_senha">Confirme sua senha</label>
                        <input type="password" class="form-control" id="confirme_senha" name="confirme_senha" required>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <input type="submit" name="registrar" class="btn btn-primary btn-block">
                        </div>
                        <div class="col-10 text-end">
                            <a class="btn btn-outline-primary" href="<?php echo INCLUDE_PATH_PAINEL ?>">
                                Logar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?php echo INCLUDE_PATH ?>assets/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        setTimeout(function() {
            document.getElementById('alert').style.display = 'none';
        }, 5000);
    </script>
</body>

</html>