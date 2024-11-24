

<?php

if (isset($_SESSION['login'])) {
    Site::contador();
    Site::updateUsusarioOnline('site');
}

$imagem = './static/uploads/imagem-notfound.jpg';

include('./components/card_destaque.php');

include('./components/main.php');
?>


