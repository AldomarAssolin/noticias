<?php

class Categorias{


    public static function insert($nome, $slug, $order_id){
        $sql = MySql::connect()->prepare("INSERT INTO `tb_site.categorias` VALUES (null,?,?,?)");
        $sql->execute(array($nome, $slug, $order_id));
    }

    public static function listarCategorias()
    {
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_site.categorias` ORDER BY nome ASC");
        $sql->execute();
        return $sql->fetchAll();
    }

    public static function selectCategoria($id)
    {
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_site.categorias` WHERE id = ?");
        $sql->execute(array($id));
        return $sql->fetch();
    }

    public static function delete($id)
    {
        $sql = MySql::connect()->prepare("DELETE FROM `tb_site.categorias` WHERE id = ?");
        $sql->execute(array($id));
    }

    public static function update($arr)
    {
        $sql = MySql::connect()->prepare("UPDATE `tb_site.categorias` SET nome = ?, slug = ? WHERE id = ?");
        $sql->execute(array($arr['nome'], $arr['slug'], $arr['id']));
    }

}









?>