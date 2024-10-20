<?php



define('INCLUDE_PATH','http://localhost/Projeto_01/');

define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');

define('BASE_DIR_PAINEL',__DIR__.'/painel');


//Conectar com banco de dados!
define('HOST','localhost');
define('USER','root');
define('PASSWORD','');
define('DATABASE','blog');

//Constantes para o painel de controle
define('NOME_EMPRESA','Aldomar Assolin');

define('URL','http://localhost:80/noticias/');
define('URL_STATIC','http://localhost:80/noticias/static/');

// define('BASE_PAINEL', 'http://localhost:80/noticias/painel/');
// define('BASE_DIR_PAINEL',__DIR__.'/painel');
define('PAINEL_COMPONENTS', 'http://localhost:80/noticias/painel/components/');
define('PAINEL_PAGES', 'http://localhost:80/noticias/painel/pages/');

$css = URL_STATIC.'css/';


?>