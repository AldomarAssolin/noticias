<?php

// Receber a URL do .htaccess. Se não existir o nome da página, carregar a página inicial (home).
//
//$url = (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)) ? filter_input(INPUT_GET, 'url', FILTER_DEFAULT) : 'home');

$url = $_GET['url'];

if($url == 'painel/') {
  $url = 'painel/home';
}


// Converter a URL de uma string para um array.
$url = array_filter(explode('/', $url));

$pages = $url[0] . '/pages/' . $url[1] . '.php';
//var_dump($pages);



?>


<!doctype html>
<html lang="pt-br" data-bs-theme="auto">

<head>
  <script src="<?php echo INCLUDE_PATH ?>assets/js/color-modes.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.115.4">
  <title><?php echo NOME_EMPRESA ?></title>

  <link rel="canonical" href="">

  <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">




  <link href="<?php echo INCLUDE_PATH ?>assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">

  <link href="<?php echo URL_STATIC ?>css/dashboard.css" rel="stylesheet">
</head>

<body>
  <div class="container-fluid p-0 m-auto">
    <div>
      <?php

      ?>
    </div>
    <div class="d-flex p-0">
      <?php

      include('./painel/components/sidebar.php');

      ?>
      <main class="main w-100">
        <?php
        include('./painel/commons/header.php');
        ?>
        <section class="section-main overflow-y-auto p-3">
          <?php






          switch (is_file($pages)) {
            case 'home':
              include $pages;
              break;
            case 'cadastrarUsuario':
              include $pages;
              break;
            case 'cadastrarArtigo':
              include $pages;
              break;
            case 'userList':
              include $pages;
              break;
            case 'articleListAutor':
              include $pages;
              break;
            default:
              include './pages/404.php';
              break;
          }

          //include('./painel/pages/home.php');
          //include('./painel/pages/cadastrarUsuario.php');
          //include('./painel/pages/cadastrarArtigo.php');
          //include('./painel/pages/userList.php');
          //include('./painel/pages/articleListAutor.php');
          ?>
        </section>
        <div class="p-0">
          <?php
          include('./painel/commons/footer.php');
          ?>
        </div>
      </main>
    </div>

  </div>


  <script src="<?php echo INCLUDE_PATH ?>assets/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js" integrity="sha384-gdQErvCNWvHQZj6XZM0dNsAoY4v+j5P1XDpNkcM3HJG1Yx04ecqIHk7+4VBOCHOG" crossorigin="anonymous"></script>
  <script src="<?php echo URL_STATIC ?>js/dashboard.js"></script>
</body>

</html>