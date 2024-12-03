

<?php




header('Content-Type: application/json');

/***************************************************
 * Origens com permissão para fazer upload de imagens *
 ***************************************************/
$accepted_origins = array("http://localhost", "http://localhost:3306");

/*********************************************
 * Pasta de upload *
 *********************************************/
$imageFolder = "uploads/";

// Verifique se a pasta de upload existe, caso contrário, crie-a
if (!file_exists($imageFolder)) {
    mkdir($imageFolder, 0777, true);
}

if (isset($_SERVER['HTTP_ORIGIN'])) {
    if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type");
    } else {
        header("HTTP/1.1 403 Origin Denied");
        echo json_encode(array('error' => 'Origin Denied'));
        return;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    return;
}

reset($_FILES);
$temp = current($_FILES);

// Verificar se o upload do arquivo ocorreu corretamente
if (!$temp || !is_uploaded_file($temp['tmp_name'])) {
    header("HTTP/1.1 400 Bad Request");
    echo json_encode(array('error' => 'No file was uploaded.'));
    return;
}

if (is_uploaded_file($temp['tmp_name'])) {
    if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
        header("HTTP/1.1 400 Invalid file name.");
        echo json_encode(array('error' => 'Invalid file name.'));
        return;
    }

    // Verifique se o arquivo é uma imagem
    $valid_extensions = array("jpeg", "jpg", "png", "gif");
    $file_extension = strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION));
    if (!in_array($file_extension, $valid_extensions)) {
        header("HTTP/1.1 400 Invalid file type.");
        echo json_encode(array('error' => 'Invalid file type.'));
        return;
    }

    // Mova o arquivo para a pasta de upload
    $fileToWrite = $imageFolder . basename($temp['name']);
    if (move_uploaded_file($temp['tmp_name'], $fileToWrite)) {
        echo json_encode(array('location' => $fileToWrite));
    } else {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(array('error' => 'Failed to move uploaded file.'));
    }
}

?>