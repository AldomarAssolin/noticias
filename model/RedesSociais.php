<?php

class RedesSociais{

    private $id;
    private $nome;
    private $link;
    private $cor;
    private $imagem;
    private $usuario_id;

    //Getters e Setters
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getLink(){
        return $this->link;
    }

    public function setLink($link){
        $this->link = $link;
    }

    public function getCor(){
        return $this->cor;
    }

    public function setCor($cor){
        $this->cor = $cor;
    }

    public function getImagem(){
        return $this->imagem;
    }

    public function setImagem($imagem){
        $this->imagem = $imagem;
    }

    public function getUsuarioId(){
        return $this->usuario_id;
    }

    public function setUsuarioId($usuario_id){
        $this->usuario_id = $usuario_id;
    }

    //Métodos

    //Retorna todas as redes sociais do usuário
    public static function getAllRedesSociais($id){
        $sql = MySql::connect("SELECT * FROM redes_sociais WHERE usuario_id = :id");
        $sql = $sql->prepare($sql);
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();

        if($sql->rowCount() > 0){
            return $sql->fetchAll();
        }else{
            return [];
        }
    }

    //Cadastra uma nova rede social
    public function create($nome, $link, $cor, $imagem, $usuario_id){
        $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.redes_sociais` VALUES (null, ?, ?, ?, ?, ?)");
        if($sql->execute(array($this->$nome, $this->$link, $this->$cor, $this->$imagem, $this->$usuario_id))){
            echo Painel::alert('sucesso', 'Rede social cadastrada com sucesso!');
            return true;
        }else{
            echo Painel::alert('erro', 'Erro ao cadastrar rede social!');
            return false;
        }
    }

    //Atualiza uma rede social
    public function update($nome, $link, $imagem, $cor, $usuario_id) {
        $sql = MySql::connect()->prepare("UPDATE `tb_admin.redes_sociais` SET nome = ?, link = ?, imagem = ?, cor = ? WHERE usuario_id = ?");
        if ($sql->execute(array($nome, $link, $imagem, $cor, $usuario_id))) {
            return true;
        } else {
            return false;
        }
    }

    //Deleta uma rede social
    public function delete($id, $usuario_id){
        $sql = MySql::connect()->prepare("DELETE FROM `tb_admin.redes_sociais` WHERE id = ? AND usuario_id = ?");
        if($sql->execute(array($this->$id, $this->$usuario_id))){
            echo Painel::alert('sucesso', 'Rede social deletada com sucesso!');
            return true;
        }else{
            echo Painel::alert('erro', 'Erro ao deletar rede social!');
            return false;
        }
    }

    
}






?>