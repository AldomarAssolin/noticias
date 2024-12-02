<?php

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, htmlspecialchars('password', ENT_QUOTES, 'UTF-8'));

    if (empty($email) || empty($senha)) {
        $mensagem .= Painel::alert('erro', 'Preencha todos os campos!');
    } else {
        $auth = new Auth();
        if ($auth->login($email, $senha)) {
            if (!$_SESSION['login']) {
                $mensagem .= Painel::alert('erro', 'Usuário ou senha incorretos!');
                Auth::logout();
            }else {
                $mensagem .= Painel::alert('sucesso', 'Login efetuado com sucesso!');
                Painel::redirect(INCLUDE_PATH);
            }
        } else {
            $mensagem .= Painel::alert('erro', 'Usuário ou senha incorretos!');
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <link href="<?php echo URL_STATIC ?>css/login.css" rel="stylesheet">
    <link href="<?php echo URL_STATIC ?>css/css.css" rel="stylesheet">
</head>

<body>
<?php echo $mensagem; ?>
    <div class="container m-auto" style="min-height: 100vh;">
        <div class="row w-100">
            <!-- Form -->
            <form method="post">
                <input type="hidden" name="csrf_token" value="<?php echo isset($_SESSION['csrf_token']); ?>">
                <div class="container m-auto d-flex align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="row w-100">
                        <div class="col-md-6 offset-md-3 rounded-2 shadow px-2 py-4">
                            <div class="form-group text-center">
                                <h1 class="text-center">Login</h1>
                                <h3 class="text-center text-secondary">Seja bem vindo ao nosso site!</h3>
                                <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-center" href="<?php echo INCLUDE_PATH ?>" title="Voltar a navegação">
                                    <?php echo NOME_EMPRESA ?>
                                    <i class="bi bi-box-arrow-in-down-right"></i>
                                </a>
                            </div>
                            <hr>
                            <form method="post">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Login</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Senha</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <input type="submit" class="btn btn-primary" name="acao" value="Entrar">
                                    </div>
                                    <div class="col-10 text-end">
                                        <a class="btn btn-outline-secondary text-center" href="<?php echo INCLUDE_PATH_PAINEL ?>register">
                                            Registre-se
                                        </a>
                                    </div>
                                </div><!--buttons-->
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?php echo INCLUDE_PATH ?>assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo INCLUDE_PATH ?>static/js/functions.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script>
        setTimeout(function() {
            $('.alert').alert('close');
            $('#btn-alert-close').click(function() {
                $('.alert').alert('close');
            });
        }, 5000);
    </script>
</body>

</html>