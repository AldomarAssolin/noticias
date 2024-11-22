<?php

require_once 'Usuario.php';

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

    public function createPerfil($usuario_id)
    {

        // Check if usuario_id exists in tb_admin.usuarios
        $checkSql = MySql::connect()->prepare("SELECT id , email FROM `tb_admin.usuarios` WHERE id = ?");
        $checkSql->execute(array($usuario_id));
        if ($checkSql->rowCount() == 0) {
            echo Painel::alert('erro', 'Usuário não encontrado!');
            return false;
        }

        $avatar = INCLUDE_PATH . 'static/uploads/avatar.jpg';
        $capa = INCLUDE_PATH . 'static/uploads/capa.jpeg';
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

    public static function atualizarPerfil($nome, $sobrenome, $data_nasc, $bio, $avatar, $capa, $cidade, $uf, $id)
    {
        $sql = MySql::connect()->prepare("UPDATE `tb_admin.perfil` SET nome = ?, sobrenome = ?, data_nasc = ?, bio = ?, avatar = ?, capa = ?, cidade = ?, uf = ?, usuario_id = ? WHERE usuario_id = ?");
        $sql = $sql->execute(array($nome, $sobrenome, $data_nasc, $bio, $avatar, $capa, $cidade, $uf, $id, $id));
        if ($sql) {
            echo Painel::alert('sucesso', 'Perfil atualizado com sucesso!');
            return true;
        } else {
            echo Painel::alert('erro', 'Erro ao atualizar perfil!');
            return false;
        }
    }

    public function criarPerfil()
    {
        $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.perfil` VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?) WHERE usuario_id = ?");
        if ($sql->execute(array($this->nome, $this->sobrenome, $this->data_nasc, $this->bio, $this->avatar, $this->capa, $this->cidade, $this->uf, $this->usuario_id))) {
            return true;
        } else {
            return false;
        }
    }

    public function excluirPerfil()
    {
        $sql = MySql::connect()->prepare("DELETE FROM `tb_admin.perfil` WHERE usuario_id = ?");
        if ($sql->execute(array($this->usuario_id))) {
            return true;
        } else {
            return false;
        }
    }

    public static function listarPerfis()
    {
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.perfil`");
        $sql->execute();
        return $sql->fetchAll();
    }

    public static function listarPerfilUsuario($id)
    {
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.perfil` WHERE usuario_id = ?");
        $sql->execute(array($id));
        return $sql->fetch();
    }

    public static function listarPerfilNomeAvatar($id)
    {
        $sql = MySql::connect()->prepare("SELECT concat(nome, ' ', sobrenome) AS nome, bio, avatar, usuario_id FROM `tb_admin.perfil` WHERE usuario_id = ?");
        $sql->execute(array($id));
        return $sql->fetch();
    }

    public static function viewUsuarioPerfil($id)
    {
        $sql = MySql::connect()->prepare("SELECT * FROM `vw_usuarios_perfil` WHERE id = ?");
        $sql->execute(array($id));
        return $sql->fetch();
    }

    public static function getAllRedesSociais($id)
    {
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.redes_sociais` WHERE usuario_id = ?");
        $sql->execute(array($id));
        return $sql->fetchAll();
    }

    public static function getFormacao($id)
    {
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.formacao` WHERE usuario_id = ?");
        $sql->execute(array($id));
        return $sql->fetchAll();
    }

    public static function getInteresses($id)
    {
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.interesses` WHERE usuario_id = ?");
        $sql->execute(array($id));
        return $sql->fetchAll();
    }

    public static function getInteressePorArea($id, $area)
    {
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.interesses` WHERE usuario_id = ? AND area = ?");
        $sql->execute(array($id, $area));
        return $sql->fetchAll();
    }

    //Busca uma rede social pelo id
    public static function getRedesById($id){
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.redes_sociais` WHERE id = ?");
        $sql->execute(array($id));
        return $sql->fetch();
    }

    //Cadastra uma nova rede social
    public function createRedeSocial($nome, $link, $imagem, $cor, $usuario_id){
        $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.redes_sociais` VALUES (null, ?, ?, ?, ?, ?)");
        if($sql->execute(array($nome, $link, $imagem, $cor, $usuario_id))){
            echo Painel::alert('sucesso', 'Rede social cadastrada com sucesso!');
            return true;
        }else{
            echo Painel::alert('erro', 'Erro ao cadastrar rede social!');
            return false;
        }
    }

    //Atualiza uma rede social
    public function updateRedeSocial($nome, $link, $imagem, $cor, $usuario_id){
        $sql = MySql::connect()->prepare("UPDATE `tb_admin.redes_sociais` SET nome = ?, link = ?, imagem = ?, cor = ? WHERE usuario_id = ?");
        if($sql->execute(array($nome, $link, $imagem, $cor, $usuario_id))){
            echo Painel::alert('sucesso', 'Rede social atualizada com sucesso!');
            return true;
        }else{
            echo Painel::alert('erro', 'Erro ao atualizar rede social!');
            return false;
        }
    }
}
