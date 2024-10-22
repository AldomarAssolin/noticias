<?php

class Site
{
    public static function updateUsusarioOnline()
    {
        //verificando se a sessão online existe
        //var_dump($_SESSION);
        if (isset($_SESSION['online'])) {
            $token = $_SESSION['online'];
            $agora = date('Y-m-d H:i:s');
            $expira = date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime($agora)));
            //verificando se o token já existe
            $check = MySql::connect()->prepare("SELECT `id` FROM `tb_admin.online` WHERE token = ?");
            $check->execute(array($token));

            //verificando se o token já existe
            if ($check->rowCount() == 1) {
                //atualizando a ultima ação do usuário
                $sql = MySql::connect()->prepare("UPDATE `tb_admin.online` SET ultima_acao = ? WHERE token = ?");
                $sql->execute(array($agora, $token));
            } else {
                $token = $_SESSION['online'];
                $ip = $_SERVER['REMOTE_ADDR'];
                $agora = date('Y-m-d H:i:s');
                $expira = date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime($agora)));
                //caso o token não exista, ele é criado
                $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.online` VALUES (null,?,?,?)");
                $sql->execute(array($ip, $agora, $token));
            }
        } else {
            $_SESSION['online'] = uniqid();
            $token = $_SESSION['online'];
            $ip = $_SERVER['REMOTE_ADDR'];
            $agora = date('Y-m-d H:i:s');
            //$expira = date('Y-m-d H:i:s',strtotime('+5 minutes',strtotime($agora)));
            $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.online` VALUES (null,?,?,?)");
            $sql->execute(array($ip, $agora, $token));
        }
    }

    public static function contador()
    {
        // Verifica se o cookie 'visita' não está definido
        if (!isset($_COOKIE['visita'])) {
            // Define o cookie 'visita' com duração de 7 dias
            setcookie('visita', true, time() + (60*60*24*7));
            $date = date('Y-m-d');
            // Insere um novo registro na tabela 'tb_admin.visitas' com o IP do usuário e a data/hora atual
            $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.visitas` VALUES (null, ?, ?)");
            $sql->execute(array($_SERVER['REMOTE_ADDR'], $date));
        }
    }
}
