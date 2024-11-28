<?php

class Categorias{


    public static function insert($nome, $slug, $order_id){
        $sql = MySql::connect()->prepare("INSERT INTO `tb_site.categorias` VALUES (null,?,?,?)");
        $sql->execute(array($nome, $slug, $order_id));
    }

    public static function listarCategorias()
    {
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_site.categorias`");
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

    public static function orderItem($tabela, $order, $id)
    {
        if ($order == 'up') {
            $sql = MySql::connect()->prepare("SELECT * FROM `tb_site.categorias` WHERE order_id < (SELECT order_id FROM `tb_site.categorias` WHERE id = ?) ORDER BY order_id DESC LIMIT 1");
        } else {
            $sql = MySql::connect()->prepare("SELECT * FROM `tb_site.categorias` WHERE order_id > (SELECT order_id FROM `tb_site.categorias` WHERE id = ?) ORDER BY order_id ASC LIMIT 1");
        }
        $sql->execute(array($id));
        if ($sql->rowCount() == 0) {
            return;
        }
        $item = $sql->fetch();
        Categorias::updateOrder('tb_site.categorias', $id, $item['id'], $item['order_id']);
    }

    public static function updateOrder($tabela, $id, $order_id)
    {
        $sql = MySql::connect()->prepare("UPDATE `tb_site.categorias` SET order_id = ? WHERE id = ?");
        $sql->execute(array($order_id, $id));
    }

}









?>