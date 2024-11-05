<?php

try{
    if(isset($_POST['acao']) && $_POST['acao'] == 'comentar'){
        $comentario = $_POST['comentar'];
        $data = date('Y-m-d H:i:s');
        $sql = MySql::connect()->prepare("INSERT INTO `tb_site.comentarios` VALUES(null,?,?,?,?)");
        $sql->execute(array($id,$comentario,$data,0));
        Painel::alert('sucesso','Comentário enviado com sucesso!');
        header('Location: '.INCLUDE_PATH.'pages/artigos.php');
    }
    }catch(Exception $e){
        Painel::alert('erro',$e->getMessage());
    }


?>