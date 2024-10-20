<?php


include('../config/config.php');


?>


<!doctype html>
<html lang="pt-br" data-bs-theme="auto">

<head>
  <script src="<?php echo URL ?>assets/js/color-modes.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.115.4">
  <title><?php echo NOME_EMPRESA?></title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">



  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

  <link href="<?php echo URL ?>assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="<?php echo $css ?>dashboard.css" rel="stylesheet">
</head>

<body>
  <div class="container-fluid p-0 m-auto">

    <?php
    include('../components/themes.php');
    include('../components/svg.php');
    ?>




    <div>
      <?php

      ?>
    </div>
    <div class="d-flex p-0">
      <?php
      include('./components/sidebar.php');

      ?>
      <main class="main w-100">

        <?php
        include('./commons/header.php');
        ?>
        <section class="section-main overflow-y-auto p-3">
          <?php
          include('./pages/home.php');
          //include('./pages/cadastrarUsuario.php');
          //include('./pages/cadastrarArtigo.php');
          //include('./pages/userList.php');
          include('./pages/articleListAutor.php');
          ?>
        </section>
        <div class="p-0">
          <?php
          include('./commons/footer.php');
          ?>
        </div>
      </main>
    </div>

  </div>

  <script src="<?php echo URL ?>assets/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js" integrity="sha384-gdQErvCNWvHQZj6XZM0dNsAoY4v+j5P1XDpNkcM3HJG1Yx04ecqIHk7+4VBOCHOG" crossorigin="anonymous"></script>
  <script src="<?php echo URL_STATIC ?>js/dashboard.js"></script>
</body>

</html>