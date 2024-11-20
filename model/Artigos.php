

<?php
class Artigos
{
    //retorna artigos com autores


    //buscar artigo individual
    public static function pegarArtigo($id)
    {
        $sql = MySql::prepare("SELECT id, titulo, subtitulo, descricao, categoria, tipo, conteudo, img, usuario_id, data_criacao, data_atualizacao, status
                                 FROM `tb_site.artigos` 
                                 where id = ?");
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
            $sql = MySql::prepare("SELECT * FROM `vw_usuarios_artigos_cards`
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
        $sql = MySql::connect()->prepare("SELECT * FROM `vw_usuarios_artigos_cards` ORDER BY data_criacao DESC");
        $sql->execute();
        return $sql->fetchAll();  // Retorna todos os resultados
    }


    //retorna lista de artigos por autor
    public static function listarArtigosAutor($id)
    {
        try {
            $sql = MySql::prepare("SELECT id, titulo, subtitulo, descricao, data_criacao, img AS capa, status
                                    FROM `tb_site.artigos`
                                    WHERE usuario_id = ?
                                    ORDER BY data_criacao DESC");
            $sql->execute(array($id));

            return $sql->fetchAll();  // Retorna todos os resultados
        } catch (Exception $e) {
            echo Painel::alert('erro', $e->getMessage());
        }
    }

    public static function adicionarArtigo($titulo, $subtitulo, $descricao, $categoria, $tipo, $conteudo, $img, $usuario_id, $data_criacao, $data_atualizacao, $status)
    {
        $data_criacao = date('Y-m-d H:i:s');
        $sql = MySql::connect()->prepare("INSERT INTO `tb_site.artigos` VALUES (null,?,?,?,?,?,?,?,?,?,?,?)");
        $sql->execute(array($titulo, $subtitulo, $descricao, $categoria, $tipo, $conteudo, $img, $usuario_id, $data_criacao, null, 1));
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

    public static function listarArtigosMes()
    {
        $sql = MySql::connect()->prepare("SELECT data_criacao FROM `tb_site.artigos`");
        $sql->execute(array());
        return $sql->fetchAll();
    }

    public static function listarArtigosPorMes($mes){
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_site.artigos` WHERE MONTH(data_criacao) = ?");
        $sql->execute(array($mes));
        return $sql->fetchAll();
    }

    public static function buscarArtigos($buscar)
    {
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_site.artigos` WHERE titulo LIKE ? OR descricao LIKE ?");
        $sql->execute(array('%' . $buscar . '%', '%' . $buscar . '%'));
        return $sql->fetchAll();
    }
}

?>