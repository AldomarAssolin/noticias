

<?php

require('./config/config.php');

$urlDestaque = NEWS_API."?qtd=1";

// Inicia a sessão cURL
$ch = curl_init($urlDestaque);

// Configura opções cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json',
]);

// Executa a requisição
$response = curl_exec($ch);

// Verifica por erros
if (curl_errno($ch)) {
    echo 'Erro: ' . curl_error($ch);
} else {
    // Decodifica a resposta JSON
    $dataDestaque = json_decode($response, true);
    
}

// Fecha a sessão cURL
curl_close($ch);

//var_dump($dataDestaque);

foreach ($dataDestaque['items'] as $itemDestaque) {
        $datPublicacao = DateTime::createFromFormat('d/m/Y H:i:s', $itemDestaque['data_publicacao']);
        $formattedDate = $datPublicacao->format('F d, Y');

        $imagens = json_decode($itemDestaque['imagens'], true);

        // Acessa a URL da imagem que você precisa
        $imageIntro = htmlspecialchars($imagens['image_intro']);

        echo '<div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">';
        echo '<div class="col-lg-12 px-0">';
        echo '<h1 class="display-4 fst-italic">' . $itemDestaque['titulo'] . '</h1>';
        echo '<p class="lead my-3">'. $itemDestaque['introducao'] . '</p>';
        echo '<p class="lead mb-0"><a href="<?php URL ?>" class="text-body-emphasis fw-bold" target="_blank">Continue reading...</a></p>';
        echo '</div>';
        echo '</div>';
}
?>

