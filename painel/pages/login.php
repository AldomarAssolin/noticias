
<!doctype html>
<html lang="pt-br" data-bs-theme="auto">

<head>
    <script src="<?php echo INCLUDE_PATH ?>assets/js/color-modes.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="<?php echo INCLUDE_PATH ?>assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo URL_STATIC ?>css/login.css" rel="stylesheet">
</head>

<body>
    <?php


    ?>
    <div class="container login">
        <?php
        
        if (isset($_POST['acao'])) {
            $user = $_POST['user'];
            $password = $_POST['password'];
            $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND senha = ?");
            $sql->execute(array($user, $password));
            if($sql->rowCount() == 1) {
                $info = $sql->fetch();
                $_SESSION['login'] = true;
                $_SESSION['user'] = $user;
                $_SESSION['password'] = $password;
                $_SESSION['cargo'] = $info['cargo'];
                $_SESSION['nome'] = $info['nome'];
                $_SESSION['img'] = $info['img'];
                header('Location: ' .INCLUDE_PATH_PAINEL);
                echo '<div class="alert alert-success">Logado com sucesso!</div>';
                die();
            } else {
                echo '<div class="alert alert-danger">Usuário ou senha incorretos!</div>';
            }
        }
        ?>
        <div class="row">
            <div class="col-md-6 offset-md-3 shadow px-2 py-4">
                <h1 class="text-center">Login</h1>
                <h3 class="text-center text-secondary">Seja bem vindo ao nosso site!</h3>
                <hr>
                <form method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Login</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>
                    <!-- <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check
                            -label" for="exampleCheck1">Check me out</label>
                    </div> -->
                    <input type="submit" class="btn btn-primary" name="acao" value="Logar!">
                </form>
            </div>
        </div>
    </div>

    <script src="<?php echo INCLUDE_PATH ?>assets/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>