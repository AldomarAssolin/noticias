<?php

class Painel
{

    public static $cargos = [
        '0' => 'Normal',
        '1' => 'Autor',
        '2' => 'Administrador'
    ];

    public static $categorias = [
        '0' => 'Mundo',
        '1' => 'Brasil',
        '2' => 'TI',
        '3' => 'Programação',
        '4' => 'Curiosidades'
    ];

    public static $tipos = [
        '0' => 'Artigo',
        '1' => 'PAPER',
        '2' => 'Notícia'
    ];

    public static function logado()
    {
        return isset($_SESSION['login']) ? true : false;
        //return false;
    }

    public static function loggout()
    {
        session_destroy();
        header('Location: ' . INCLUDE_PATH);
    }

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

    public static function listarUsuariosOnline()
    {
        self::limparUsuariosOnline();
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.online`");
        $sql->execute();
        return $sql->fetchAll();
    }

    public static function limparUsuariosOnline()
    {
        $date = date('Y-m-d H:i:s');
        $sql = MySql::connect()->exec("DELETE FROM `tb_admin.online` WHERE ultima_acao < '$date' - INTERVAL 1 MINUTE");
    }

    public static function listarUsuariosCadastrado()
    {
        //self::limparUsuariosOnline();
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.usuarios`");
        $sql->execute();
        return $sql->fetchAll();
    }

    public static function totalDeVisitas()
    {
        $vistasTotais = MySql::connect()->prepare("SELECT * FROM `tb_admin.visitas`");
        $vistasTotais->execute();
        return $vistasTotais->rowCount();
    }

    public static function VisitasDoDia()
    {
        $vistasHoje = MySql::connect()->prepare("SELECT * FROM `tb_admin.visitas` WHERE dia = ?");
        $vistasHoje->execute(array(date('Y-m-d')));
        return $vistasHoje->rowCount();
    }

    public static function alert($tipo, $mensagem)
    {
        if ($tipo == 'sucesso') {
            echo '<div class="alert alert-success">' . $mensagem . '</div>';
        } else if ($tipo == 'erro') {
            echo '<div class="alert alert-danger">' . $mensagem . '</div>';
        }
    }

    public static function imagemValida($imagem)
    {
        if (
            $imagem['type'] == 'image/jpeg' ||
            $imagem['type'] == 'image/jpg' ||
            $imagem['type'] == 'image/png' 
        ) {

            $tamanho = intval($imagem['size'] / 1024);
            if ($tamanho < 2700)
                return true;
            else
                return false;
        } else {
            return false;
        }
    }

    public static function uploadFile($imagem)
    {
        $formatoArquivo = explode('.', $imagem['name']);
        $imagemNome = uniqid() . '.' . $formatoArquivo[count($formatoArquivo) - 1];
        if (move_uploaded_file($imagem['tmp_name'], BASE_DIR_PAINEL . '/uploads/' . $imagemNome)) {
            $uploadImage = 'uploads/' . $imagemNome;
            return $uploadImage;
        } else {
            return false;
        }
    }

    public static function deleteFile($file)
    {
        @unlink('uploads/' . $file);
    }
}
