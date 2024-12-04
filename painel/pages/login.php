<?php

$mensagem = '';

// Gerar token CSRF se não existir
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar token CSRF
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $mensagem .= Painel::alert('erro', 'Erro de validação do formulário.');
    } else {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $senha = filter_input(INPUT_POST, htmlspecialchars('senha', ENT_QUOTES, 'UTF-8'));

        if (empty($email) || empty($senha)) {
            $mensagem .= Painel::alert('erro', 'Preencha todos os campos!');
        } else {
            $auth = new Auth();
            try{
                if ($auth->login($email, $senha)) {
                    $mensagem .= Painel::alert('sucesso', 'Login efetuado com sucesso!');
                    Painel::redirect(INCLUDE_PATH);
                    exit;
                } 
            }catch(Exception $e){
                $mensagem .= Painel::alert('erro', 'Erro ao efetuar login!' . $e->getMessage());
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
    <title>Login</title>
    <link href="<?php echo INCLUDE_PATH ?>assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo URL_STATIC ?>css/login.css" rel="stylesheet">
    <link href="<?php echo URL_STATIC ?>css/css.css" rel="stylesheet">
</head>

<body>
    <div class="container m-auto" style="min-height: 100vh;">
        <div class="row w-100">
            <div class="col-md-6 offset-md-3 rounded-2 shadow px-2 py-4 mt-5">
                <?php echo $mensagem; ?>
                <div class="form-group text-center">
                    <h1 class="text-center">Login</h1>
                    <h3 class="text-center text-secondary">Seja bem vindo ao nosso site!</h3>
                    <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-center" href="<?php echo INCLUDE_PATH ?>" title="Voltar a navegação">
                        <?php echo htmlspecialchars(NOME_EMPRESA) ?>
                        <i class="bi bi-box-arrow-in-down-right"></i>
                    </a>
                </div>
                <hr>
                <form method="post" id="loginForm">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <div class="mb-3">
                        <label for="email" class="form-label">Login</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <input type="submit" class="btn btn-primary" value="Entrar">
                        </div>
                        <div class="col-10 text-end">
                            <a class="btn btn-outline-secondary text-center" href="<?php echo INCLUDE_PATH_PAINEL ?>register">
                                Registre-se
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?php echo INCLUDE_PATH ?>assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo INCLUDE_PATH ?>static/js/functions.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);

            $('#loginForm').on('submit', function(e) {
                var email = $('#email').val();
                var senha = $('#senha').val();

                if (email === '' || senha === '') {
                    e.preventDefault();
                    alert('Por favor, preencha todos os campos.');
                }
            });
        });
    </script>
</body>

</html>