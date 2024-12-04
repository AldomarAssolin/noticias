<?php

// Inicializar variáveis
$message = '';
$errors = [];
$email = '';

// Gerar token CSRF
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar token CSRF
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Erro de validação do token CSRF');
    }

    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $senha = trim(filter_input(INPUT_POST, htmlspecialchars('senha', ENT_QUOTES, 'UTF-8')));
    $confirme_senha = trim(filter_input(INPUT_POST, htmlspecialchars('confirme_senha', ENT_QUOTES, 'UTF-8')));

    $usuario = new Usuario();
    $usuario_existente = $usuario->buscarUsuario($email);

    if (empty($email)) {
        $errors['email'] = 'Preencha o campo email!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email inválido!';
    } elseif ($usuario_existente) {
        $errors['email'] = 'Usuário já cadastrado!';
    }

    if (empty($senha)) {
        $errors['senha'] = 'Preencha o campo senha!';
    } elseif (strlen($senha) < 8) {
        $errors['senha'] = 'A senha deve ter no mínimo 8 caracteres!';
    } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $senha)) {
        $errors['senha'] = 'A senha deve ter pelo menos 8 caracteres, incluindo uma letra, um número e um caractere especial!';
    }

    if ($senha !== $confirme_senha) {
        $errors['confirme_senha'] = 'As senhas não conferem!';
    }

    if (empty($errors)) {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $usuario_id = $usuario->create($email, $senha_hash);

        $usuario = $usuario->buscarUsuario($email);
        $usuario_id = $usuario['id'];

        $perfil = new Perfil();
        $perfil->createPerfil($usuario_id);
        $message = Painel::alert('sucesso', 'Usuário cadastrado com sucesso!');
        $_SESSION['mensagem'] = $message;
        Painel::redirect(INCLUDE_PATH_PAINEL . 'login');
        exit;

    } else {
        foreach ($errors as $error) {
            $message .= Painel::alert('erro', $error);
        }
    }
}
