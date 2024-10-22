<?php



if (isset($_GET['loggout'])) {
  Painel::loggout();
}


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
      include('./components/themes.php');
      include('./components/svg.php');

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

          Painel::carregarPagina();

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


  <script src="<?php echo INCLUDE_PATH ?>assets/dist/js/bootstrap.bundle.min.js"></script>

  <!-- <script src="<?php echo URL_STATIC ?>js/dashboard.js"></script> -->
</body>

</html>