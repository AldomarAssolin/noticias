<?php

class Painel
{

    public static $cargos = [
        '0' => 'normal',
        '1' => 'autor',
        '2' => 'administrador'
    ];

    public static $categorias = [
        '0' => 'mundo',
        '1' => 'brasil',
        '2' => 'ti',
        '3' => 'programacao',
        '4' => 'curiosidades'
    ];

    public static $tipos = [
        '0' => 'artigo',
        '1' => 'paper',
        '2' => 'noticia'
    ];

    public static function generateSlug($str)
    {
        $str = mb_strtolower($str);
        $str = preg_replace('/(â|á|ã)/', 'a', $str);
        $str = preg_replace('/(ê|é)/', 'e', $str);
        $str = preg_replace('/(í|Í)/', 'i', $str);
        $str = preg_replace('/(ó|ô|õ)/', 'o', $str);
        $str = preg_replace('/(ú)/', 'u', $str);
        $str = preg_replace('/(_|\/|!|\?|#)/', '', $str);
        $str = preg_replace('/( )/', '-', $str);
        return $str;
    }

    public static function logado()
    {
        if (isset($_SESSION['login'])) {
            // Atualizando o status de logado na tabela tb_admin.usuarios
            $sql = MySql::connect()->prepare("UPDATE `tb_admin.usuarios` SET logado = 1 WHERE id = ?");
            $sql->execute(array($_SESSION['id']));
            return isset($_SESSION['login']) ? true : false;
            //return false;
        } else {
            return false;
        }
    }

    public static function loggout()
    {
        // Atualizando o status de logado na tabela tb_admin.usuarios
        $sql = MySql::connect()->prepare("UPDATE `tb_admin.usuarios` SET logado = 0 WHERE id = ?");
        $sql->execute(array($_SESSION['id']));
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

    public static function redirect($url)
    {
        echo '<script>location.href="' . $url . '"</script>';
        die();
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
            echo'<div id="alert" class="alert alert-success alert-dismissible fade show row"><div class="col-10">' . $mensagem .  '</div><div class="col-2 text-end"><button type="button" id="btn-alert-close" class="btn close" data-dismiss="alert"><i class="bi bi-x-sm"></i></button></div></div>
';
        } else if ($tipo == 'erro') {
            echo'<div id="alert" class="alert alert-success alert-dismissible fade show row"><div class="col-10">' . $mensagem .  '</div><div class="col-2 text-end"><button type="button" id="btn-alert-close" class="btn close" data-dismiss="alert"><i class="bi bi-x-sm"></i></button></div></div>
';
        }
    }

    public static function imagemValida($imagem)
    {
        $tiposValidos = ['image/jpeg', 'image/jpg', 'image/png', 'image/PNG', 'image/JPG', 'image/JPEG'];

        if (in_array($imagem['type'], $tiposValidos)) {
            $tamanho = intval($imagem['size'] / 1024);
            if ($tamanho < 5048) {
                return true;
            } else {
                return false;
            }
        } else {
            echo Painel::alert('erro', 'Formato de imagem inválido!');
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
        if (file_exists('uploads/' . $file)) {
            @unlink('uploads/' . $file);
            return true;
        } else {
            return false;
        }
    }

    public static function permissaoPagina($permissao)
    {
        if ($_SESSION['cargo'] >= $permissao) {
            return true;
        } else {
            return false;
        }
    }

    public static function listarUsuarioOnline()
    {

        if (isset($_SESSION)) {
            $sql = MySql::prepare("SELECT usuario_id FROM `tb_admin.online`");
            $sql->execute();

            $users = $sql->fetchAll();
            return $users;
        } else {
            echo Painel::alert('erro', 'Erro ao verificar usuário online!');
        }
    }
}
