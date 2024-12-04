<?php



class Perfil extends Usuario
{

    private $id;
    private $nome;
    private $sobrenome;
    private $data_nasc;
    private $bio;
    private $avatar;
    private $capa;
    private $cidade;
    private $uf;
    private $usuario_id;

    //Construtor
    public function __construct($id = null, $nome = null, $sobrenome = null, $data_nasc = null, $bio = null, $avatar = null, $capa = null, $cidade = null, $uf = null, $usuario_id = null)
    {

        $this->id = $id;
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->data_nasc = $data_nasc;
        $this->bio = $bio;
        $this->avatar = $avatar;
        $this->capa = $capa;
        $this->cidade = $cidade;
        $this->uf = $uf;
        $this->usuario_id = $usuario_id;
    }

    //Getters e Setters

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    public function getDataNasc()
    {
        return $this->data_nasc;
    }

    public function getBio()
    {
        return $this->bio;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function getCapa()
    {
        return $this->capa;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function getUf()
    {
        return $this->uf;
    }

    public function getUsuarioId()
    {
        return $this->usuario_id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;
    }

    public function setDataNasc($data_nasc)
    {
        $this->data_nasc = $data_nasc;
    }

    public function setBio($bio)
    {
        $this->bio = $bio;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    public function setCapa($capa)
    {
        $this->capa = $capa;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    public function setUf($uf)
    {
        $this->uf = $uf;
    }

    public function setUsuarioId($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }

    //Metodos

    //PERFIL
    //Inicializa uma view do perfil do usuario
    public function createPerfil($usuario_id)
    {

        
        //Verifica se o usuário existe
        $checkSql = MySql::connect()->prepare("SELECT id , email FROM `tb_admin.usuarios` WHERE id = ?");
        $checkSql->execute(array($usuario_id));
        if ($checkSql->rowCount() == 0) {
            echo Painel::alert('erro', 'Usuário não encontrado!');
            return false;
        }

        //Cria um perfil padrão
        $avatar = INCLUDE_PATH . 'static/images/avatar.png';
        $capa = INCLUDE_PATH . 'static/images/no-image.png';
        $nome = $checkSql->fetch()['email'];

        $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.perfil` (id, nome, avatar, capa, usuario_id) VALUES (null,?,?,?,?)");
        if ($sql->execute(array($nome, $avatar, $capa, $usuario_id))) {
            echo Painel::alert('sucesso', 'Perfil criado com sucesso!');
            return true;
        } else {
            echo Painel::alert('erro', 'Erro ao criar perfil!');
            return false;
        }

    }

    //Atualiza o perfil
    public static function atualizarPerfil($nome, $sobrenome, $data_nasc, $bio, $sobre, $avatar, $capa, $cidade, $uf, $id)
    {
        $sql = MySql::connect()->prepare("UPDATE `tb_admin.perfil` SET nome = ?, sobrenome = ?, data_nasc = ?, bio = ?, sobre = ?, avatar = ?, capa = ?, cidade = ?, uf = ?, usuario_id = ? WHERE usuario_id = ?");
        $sql = $sql->execute(array($nome, $sobrenome, $data_nasc, $bio, $sobre, $avatar, $capa, $cidade, $uf, $id, $id));
        if ($sql) {
            echo Painel::alert('sucesso', 'Perfil atualizado com sucesso!');
            return true;
        } else {
            echo Painel::alert('erro', 'Erro ao atualizar perfil!');
            return false;
        }
    }

    //Cria um perfil
    public function criarPerfil()
    {
        $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.perfil` VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?) WHERE usuario_id = ?");
        if ($sql->execute(array($this->nome, $this->sobrenome, $this->data_nasc, $this->bio, $this->avatar, $this->capa, $this->cidade, $this->uf, $this->usuario_id))) {
            return true;
        } else {
            return false;
        }
    }

    //Exclui um perfil
    public function excluirPerfil()
    {
        $sql = MySql::connect()->prepare("DELETE FROM `tb_admin.perfil` WHERE usuario_id = ?");
        if ($sql->execute(array($this->usuario_id))) {
            return true;
        } else {
            return false;
        }
    }

    public static function getFindById($id)
    {
        $sql = MySql::connect()->prepare("SELECT concat(nome, ' ', sobrenome) AS nome FROM `tb_admin.perfil` WHERE usuario_id = ?");
        $sql->execute(array($id));
        return $sql->fetch()['nome'];
    }

    //Busca todos os perfis
    public static function listarPerfis()
    {
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.perfil`");
        $sql->execute();
        return $sql->fetchAll();
    }

    //Busca um perfil pelo id
    public static function listarPerfilUsuario($id)
    {
        $sql = MySql::connect()->prepare("SELECT u.email, a.* FROM `tb_admin.usuarios` u 
                                        INNER JOIN `tb_admin.perfil` a 
                                        WHERE usuario_id = ? AND u.id = a.usuario_id");
        $sql->execute(array($id));
        return $sql->fetch();
    }

    //Busca um perfil pelo id (nome, avatar, bio,capa)
    public static function listarPerfilNomeAvatar($id)
    {
        $sql = MySql::connect()->prepare("SELECT concat(nome, ' ', sobrenome) AS nome, bio, avatar, capa, usuario_id FROM `tb_admin.perfil` WHERE usuario_id = ?");
        $sql->execute(array($id));
        return $sql->fetch();
    }

    //Busca Perfil do usuario pela id
    public static function viewUsuarioPerfil($id)
    {
        $sql = MySql::connect()->prepare("SELECT * FROM `vw_usuarios_perfil` WHERE id = ?");
        $sql->execute(array($id));
        return $sql->fetch();
    }

    //REDES SOCIAIS
    //Busca todas as redes sociais do usuário
    public static function getAllRedesSociais($id)
    {
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.redes_sociais` WHERE usuario_id = ?");
        $sql->execute(array($id));
        return $sql->fetchAll();
    }

    //Cadastra uma nova rede social
    public function createRedeSocial($nome, $link, $imagem, $cor, $usuario_id)
    {
        $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.redes_sociais` VALUES (null, ?, ?, ?, ?, ?)");
        if ($sql->execute(array($nome, $link, $imagem, $cor, $usuario_id))) {
            echo Painel::alert('sucesso', 'Rede social cadastrada com sucesso!');
            return true;
        } else {
            echo Painel::alert('erro', 'Erro ao cadastrar rede social!');
            return false;
        }
    }

    //Busca uma rede social pelo id
    public static function getRedesById($id)
    {
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.redes_sociais` WHERE id = ?");
        $sql->execute(array($id));
        return $sql->fetch();
    }

    //Atualiza uma rede social
    public function updateRedeSocial($nome, $link, $imagem, $cor, $usuario_id)
    {
        $sql = MySql::connect()->prepare("UPDATE `tb_admin.redes_sociais` SET nome = ?, link = ?, imagem = ?, cor = ? WHERE id = ?");
        if ($sql->execute(array($nome, $link, $imagem, $cor, $usuario_id))) {
            echo Painel::alert('sucesso', 'Rede social atualizada com sucesso!');
            return true;
        } else {
            echo Painel::alert('erro', 'Erro ao atualizar rede social!');
            return false;
        }
    }

    //Exclui uma rede social
    public function deleteRedeSocial($id)
    {
        $sql = MySql::connect()->prepare("DELETE FROM `tb_admin.redes_sociais` WHERE id = ?");
        if ($sql->execute(array($id))) {
            echo Painel::alert('sucesso', 'Rede social excluída com sucesso!');
            return true;
        } else {
            echo Painel::alert('erro', 'Erro ao excluir rede social!');
            return false;
        }
    }

    //FORMACAO
    //Busca uma formacao pelo id do usuario
    public static function getFormacao($id)
    {
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.formacao` WHERE usuario_id = ?");
        $sql->execute(array($id));
        return $sql->fetchAll();
    }

    //Busca uma formacao pelo id
    public static function getFormacaoById($id)
    {
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.formacao` WHERE id = ?");
        $sql->execute(array($id));
        return $sql->fetch();
    }

    //Cadastra uma nova formacao
    public function createFormacao($nome, $instituicao, $nivel, $data_inicio, $conclusao, $logo, $cidade, $uf, $id)
    {
        $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.formacao` VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($sql->execute(array($nome, $instituicao, $nivel, $data_inicio, $conclusao, $logo, $cidade, $uf, $id))) {
            echo Painel::alert('sucesso', 'Formação cadastrada com sucesso!');
            return true;
        } else {
            echo Painel::alert('erro', 'Erro ao cadastrar formação!');
            return false;
        }
    }

    //Atualiza uma formacao
    public function updateFormacao($nome, $instituicao, $nivel, $data_inicio, $conclusao, $logo, $cidade, $uf, $id)
    {
        $sql = MySql::connect()->prepare("UPDATE `tb_admin.formacao` SET nome = ?, instituicao = ?, nivel = ?, data_inicio = ?, conclusao = ?, logo = ?, cidade = ?, uf = ? WHERE id = ?");
        if ($sql->execute(array($nome, $instituicao, $nivel, $data_inicio, $conclusao, $logo, $cidade, $uf, $id))) {
            echo Painel::alert('sucesso', 'Formação atualizada com sucesso!');
            return true;
        } else {
            echo Painel::alert('erro', 'Erro ao atualizar formação!');
            return false;
        }
    }

    //deleta uma formacao
    public function deleteFormacao($id)
    {
        $sql = MySql::connect()->prepare("DELETE FROM `tb_admin.formacao` WHERE id = ?");
        if ($sql->execute(array($id))) {
            return true;
        } else {
            return false;
        }
    }

    //INTERESSES
    //Busca uma intersse pelo id
    public static function getInteresses($id)
    {
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.interesses` WHERE usuario_id = ?");
        $sql->execute(array($id));
        return $sql->fetchAll();
    }

    //Busca um interesse por area
    public static function getInteressePorArea($id, $area)
    {
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.interesses` WHERE usuario_id = ? AND area = ?");
        $sql->execute(array($id, $area));
        return $sql->fetchAll();
    }
}
