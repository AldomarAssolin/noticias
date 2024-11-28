<?php
include('./config.php');

if (isset($_SESSION['login'])) {
  Site::contador();
  Site::updateUsusarioOnline('site');
}

if (isset($_GET['logout'])) {
  Auth::logout();
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

  <link href="<?php echo URL_STATIC ?>css/blog.css" rel="stylesheet">
  <link href="<?php echo URL_STATIC ?>css/css.css" rel="stylesheet">
  <link href="<?php echo URL_STATIC ?>css/heroes.css" rel="stylesheet">

</head>

<body>

  <div class="container">
    <?php
    include('./components/themes.php');
    include('./components/svg.php');
    include('./commons/header.php');
    include('./layout/layout.php');
    include('./commons/footer.php');
    ?>

    <script>
      setTimeout(function() {
        $('.alert').alert('close');
        $('#btn-alert-close').click(function() {
          $('.alert').alert('close');
        });
      }, 5000);
    </script>


    <script src="<?php echo INCLUDE_PATH ?>static/js/functions.js"></script>
    <script src="<?php echo INCLUDE_PATH ?>assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js" integrity="sha384-gdQErvCNWvHQZj6XZM0dNsAoY4v+j5P1XDpNkcM3HJG1Yx04ecqIHk7+4VBOCHOG" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>

</html>