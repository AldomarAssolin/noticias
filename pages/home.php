

<?php


try {
  $result = Artigos::listarArtigos();
} catch (Exception $e) {
  echo '<div class="alert alert-danger p-2"><h3>Erro ao listar os artigos!</h3><p></p></div>';
}

$imagem = './static/uploads/imagem-notfound.jpg';

include('./components/card_destaque.php');
?>






  <?php
  include('./components/main.php');
  ?>

