

<?php
try {
  $result = Artigos::listarArtigosComAutores();
} catch (Exception $e) {
  echo '<div class="alert alert-danger alert-dismissible fade show">' . $mensagem .  '<button type="button" class="close bg-transparente" data-dismiss="alert">&times;</button></div>';
}

$imagem = './static/uploads/imagem-notfound.jpg';

include('./components/card_destaque.php');

include('./components/main.php');
?>


