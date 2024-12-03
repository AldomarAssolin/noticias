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
        '4' => 'tutorial',
        '5' => 'tecnologia',
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
        $str = preg_replace('/( )/', '+', $str);
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

    // Função para redirecionar página
    public static function redirect($url)
    {
        echo '<script>location.href="' . $url . '"</script>';
        die();
    }

    // Função para atualizar usuario online
    public static function listarUsuariosOnline()
    {
        self::limparUsuariosOnline();
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.online`");
        $sql->execute();
        return $sql->fetchAll();
    }

    // Função para limpar usuario online
    public static function limparUsuariosOnline()
    {
        $date = date('Y-m-d H:i:s');
        $sql = MySql::connect()->exec("DELETE FROM `tb_admin.online` WHERE ultima_acao < '$date' - INTERVAL 15 MINUTE");
    }

    // Função para verificar usuario online no painel administrativo
    public static function usuariosOnlinePainel()
    {
        $date = date('Y-m-d H:i:s');
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.online` WHERE local = 'painel'");
        $sql->execute();
        return $sql->rowCount();
    }

    // Função para verificar total de visitas
    public static function totalDeVisitas()
    {
        $vistasTotais = MySql::connect()->prepare("SELECT * FROM `tb_admin.visitas`");
        $vistasTotais->execute();
        return $vistasTotais->rowCount();
    }

    // Função para verificar total de visitas do dia
    public static function visitasDoDia()
    {
        $dia = date('Y-m-d');
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.visitas` WHERE dia = ?");
        $sql->execute(array($dia));
        return $sql->rowCount();
    }

    // Função de alerta de erro ou sucesso
    public static function alert($tipo, $mensagem)
    {
        if ($tipo == 'sucesso') {
            echo '<div id="alert" class="alert alert-success alert-dismissible fade show row"><div class="col-10">' . $mensagem .  '</div><div class="col-2 text-end"><button type="button" id="btn-alert-close" class="btn close" data-dismiss="alert"><i class="bi bi-x-sm"></i></button></div></div>';
        } else if ($tipo == 'erro') {
            echo '<div id="alert" class="alert alert-danger alert-dismissible fade show row"><div class="col-10">' . $mensagem .  '</div><div class="col-2 text-end"><button type="button" id="btn-alert-close" class="btn close" data-dismiss="alert"><i class="bi bi-x-sm"></i></button></div></div>';
        }
    }

    // Função para verificar se a imagem é válida
    public static function imagemValida($imagem)
    {
        $tiposValidos = ['image/jpeg', 'image/jpg', 'image/png', 'image/PNG', 'image/JPG', 'image/JPEG'];

        if (in_array($imagem['type'], $tiposValidos)) {
            $tamanho = intval($imagem['size'] / 1024);
            if ($tamanho < 5048) {
                return true;
            } else {
                echo Painel::alert('erro', 'Imagem maior que o tamanho permitido de 5MB!');
                return false;
            }
        } else {
            echo Painel::alert('erro', 'Formato de imagem inválido!');
            return false;
        }
    }

    // Função para fazer upload de imagem
    public static function uploadFile($imagem)
    {
        // Verifica se o diretório de uploads existe
        $uploadDir = BASE_DIR . 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Cria o diretório, se não existir
        }

        // Define o nome do arquivo
        $formatoArquivo = explode('.', $imagem['name']);
        // Gera um nome único para o arquivo
        $imagemNome = uniqid() . '.' . $formatoArquivo[count($formatoArquivo) - 1];

        // Verifica se o arquivo foi movido para o diretório de uploads
        if (move_uploaded_file($imagem['tmp_name'], $uploadDir . $imagemNome)) {
            $uploadImage = INCLUDE_PATH . 'uploads/' . $imagemNome;
            return $uploadImage;
        } else {
            echo Painel::alert('Erro', 'erro ao fazer upload da imagem!');
            return false;
        }
    }

    // Função para atualizar imagem do usuário
    public static function updateImage($email, $img)
    {
        $sql = MySql::connect()->prepare("UPDATE `tb_admin.usuarios` SET img = ? WHERE email = ?");

        if ($sql->execute(array($img, $email))) {
            return true;
        } else {
            echo Painel::alert('Erro', 'erro ao atualizar imagem!');
            return false;
        }
    }

    // Função para deletar arquivo
    public static function deleteFile($file)
    {
        // Define o caminho do arquivo
        $filePath = BASE_DIR . 'uploads/' . $file;
        // Verifica se o arquivo existe
        if (file_exists($filePath)) {
            if (unlink($filePath)) {
                return true;
            } else {
                echo Painel::alert('erro', 'Erro ao excluir arquivo!');
                return false;
            }
        } else {
            echo Painel::alert('erro', 'Erro ao deletar arquivo!');
            return true;
        }
    }

    // Função para verificar permissão de página
    public static function permissaoPagina($permissao)
    {
        if ($_SESSION['cargo'] >= $permissao) {
            Painel::redirect(INCLUDE_PATH_PAINEL);
            return true;
        } else {
            return false;
        }
    }

    // Função para listar usuario online
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
