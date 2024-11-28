<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');

//Constantes para o site
define('INCLUDE_PATH', 'http://localhost/noticias/');
define('URL_STATIC', 'http://localhost:80/noticias/static/');

//Constantes para o painel de controle
define('INCLUDE_PATH_PAINEL', INCLUDE_PATH . 'painel/');
define('BASE_DIR_PAINEL', __DIR__ . '/painel/');
define('BASE_DIR', __DIR__ . '/');

$autoload = function ($class) {
    $modelPath = BASE_DIR . 'model/' . $class . '.php';
    $painelPath = BASE_DIR_PAINEL . 'model/' . $class . '.php';
    
    if (file_exists($modelPath)) {
        include($modelPath);
    } elseif (file_exists($painelPath)) {
        include($painelPath);
    } else {
        error_log("Classe não encontrada: " . $class);
    }
};

spl_autoload_register($autoload);

//Busca variaveis de ambiente
$host = Env::getEnv('DB_HOST_MYSQL');
$user = Env::getEnv('DB_USER_MYSQL');
$pass = Env::getEnv('DB_PASS_MYSQL');
$db = Env::getEnv('DB_NAME_MYSQL');


//Conectar com banco de dados!
define('HOST', $host);
define('USER', $user);
define('PASSWORD', $pass);
define('DATABASE', $db);

define('NOME_EMPRESA', 'BLOG News');

$css = URL_STATIC . 'css/';

$avatar = INCLUDE_PATH . 'static/uploads/avatar.jpg';
$capa = INCLUDE_PATH . 'static/uploads/capa.jpeg';

//Funcoes do painel
function pegaCargo($indice)
{
    return Painel::$cargos[$indice];
}

function listarCategorias($indice)
{
    return Painel::$categorias[$indice];
}

function listarTipos($indice)
{
    return Painel::$tipos[$indice];
}

function permissaoPagina($permissao)
{
    if ($_SESSION['cargo'] >= $permissao) {
        echo $_SESSION['cargo'];
        return;
    } else {
        echo 'style="display:none;"';
    }
}


function exibirUsuariosOnline(){
    $usuarios = Painel::listarUsuariosOnline();
    
    return $usuarios;
}
