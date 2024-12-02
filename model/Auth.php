<?php

class Auth
{

    private $usuario;

    public function __construct()
    {
        $this->usuario = new Usuario();
    }


    //login
    public function login($email, $senha)
    {
        //buscar usuario pelo email
        $UserData = $this->usuario->buscarUsuario($email);

        //verificar se o usuario existe
        if ($UserData['status'] != 0 && $UserData['email'] == $email && password_verify($senha, $UserData['senha'])) {
            $_SESSION['login'] = true;
            $_SESSION['id'] = $UserData['id'];
            $_SESSION['user'] = $UserData['email'];
            $_SESSION['nome'] = $UserData['nome'];
            $_SESSION['cargo'] = $UserData['cargo'];
            $_SESSION['img'] = $UserData['img'];
            $_SESSION['status'] = $UserData['status'];

            // Atualizando o status de logado na tabela tb_admin.usuarios
            $sql = MySql::connect()->prepare("UPDATE `tb_admin.usuarios` SET logado = 1 WHERE id = ?");
            $sql->execute(array($_SESSION['id']));
            return true;
        } else {
            echo Painel::alert('erro', 'Erro na session');
        }

        return false;
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
