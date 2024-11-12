<?php
	
	class Usuario{

        //atualizar usuario pela $_SESSION. (logado)
		public function atualizarUsuario($nome,$senha,$imagem){
			$sql = MySql::connect()->prepare("UPDATE `tb_admin.usuarios` SET nome = ?, senha = ?,img = ? WHERE user = ?");
			if($sql->execute(array($nome,$senha,$imagem,$_SESSION['user']))){
				return true;
			}else{
				return false;
			}
		}

        //atualizar usuario pela id. (painel)
        public function atualizarUsuarioOutro($user,$nome,$cargo,$imagem, $id){
			$sql = MySql::connect()->prepare("UPDATE `tb_admin.usuarios` SET user = ?,nome = ?,cargo = ?,img = ? WHERE id = ?");
			if($sql->execute(array($user,$nome,$cargo,$imagem,$id))){
				return true;
			}else{
				return false;
			}
		}

        //verificar se usuario existe no banco de dados.
		public static function userExists($user){
			$sql = MySql::connect()->prepare("SELECT `id` FROM `tb_admin.usuarios` WHERE user=?");
			$sql->execute(array($user));
			if($sql->rowCount() == 1)
				return true;
			else
				return false;
		}

        //cadastrar usuario no banco de dados.
		public static function cadastrarUsuario($user,$nome,$senha,$cargo,$img){
			$sql = MySql::connect()->prepare("INSERT INTO `tb_admin.usuarios` VALUES (null,?,?,?,?,?)");
			$sql->execute(array($user,$nome,$senha,$cargo,$img));
		}

		//pernissao de usuario
		public static function permissaoUsuario($user){
			$sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ?");
			$sql->execute(array($user));
			$info = $sql->fetch();
			return $info['cargo'];
		}

		//deletar usuario
		public static function deletarUsuario($id){
			$sql = MySql::connect()->prepare("UPDATE `tb_admin.usuarios` SET status = 0 WHERE id = ?");
			$sql->execute(array($id));
		}

		public static function listarUsuariosDesativados()
    {
        //self::limparUsuariosOnline();
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE status = 0");
        $sql->execute();
        return $sql->fetchAll();
    }

    public static function ativarUsuario($id)
    {
        $sql = MySql::connect()->prepare("UPDATE `tb_admin.usuarios` SET status = 1 WHERE id = ?");
        $sql->execute(array($id));
    }

	}

?>