

<?php
class Artigos
{

    //pegar artigo por id
    public static function pegarArtigo($id)
    {
        $sql = MySql::prepare("SELECT * FROM `tb_site.artigos` WHERE id = ?");
        $sql->execute(array($id));
        return $sql->fetch();
    }

    //retorna todos os artigos
    public static function listarArtigos()
    {
        
        $sql = MySql::prepare("SELECT * FROM `tb_site.artigos`");
        $sql->execute(); 
        return $sql->fetchAll();  // Retorna todos os resultados      
        
        
    }

    //retorna todos os artigos com o nomne do autor
    public static function listarArtigosComAutores()
    {
        $sql = MySql::connect()->prepare("SELECT u.nome AS autor, u.img, a.id, a.titulo, a.data_criacao 
                                           FROM `tb_site.artigos` a 
                                           JOIN `tb_admin.usuarios` u ON a.usuario_id = u.id 
                                           ORDER BY a.data_criacao DESC");
        $sql->execute();
        return $sql->fetchAll();  // Retorna todos os resultados
    }


    //retorna lista de artigos por autor
    public static function listarArtigosAutor($id)
    {
        $sql = MySql::connect()->prepare("SELECT u.nome, u.img, a.titulo, a.data_criacao 
                                          FROM `tb_site.artigos` a 
                                          JOIN `tb_admin.usuarios` u ON a.usuario_id = u.id 
                                          WHERE a.usuario_id = ? 
                                          ORDER BY a.data_criacao DESC;");
        $sql->execute(array($id));  // Utiliza o parâmetro $id passado na função
        $result = $sql->fetchAll();    // Retorna todos os artigos encontrados

        return $result;
    }

    public static function adicionarArtigo($titulo, $subtitulo, $descricao, $categoria, $tipo, $conteudo, $img, $usuario_id, $data_criacao)
    {
        $data_criacao = date('Y-m-d H:i:s');
        $sql = MySql::connect()->prepare("INSERT INTO `tb_site.artigos` VALUES (null,?,?,?,?,?,?,?,?,?)");
        $sql->execute(array($titulo, $subtitulo, $descricao, $categoria, $tipo, $conteudo, $img, $usuario_id, $data_criacao));
    }

    public static function deletarArtigo($id)
    {
        $sql = MySql::connect()->prepare("DELETE FROM `tb_site.artigos` WHERE id = ?");
        $sql->execute(array($id));
    }

    public static function editarArtigo($titulo, $subtitulo, $descricao, $categoria, $tipo, $conteudo, $img, $data_atualizacao, $id)
    {
        $data_atualizacao = date('Y-m-d H:i:s');
        $sql = MySql::connect()->prepare("UPDATE `tb_site.artigos` SET titulo = ?, subtitulo = ?, descricao = ?, categoria = ?, tipo = ?, conteudo = ?, img = ?, data_atualizacao = ? WHERE id = ?");
        $sql->execute(array($titulo, $subtitulo, $descricao, $categoria, $tipo, $conteudo, $img, $data_atualizacao, $id));
    }
}



?>