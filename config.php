<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');

$autoload = function ($class) {
    if (file_exists('./classes/' . $class . '.php')) {
        //var_dump($class);
        include('./classes/' . $class . '.php');
    } else {
        //var_dump($class);
        include('../classes/' . $class . '.php');
    }
};

spl_autoload_register($autoload);

//Constantes para o site
define('INCLUDE_PATH', 'http://localhost/noticias/');
define('URL_STATIC', 'http://localhost:80/noticias/static/');

//Constantes para o painel de controle
define('INCLUDE_PATH_PAINEL', INCLUDE_PATH . 'painel/');
define('BASE_DIR_PAINEL', __DIR__ . '/painel');


//Conectar com banco de dados!
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'noticias');


define('NOME_EMPRESA', 'Portal News');

$css = URL_STATIC . 'css/';

//Funcoes do painel
function pegaCargo($indice)
{
    return Painel::$cargos[$indice];
}
