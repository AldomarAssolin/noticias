<?php

class Comentarios
{
    // Cria um novo comentário
    public static function create($comentario, $status, $data_criacao, $usuario_id, $artigo_id)
    {
        try {
            $sql = MySql::prepare("INSERT INTO `tb_site.comentarios` (comentario, status, data_criacao, usuario_id, artigo_id) VALUES (?, ?, ?, ?, ?)");
            $sql->execute([$comentario, $status, $data_criacao, $usuario_id, $artigo_id]);
            return MySql::connect()->lastInsertId();
        } catch (Exception $e) {
            error_log("Erro ao criar comentário: " . $e->getMessage());
            return false;
        }
    }

    // Lista todos os comentários
    public static function getAll($artigo_id)
    {
        try {
            $sql = MySql::prepare("SELECT c.id, CONCAT(p.nome, ' ', p.sobrenome) AS nome, p.avatar, p.usuario_id, c.comentario, c.status, c.data_criacao 
                                   FROM `tb_site.comentarios` AS c
                                   JOIN `tb_admin.perfil` AS p ON c.usuario_id = p.usuario_id
                                   WHERE c.artigo_id = ? AND c.status = 1
                                   ORDER BY c.data_criacao DESC");
            $sql->execute([$artigo_id]);
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao listar comentários: " . $e->getMessage());
            return [];
        }
    }

    //
    public static function update($id, $comentario)
    {
        try {
            $sql = MySql::prepare("UPDATE `tb_site.comentarios` SET comentario = ?, data_atualizacao = NOW() WHERE id = ?");
            return $sql->execute([$comentario, $id]);
        } catch (Exception $e) {
            error_log("Erro ao atualizar comentário: " . $e->getMessage());
            return false;
        }
    }

    // Exclui um comentário pelo ID
    public static function delete($id)
    {
        try {
            $sql = MySql::prepare("DELETE FROM `tb_site.comentarios` WHERE id = ?");
            return $sql->execute([$id]);
        } catch (Exception $e) {
            error_log("Erro ao excluir comentário: " . $e->getMessage());
            return false;
        }
    }

    // Busca um comentário pelo ID
    public static function getById($id)
    {
        try {
            $sql = MySql::prepare("SELECT * FROM `tb_site.comentarios` WHERE artigo_id = ?");
            $sql->execute([$id]);
            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao buscar comentário: " . $e->getMessage());
            return null;
        }
    }

    // Quantidade de comentarios por artigo
    public static function countComentarios($artigo_id)
    {
        $sql = MySql::prepare("SELECT COUNT(*) AS total FROM `tb_site.comentarios` WHERE artigo_id = ?");
        $sql->execute(array($artigo_id));
        return $sql->fetch();
    }
}

?>