<?php


include('./config/config.php'); //configuração
//include_once './config/database.php';  // Conexão com BD


include('./components/themes.php');
include('./components/svg.php');


// Receber a URL do .htaccess. Se não existir o nome da página, carregar a página inicial (home).
$url = (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)) ? filter_input(INPUT_GET, 'url', FILTER_DEFAULT) : 'blog');


// Converter a URL de uma string para um array.
$url = array_filter(explode('/', $url));


// Criar o caminho da página com o nome que está na primeira posição do array criado acima e atribuir a extensão .php.
$arquivo = 'pages/' . $url[0] . '.php';


switch(is_file($arquivo)) {
  case 'blog':
    include $arquivo;
    break;
  case 'painel':
    include $arquivo;
    break;
}
//include('./pages/blog.php');
//include('./pages/painel.php');

?>