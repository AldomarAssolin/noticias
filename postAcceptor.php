

<?php

    header('Content-Type: application/json');
  /***************************************************
   * Origens com permissão para fazer upload de imagens *
   ***************************************************/
  $accepted_origins = array("http://localhost", "http://localhost:3306");
  
  /*********************************************
  * Pasta de upload *
  *********************************************/
  $imageFolder = "static/uploads/";


// Verifique se a pasta de upload existe, caso contrário, crie-a
if (!file_exists($imageFolder)) {
    mkdir($imageFolder, 0777, true);
}

if (isset($_SERVER['HTTP_ORIGIN'])) {
    if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
        header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
    } else {
        header("HTTP/1.1 403 Origin Denied");
        return;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    return;
}

reset($_FILES);
$temp = current($_FILES);
//var_dump($temp);
// Verificar se o upload do arquivo ocorreu corretamente
if (!$temp || !is_uploaded_file($temp['tmp_name'])) {
    header("HTTP/1.1 400 Bad Request");
    echo json_encode(array('error -->' => 'No file was uploaded.'));
    return;
}


if (is_uploaded_file($temp['tmp_name'])) {
    if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
        header("HTTP/1.1 400 Invalid file name.");
        return;
    }

    if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png", "jpeg", "webp"))) {
        header("HTTP/1.1 400 Invalid extension.");
        return;
    }

    $filetowrite = $imageFolder . basename($temp['name']);

    if (move_uploaded_file($temp['tmp_name'], $filetowrite)) {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? "https://" : "http://";
        $baseurl = $protocol . $_SERVER["HTTP_HOST"] . rtrim(dirname($_SERVER['REQUEST_URI'])) . "/";

        echo json_encode(array('location' => $baseurl . $filetowrite));
        return;
    } else {
        echo json_encode(array('error' => 'Failed to move uploaded file.'));
        return;
    }
} else {
    echo json_encode(array('error' => 'No file was uploaded.'));
    return;
}

?>