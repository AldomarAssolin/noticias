

<?php
class Artigos
{

    //buscar artigo individual
    public static function pegarArtigo($id)
    {
        $sql = MySql::prepare("SELECT * FROM `tb_site.artigos` WHERE id = ?");
        $sql->execute(array($id));
        return $sql->fetch();
    }

    // Artigo existe
    public static function artigoExiste($id)
    {
        $sql = MySql::prepare("SELECT * FROM `tb_site.artigos` WHERE id = ?");
        $sql->execute(array($id));
        return $sql->rowCount() > 0;
    }

    public static function findByAutorId($id)
    {
        $sql = MySql::prepare("SELECT * FROM `tb_site.artigos` WHERE usuario_id = ?");
        $sql->execute(array($id));
        if ($sql->rowCount() == 0) {
            return $sql;
        } else {
            return $sql->fetch();
        }
    }

    //retorna todos os artigos
    public static function listarArtigos()
    {
        try {
            $sql = MySql::prepare("SELECT * FROM `tb_site.artigos` ORDER BY data_criacao DESC");
            $sql->execute();
            return $sql->fetchAll();  // Retorna todos os resultados
        } catch (Exception $e) {
            return false;
        }
    }

    //retorna todos os artigos por categoria
    public static function listarArtigosPorCategoria($categoria)
    {
        try {
            $sql = MySql::prepare("SELECT u.id, u.email, a.id AS artigo_id, CONCAT(p.nome, ' ', p.sobrenome) AS nome_completo, p.avatar, 
                                a.titulo, a.descricao, a.img AS capa, a.status, a.categoria, a.data_criacao, c.nome, c.slug
                                FROM `tb_admin.usuarios` u 
                                INNER JOIN `tb_admin.perfil` p ON u.id = p.usuario_id 
                                INNER JOIN `tb_site.artigos` a ON u.id = a.usuario_id
                                INNER JOIN `tb_site.categorias` c ON a.categoria = c.nome 
                                WHERE a.categoria = ? 
                                ORDER BY a.data_criacao DESC");
            $sql->execute(array($categoria));
            return $sql->fetchAll();  // Retorna todos os resultados
        } catch (Exception $e) {
            return false;
        }
    }

    //retorna todos os artigos com o nome do autor
    public static function listarArtigosComAutores()
    {
        $sql = MySql::connect()->prepare("SELECT u.id, u.email, u.cargo, u.logado, u.status, 
        CONCAT(p.nome, ' ', p.sobrenome) AS nome_completo, p.avatar, 
        a.id AS artigo_id, a.titulo, a.descricao, a.categoria, a.status, a.img AS imagem_artigo, a.data_criacao 
        FROM `tb_admin.usuarios` u
        INNER JOIN `tb_admin.perfil` p ON p.usuario_id = u.id
        INNER JOIN `tb_site.artigos` a ON a.usuario_id = u.id
        ORDER BY data_criacao DESC");
        $sql->execute();
        return $sql->fetchAll();  // Retorna todos os resultados
    }


    //retorna lista de artigos por autor
    public static function listarArtigosAutor($id)
    {
        try {
            $sql = MySql::prepare("SELECT u.id, u.email, u.cargo, u.logado, u.status, 
        CONCAT(p.nome, ' ', p.sobrenome) AS nome_completo, p.avatar, 
        a.id AS artigo_id, a.titulo, a.descricao, a.categoria, a.status, a.img AS imagem_artigo, a.data_criacao 
        FROM `tb_admin.usuarios` u
        INNER JOIN `tb_admin.perfil` p ON p.usuario_id = u.id
        INNER JOIN `tb_site.artigos` a ON a.usuario_id = u.id
        WHERE u.id = ? 
        ORDER BY data_criacao DESC");
            $sql->execute(array($id));

            return $sql->fetchAll();  // Retorna todos os resultados
        } catch (Exception $e) {
            echo Painel::alert('erro', $e->getMessage());
        }
    }

    //Cria um artigo
    public static function adicionarArtigo($titulo, $subtitulo, $descricao, $categoria, $conteudo, $img, $usuario_id, $data_criacao, $data_atualização, $status)
    {
        $sql = MySql::connect()->prepare("INSERT INTO `tb_site.artigos` VALUES (null,?,?,?,?,?,?,?,?,?,?)");
        $sql->execute(array($titulo, $subtitulo, $descricao, $categoria, $conteudo, $img, $usuario_id, $data_criacao, null, 1));
    }

    //Desativar artigo
    public static function desativarArtigo($id)
    {
        $sql = MySql::connect()->prepare("UPDATE `tb_site.artigos` SET status = 0 WHERE id = ?");
        $sql->execute(array($id));
    }

    //excluir excluir permanentemente artigo
    public static function excluirPermanentemente($id)
    {
        $sql = MySql::connect()->prepare("DELETE FROM `tb_site.artigos` WHERE id = ?");
        $sql->execute(array($id));
    }

    //Ativar artigo
    public static function ativarArtigo($id)
    {
        $sql = MySql::connect()->prepare("UPDATE `tb_site.artigos` SET status = 1 WHERE id = ?");
        $sql->execute(array($id));
    }

    //Editar artigo
    public static function editarArtigo($dados, $id)
    {
        try {
            $sql = "UPDATE `tb_site.artigos` 
            SET 
                titulo = :titulo,
                subtitulo = :subtitulo,
                descricao = :descricao,
                categoria = :categoria,
                conteudo = :conteudo,
                img = :img,
                usuario_id = :usuario_id,
                data_atualizacao = :data_atualizacao
            WHERE id = :id
        ";

            $conexao = MySql::connect();
            $stmt = $conexao->prepare($sql);

            $stmt->bindParam(':titulo', $dados['titulo'], PDO::PARAM_STR);
            $stmt->bindParam(':subtitulo', $dados['subtitulo'], PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $dados['descricao'], PDO::PARAM_STR);
            $stmt->bindParam(':categoria', $dados['categoria'], PDO::PARAM_STR);
            $stmt->bindParam(':conteudo', $dados['conteudo'], PDO::PARAM_STR);
            $stmt->bindParam(':img', $dados['imagem'], PDO::PARAM_STR);
            $stmt->bindParam(':usuario_id', $dados['usuario_id'], PDO::PARAM_INT);
            $stmt->bindParam(':data_atualizacao', $dados['data_atualizacao'], PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao editar artigo: " . $e->getMessage());
            return false;
        }
    }

    //retorna lista de artigos por mes
    public static function listarArtigosMes()
    {
        $sql = MySql::connect()->prepare("SELECT data_criacao FROM `tb_site.artigos`");
        $sql->execute(array());
        return $sql->fetchAll();
    }

    //retorna lista de artigos por mes
    public static function listarArtigosPorMes($mes)
    {
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_site.artigos` WHERE MONTH(data_criacao) = ?");
        $sql->execute(array($mes));
        return $sql->fetchAll();
    }

    //retorna busca de artigos
    public static function buscarArtigos($buscar)
    {
        $sql = "SELECT a.id AS artigo_id, a.titulo, a.descricao, a.categoria, a.img AS capa, a.status, a.data_criacao, a.usuario_id,
            CONCAT(p.nome, ' ', p.sobrenome) AS nome_completo, p.avatar, c.nome AS categoria_nome
        FROM `tb_site.artigos` a
        LEFT JOIN `tb_admin.perfil` p ON p.usuario_id = a.usuario_id
        LEFT JOIN `tb_site.categorias` c ON c.id = a.categoria
        WHERE a.titulo LIKE :busca OR a.descricao LIKE :busca";

        $conexao = MySql::connect();
        $stmt = $conexao->prepare($sql);
        $termoBusca = '%' . $buscar . '%';
        $stmt->bindParam(':busca', $termoBusca, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //retorna lista de artigos por autor
    public static function listCardArtigos()
    {
        $sql = MySql::connect()->prepare("SELECT a.id as artigo_id, a.titulo, a.descricao, a.categoria, a.img as capa, a.status,
                                        CONCAT(p.nome, ' ', p.sobrenome) as nome_completo, p.avatar, p.usuario_id, a.status,a.data_criacao, a.usuario_id,
                                        c.id as categoria_id, c.nome as categoria
                                        FROM `tb_site.artigos` a
                                        LEFT JOIN `tb_admin.perfil` p ON p.usuario_id = a.usuario_id
                                        LEFT JOIN `tb_site.categorias` c ON c.nome = a.categoria");
        $sql->execute();
        return $sql->fetchAll();
    }

    //retorna contagem de artigos
    public static function contarTotalArtigos() {
        $sql = MySql::connect()->prepare("SELECT COUNT(*) as total FROM `tb_site.artigos` WHERE status = 1");
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'];
    }
    
    //retorna lista de artigos paginados
    public static function listarArtigosComAutoresPaginados($offset, $limit) {
        $sql = MySql::connect()->prepare("
            SELECT a.*, CONCAT(p.nome, ' ', p.sobrenome) AS nome_completo, p.avatar, c.nome as categoria 
            FROM `tb_site.artigos` a 
            LEFT JOIN `tb_admin.perfil` p ON a.usuario_id = p.usuario_id 
            LEFT JOIN `tb_site.categorias` c ON a.categoria = c.nome
            WHERE a.status = 1 
            ORDER BY a.data_criacao DESC 
            LIMIT ?, ?
        ");
        $sql->bindValue(1, $offset, PDO::PARAM_INT);
        $sql->bindValue(2, $limit, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    //retorna lista de artigos por categoria
    public static function contarArtigosCategoria($categoria_slug) {
        $sql = MySql::connect()->prepare("
            SELECT COUNT(*) as total 
            FROM `tb_site.artigos` a 
            JOIN `tb_site.categorias` c ON a.categoria = c.nome 
            WHERE c.nome = ? AND a.status = 1
        ");
        $sql->execute([$categoria_slug]);
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'];
    }

    //retorna lista de artigos por categoria paginados
    public static function listarArtigosPorCategoriaPaginados($categoria_slug, $offset, $limit) {
        $sql = MySql::connect()->prepare("
            SELECT a.*, CONCAT(p.nome, ' ', p.sobrenome) AS nome_completo, p.avatar, c.nome as categoria 
            FROM `tb_site.artigos` a 
            LEFT JOIN `tb_admin.perfil` p ON a.usuario_id = p.usuario_id 
            LEFT JOIN `tb_site.categorias` c ON a.categoria = c.nome
            WHERE c.nome = ? AND a.status = 1 
            ORDER BY a.data_criacao DESC 
            LIMIT ?, ?
        ");
        $sql->bindValue(1, $categoria_slug, PDO::PARAM_STR);
        $sql->bindValue(2, $offset, PDO::PARAM_INT);
        $sql->bindValue(3, $limit, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    //retorna lista de artigos na busca
    public static function listarArtigosBusca($busca) {
        $sql = MySql::connect()->prepare("
            SELECT COUNT(*) as total 
            FROM `tb_site.artigos`
            WHERE (titulo LIKE ? OR descricao LIKE ?) 
            AND status = 1
        ");
        $busca = "%$busca%";
        $sql->execute([$busca, $busca]);
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'];
    }

    //retorna lista de artigos na busca paginados
    public static function buscarArtigosPaginados($busca, $offset, $limit) {
        $sql = MySql::connect()->prepare("
            SELECT a.*, CONCAT(p.nome, ' ', p.sobrenome) AS nome_completo, p.avatar, c.nome as categoria 
            FROM `tb_site.artigos` a 
            LEFT JOIN `tb_admin.perfil` p ON a.usuario_id = p.usuario_id 
            LEFT JOIN `tb_site.categorias` c ON a.categoria = c.nome 
            WHERE (a.titulo LIKE ? OR a.descricao LIKE ?) 
            AND a.status = 1 
            ORDER BY a.data_criacao DESC 
            LIMIT ?, ?
        ");
        $busca = "%$busca%";
        $sql->bindValue(1, $busca, PDO::PARAM_STR);
        $sql->bindValue(2, $busca, PDO::PARAM_STR);
        $sql->bindValue(3, $offset, PDO::PARAM_INT);
        $sql->bindValue(4, $limit, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>