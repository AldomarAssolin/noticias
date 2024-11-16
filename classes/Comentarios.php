<?php


class Comentarios{

    public static function enviarComentario($comentario, $status, $data_criacao, $usuario_id, $artigo_id){
        try{
            $sql = MySql::connect()->prepare("INSERT INTO `tb_site.comentarios` VALUES (null,?,?,?,?,?)");
            $sql -> execute(array($comentario, $status, $data_criacao, $usuario_id, $artigo_id));
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public static function listarComentarios($artigo_id){
        $sql = MySql::connect()->prepare("SELECT u.nome, u.img, u.email, c.comentario, c.status, c.data_criacao 
        FROM `tb_site.comentarios` AS c
        JOIN `tb_admin.usuarios` AS u
        WHERE artigo_id = ? 
        AND c.usuario_id = u.id
        AND c.status = 1");
        $sql -> execute(array($artigo_id));
        return $sql->fetchAll();
    }
}




?>