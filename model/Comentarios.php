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
        $sql = MySql::connect()->prepare("SELECT concat(p.nome, ' ', p.sobrenome) AS nome, p.avatar, p.usuario_id, c.comentario, c.status, c.data_criacao 
        FROM `tb_site.comentarios` AS c
        JOIN `tb_admin.perfil` AS p
        WHERE artigo_id = ? 
        AND c.usuario_id = p.usuario_id
        AND c.status = 1");
        $sql -> execute(array($artigo_id));
        return $sql->fetchAll();
    }
}




?>