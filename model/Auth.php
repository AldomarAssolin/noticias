<?php

class Auth
{

    private $usuario;

    public function __construct()
    {
        $this->usuario = new Usuario();
    }

    public function login($email, $senha)
{

    // Buscar usuário pelo email
    $userData = $this->usuario->buscarUsuario($email);

    // Verificar se o usuário existe e está ativo
    if ($userData['status'] != 0 && $userData['email'] == $email) {
        // Verificar a senha
        if (password_verify($senha, $userData['senha'])) {

            // Definir variáveis de sessão
            $_SESSION['login'] = true;
            $_SESSION['id'] = $userData['id'];
            $_SESSION['user'] = $userData['email'];
            $_SESSION['logado'] = $userData['logado'];
            $_SESSION['cargo'] = $userData['cargo'];
            $_SESSION['status'] = $userData['status'];

            // Atualizar o status de logado na tabela tb_admin.usuarios
            $this->atualizarStatusLogado($userData['id']);

            error_log("Login bem-sucedido para o usuário: " . $email);
            Painel::alert('sucesso', 'Login bem-sucedido para o usuário: ' . $email);
            return true;
        } else {
            Painel::alert('erro', 'Falha na verificação da senha para o usuário: ' . $email);
            error_log("Falha na verificação da senha para o usuário: " . $email);
        }
    } else {
        Painel::alert('erro', 'Usuário inativo ou email não corresponde');
        error_log("Usuário inativo ou email não corresponde");
    }

    // Se chegou aqui, o login falhou
    Painel::alert('erro', 'Falha no login');
    return false;
}

    private function atualizarStatusLogado($userId)
    {
        try {
            $sql = MySql::connect()->prepare("UPDATE `tb_admin.usuarios` SET logado = 1 WHERE id = ?");
            $sql->execute([$userId]);
        } catch (PDOException $e) {
            // Log do erro
            error_log("Erro ao atualizar status de logado: " . $e->getMessage());
        }
    }

    // verifica se usuário está logado
    public static function isLoggedIn()
    {
        return isset($_SESSION['id']);
    }

    // logout
    public static function logout()
    {
        // Atualizando o status de logado na tabela tb_admin.usuarios
        $sql = MySql::connect()->prepare("UPDATE `tb_admin.usuarios` SET logado = 0 WHERE id = ?");
        $sql->execute(array($_SESSION['id']));
        session_unset();
        session_destroy();
    }
}
