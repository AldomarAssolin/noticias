<?php

class Site
{
    //função para carregar a página
    public static function carregarPagina()
    {
        if (isset($_GET['url'])) {
            $url = explode('/', $_GET['url']);
            if (file_exists('pages/' . $url[0] . '.php')) {
                include('pages/' . $url[0] . '.php');
            } else {
                include('pages/home.php');
            }
        } else {
            include('pages/404.php');
        }
    }

    public static function updateUsusarioOnline($local)
    {
        //verificando se a sessão online existe
        //var_dump($_SESSION);
        if (isset($_SESSION['online'])) {
            $token = $_SESSION['online'];
            $agora = date('Y-m-d H:i:s');
            $usuario_id = $_SESSION['id'];
            $expira = date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime($agora)));
            //verificando se o token já existe
            $check = MySql::connect()->prepare("SELECT `id` FROM `tb_admin.online` WHERE token = ?");
            $check->execute(array($token));

            //verificando se o token já existe
            if ($check->rowCount() == 1) {
                //atualizando a ultima ação do usuário
                $sql = MySql::connect()->prepare("UPDATE `tb_admin.online` SET ultima_acao = ?, local = ?, usuario_id = ? WHERE token = ?");
                $sql->execute(array($agora,$local, $usuario_id, $token));
            } else {
                $token = $_SESSION['online'];
                $ip = $_SERVER['REMOTE_ADDR'];
                $agora = date('Y-m-d H:i:s');
                $usuario_id = $_SESSION['id'];
                $expira = date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime($agora)));
                //caso o token não exista, ele é criado

                $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.online` VALUES (null,?,?,?,?,?)");
                $sql->execute(array($ip, $agora, $local, $usuario_id, $token));
            }
        } else {
            $_SESSION['online'] = uniqid();
            $token = $_SESSION['online'];
            $ip = $_SERVER['REMOTE_ADDR'];
            $agora = date('Y-m-d H:i:s');
            $usuario_id = $_SESSION['id'];
            $expira = date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime($agora)));
            $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.online` VALUES (null,?,?,?,?,?)");
            $sql->execute(array($ip, $agora, $local, $usuario_id, $token));
        }
    }

    public static function contador()
    {
        // Verifica se o cookie 'visita' não está definido
        if (!isset($_COOKIE['visita'])) {
            // Define o cookie 'visita' com duração de 7 dias
            setcookie('visita', uniqid(), time() + (60 * 60 * 24 * 7), '/');
            $date = date('Y-m-d H:i:s');

            // Insere um novo registro na tabela 'tb_admin.visitas' com o IP do usuário e a data/hora atual
            try {
                $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.visitas` VALUES (null, ?, ?)");
                $sql->execute(array($_SERVER['REMOTE_ADDR'], $date));
            } catch (Exception $e) {
                // Trate o erro aqui, como registrar ou exibir uma mensagem
                error_log($e->getMessage());
                echo '<div class="alert alert-danger p-2"><h3>Erro ao conectar!</h3><p>' . $e->getMessage() . '</p></div>';
            }
        }
    }
}
