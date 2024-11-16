

<?php
class Artigos
{
    //retorna artigos com autores
    

    //buscar artigo individual
    public static function pegarArtigo($id)
    {
        $sql = MySql::prepare("SELECT u.id, u.nome, u.img AS avatar, u.email, a.id, a.titulo, a.subtitulo, a.descricao, a.categoria, a.tipo, a.conteudo, a.img, a.usuario_id, a.data_criacao, a.data_atualizacao 
                                    FROM `tb_site.artigos` AS a
                                    JOIN `tb_admin.usuarios` u
                                    ON a.usuario_id = u.id
                                    where a.id = ?");
        $sql->execute(array($id));
        return $sql->fetch();
    }

    //retorna todos os artigos
    public static function listarArtigos()
    {
        try {
            $sql = MySql::prepare("SELECT * FROM `tb_site.artigos` ORDER BY data_criacao DESC LIMIT 10");
            $sql->execute();
            return $sql->fetchAll();  // Retorna todos os resultados
        } catch (Exception $e) {
            return false;
        }    
        
        
    }

    //retorna todos os artigos por categoria
    public static function listarArtigosCategoria($categoria)
    {
        try {
            $sql = MySql::prepare("SELECT u.nome AS autor, u.img AS avatar, u.email, a.id, a.img AS capa, a.titulo, a.subtitulo, a.descricao, a.categoria, a.data_criacao 
                                    FROM `tb_site.artigos` a
                                    JOIN `tb_admin.usuarios` u ON a.usuario_id = u.id
                                    WHERE categoria = ? 
                                    ORDER BY data_criacao DESC 
                                    LIMIT 10");
            $sql->execute(array($categoria));
            return $sql->fetchAll();  // Retorna todos os resultados
        } catch (Exception $e) {
            return false;
        }
    }

    //retorna todos os artigos com o nome do autor
    public static function listarArtigosComAutores()
    {
        $sql = MySql::connect()->prepare("SELECT u.id AS usuario_id, u.nome AS autor, u.img AS avatar, u.email AS email, a.id, a.titulo, a.subtitulo, a.descricao, a.categoria, a.data_criacao, a.img AS capa, a.status
                                           FROM `tb_site.artigos` a 
                                           JOIN `tb_admin.usuarios` u ON a.usuario_id = u.id 
                                           WHERE a.usuario_id = u.id
                                           ORDER BY a.data_criacao DESC");
        $sql->execute();
        return $sql->fetchAll();  // Retorna todos os resultados
    }


    //retorna lista de artigos por autor
    public static function listarArtigosAutor($id)
    {
        try {
            $sql = MySql::prepare("SELECT  u.nome AS autor, u.img AS avatar, u.email AS email, a.id, a.titulo, a.subtitulo, a.data_criacao, a.img AS capa, a.status
                                    FROM `tb_site.artigos` a 
                                    JOIN `tb_admin.usuarios` u ON a.usuario_id = u.id 
                                    WHERE a.usuario_id = ?
                                    ORDER BY a.data_criacao DESC");
            $sql->execute(array($id));
            return $sql->fetchAll();  // Retorna todos os resultados
        } catch (Exception $e) {
            return false;
        }
       
    }

    public static function adicionarArtigo($titulo, $subtitulo, $descricao, $categoria, $tipo, $conteudo, $img, $usuario_id, $data_criacao, $data_atualizacao,$status)
    {
        $data_criacao = date('Y-m-d H:i:s');
        $sql = MySql::connect()->prepare("INSERT INTO `tb_site.artigos` VALUES (null,?,?,?,?,?,?,?,?,?,?,?)");
        $sql->execute(array($titulo, $subtitulo, $descricao, $categoria, $tipo, $conteudo, $img, $usuario_id, $data_criacao, null,1));
    }

    public static function deletarArtigo($id, $usuario_id)
    {
        $sql = MySql::connect()->prepare("UPDATE `tb_site.artigos` SET status = 0 WHERE id = ? AND usuario_id = ?");
        $sql->execute(array($id, $usuario_id));
    }

    public static function editarArtigo($titulo, $subtitulo, $descricao, $categoria, $tipo, $conteudo, $img, $usuario_id, $data_atualizacao, $id)
{
    $sql = MySql::connect()->prepare("UPDATE `tb_site.artigos` SET titulo = ?, subtitulo = ?, descricao = ?, categoria = ?, tipo = ?, conteudo = ?, img = ?, usuario_id = ?, data_atualizacao = ? WHERE id = ?");
    $sql->execute(array($titulo, $subtitulo, $descricao, $categoria, $tipo, $conteudo, $img, $usuario_id, $data_atualizacao, $id));
}
}



?>