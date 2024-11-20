<?php

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $usuario = new Usuario($email, $senha);
    $usuario_email = $usuario->buscarUsuario($email);

    var_dump($usuario_email);

    if (empty($email) || empty($senha)) {
        $message .= Painel::alert('erro', 'Campos vazios não são permitidos!');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message .= Painel::alert('erro', 'Email inválido!');
    }

    if ($usuario_email == $email) {
        $message .= Painel::alert('erro', 'Email já cadastrado!');
    }

    if ($_POST['senha'] != $_POST['confirme_senha']) {
        $message .= Painel::alert('erro', 'Senhas não conferem!');
        
    }

    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/', $senha)) {
        $message .= Painel::alert('erro', 'A senha deve ter pelo menos 6 caracteres, incluindo uma letra, um número e um caractere especial!');
    }
    echo $message;
    var_dump($message);
    
    // Se não houver erros, cria o usuário
    if(empty($message)){
        $usuario->create($email, $senha);
        $usuario_id = $usuario->buscarUsuario($email);
        $usuario_id = $usuario_id['id'];
        $perfil = new Perfil();
        $perfil->createPerfil($usuario_id);
        $message = Painel::alert('sucesso', 'Usuário cadastrado com sucesso!');
        header('Location: ' . INCLUDE_PATH_PAINEL . 'login');
    }else{
        $message = Painel::alert('erro', 'Erro ao cadastrar usuário!');
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
    <title><?php echo NOME_EMPRESA ?> | Registrar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="<?php echo INCLUDE_PATH ?>assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo URL_STATIC ?>css/login.css" rel="stylesheet">
    <link href="<?php echo URL_STATIC ?>css/css.css" rel="stylesheet">
</head>

<body>

    <div class="container login">
        <div class="row justify-content-center">
            <div class="col-md-6 shadow pb-3">
                <div class="form-group text-center">
                    <h2 class="text-center mt-5">Faça seu registro</h2>
                    <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-center" href="<?php echo INCLUDE_PATH ?>" title="Voltar a navegação">
                        <?php echo NOME_EMPRESA ?>
                        <i class="bi bi-box-arrow-in-down-right"></i>
                    </a>
                </div>
                <div class="alert">
                    <?php

                    if (!empty($message)) {
                        echo '<p>' . $message . '</p>';
                    }

                    ?>
                </div><!-- /.painel-alert -->
                <form method="POST">
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
                            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                        </div>
                        <div class="col-10 text-center">
                            <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-center" href="<?php echo INCLUDE_PATH_PAINEL ?>login">
                                Fazer login
                            </a>
                        </div>
                    </div><!--buttons-->
                </form>
            </div>
        </div>
    </div>

    <script>
        setTimeout(function() {
            $('.alert').alert('close');
            $('#btn-alert-close').click(function() {
                $('.alert').alert('close');
            });
        }, 5000);
    </script>
    <script src="<?php echo INCLUDE_PATH ?>assets/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>