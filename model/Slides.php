

<?php


class Slides{

    public function cadastrarSlide($titulo,$descricao,$link,$imagem){
        $imagem = Painel::uploadFile($imagem);
        $sql = MySql::connect()->prepare("INSERT INTO `tb_site.slides` VALUES (null,?,?,?,?)");
        if($sql->execute(array($titulo,$descricao,$link,$imagem))){
            Painel::alert('sucesso','Slide cadastrado no DB com sucesso!');
        }else{
            Painel::alert('erro','Ocorreu um erro ao conectar para cadastrar o slide!');
        }
    }

    public static function listarSlides(){
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_site.slides`");
        $sql->execute();
        return $sql->fetchAll();
    }

    public static function deleteSlide($id){
        $sql = MySql::connect()->prepare("DELETE FROM `tb_site.slides` WHERE id = ?");
        if($sql->execute(array($id))){
            echo Painel::alert('sucesso','Slide excluído com sucesso!');
            return true;
        }else{
            echo Painel::alert('erro','Erro ao excluir o slide. Tente novamente.');
            return false;
        }
    }

    public static function updateSlide($titulo,$descricao,$link,$imagem,$id){
        if($imagem['name'] != ''){
            $imagem = Painel::uploadFile($imagem);
            $sql = MySql::connect()->prepare("UPDATE `tb_site.slides` SET titulo = ?, descricao = ?, link = ?, imagem = ? WHERE id = ?");
            $sql->execute(array($titulo,$descricao,$link,$imagem,$id));
        }else{
            $sql = MySql::connect()->prepare("UPDATE `tb_site.slides` SET titulo = ?, descricao = ?, link = ? WHERE id = ?");
            $sql->execute(array($titulo,$descricao,$link,$id));
        }
    }

    public static function getSlide($id){
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_site.slides` WHERE id = ?");
        $sql->execute(array($id));
        return $sql->fetch();
    }
}




?>