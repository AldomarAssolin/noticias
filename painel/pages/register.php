

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

<?php
require_once 'processar_registro.php';
?>
<body>
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
                <?php
                if (!empty($message)) {
                    echo $message;
                }
                ?>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="registroForm">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <div class="form-group p-2 mb-2">
                        <label for="email">Email</label>
                        <input type="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                        <?php if (isset($errors['email'])): ?>
                            <div class="invalid-feedback"><?php echo $errors['email']; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group p-2 mb-2">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control <?php echo isset($errors['senha']) ? 'is-invalid' : ''; ?>" id="senha" name="senha" required>
                        <?php if (isset($errors['senha'])): ?>
                            <div class="invalid-feedback"><?php echo $errors['senha']; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group p-2 mb-2">
                        <label for="confirme_senha">Confirme sua senha</label>
                        <input type="password" class="form-control <?php echo isset($errors['confirme_senha']) ? 'is-invalid' : ''; ?>" id="confirme_senha" name="confirme_senha" required>
                        <?php if (isset($errors['confirme_senha'])): ?>
                            <div class="invalid-feedback"><?php echo $errors['confirme_senha']; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <input type="submit" name="registrar" class="btn btn-primary btn-block" value="Registrar">
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
        // Validação do lado do cliente
        document.getElementById('registroForm').addEventListener('submit', function(e) {
            var senha = document.getElementById('senha').value;
            var confirme_senha = document.getElementById('confirme_senha').value;
            
            if (senha !== confirme_senha) {
                e.preventDefault();
                alert('As senhas não conferem!');
            }
            
            if (senha.length < 8) {
                e.preventDefault();
                alert('A senha deve ter no mínimo 8 caracteres!');
            }
            
            if (!/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/.test(senha)) {
                e.preventDefault();
                alert('A senha deve ter pelo menos 8 caracteres, incluindo uma letra, um número e um caractere especial!');
            }
        });

        // Remover alertas após 5 segundos
        setTimeout(function() {
            var alerts = document.getElementsByClassName('alert');
            for (var i = 0; i < alerts.length; i++) {
                alerts[i].style.display = 'none';
            }
        }, 5000);
    </script>
</body>

</html>