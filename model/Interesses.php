<?php
class Interesses
{
    public static function getAll()
    {
        try {
            $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.interesses` ORDER BY nome ASC");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao listar interesses: " . $e->getMessage());
            return [];
        }
    }

    public static function getById($id)
    {
        try {
            $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.interesses` WHERE id = ?");
            $sql->execute([$id]);
            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao buscar interesse: " . $e->getMessage());
            return null;
        }
    }

    public static function create($nome, $descricao, $imagem, $area, $usuario_id)
    {
        try {
            $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.interesses` (nome,descricao,imagem,area,usuario_id) VALUES (?, ?, ?, ?, ?)");
            $sql->execute([$nome, $descricao, $imagem, $area, $usuario_id]);
            return MySql::connect()->lastInsertId();
        } catch (Exception $e) {
            error_log("Erro ao criar interesse: " . $e->getMessage());
            return false;
        }
    }

    public static function update($id, $nome)
    {
        try {
            $sql = MySql::connect()->prepare("UPDATE `tb_admin.interesses` SET nome = ? WHERE id = ?");
            return $sql->execute([$nome, $id]);
        } catch (Exception $e) {
            error_log("Erro ao atualizar interesse: " . $e->getMessage());
            return false;
        }
    }

    public static function delete($id)
    {
        try {
            $sql = MySql::connect()->prepare("DELETE FROM `tb_site.interesses` WHERE id = ?");
            return $sql->execute([$id]);
        } catch (Exception $e) {
            error_log("Erro ao excluir interesse: " . $e->getMessage());
            return false;
        }
    }
}
?>