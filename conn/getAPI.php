

<?php
// Incluir o arquivo de autoload do composer
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Carregar o arquivo .env
$dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../');
$dotenv->load();

// Obter a variável de ambiente
$NEWS_API = getenv('NEWS_API');
//$url = 'https://api.thenewsapi.com/v1/news/top?locale=br&language=pt&api_token='.$NEWS_API;


// Inicia a sessão cURL
$ch = curl_init($url);

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

?>