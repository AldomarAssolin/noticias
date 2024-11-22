<?php

class Usuario
{

	private $id;
	private $nome;
	private $email;
	private $senha;

	public function __construct($id = null, $nome = null, $email = null, $senha = null)
	{
		$this->id = $id;
		$this->nome = $nome;
		$this->email = $email;
		$this->senha = $senha;
	}

	// Criar novo usuário
	public function create($email, $senha)
	{

		try {
			$senha = password_hash($senha, PASSWORD_DEFAULT);
			$sql = MySql::connect()->prepare("INSERT INTO `tb_admin.usuarios` (email, senha) VALUES (:email, :senha)");
			$sql->bindParam(':email', $email);
			$sql->bindParam(':senha', $senha);
			return $sql->execute();
		} catch (PDOException $e) {
			echo Painel::alert('erro', 'Erro ao cadastrar usuário: ' .$e->getMessage());
			return false;
		}
	}

	// Buscar usuário por email
	public static function buscarUsuario($email)
	{
		$sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE email = :email");
		$sql->bindParam(':email', $email);
		$sql->execute();

		return $sql->fetch(PDO::FETCH_ASSOC);
	}

	public static function listarUsuariosCadastrado()
    {
        //self::limparUsuariosOnline();
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE status = 1");
        $sql->execute();
        return $sql->fetchAll();
    }

	public static function listarUsuariosDesativados()
	{
		//self::limparUsuariosOnline();
		$sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE status = 0");
		$sql->execute();
		return $sql->fetchAll();
	}

	/* ************************************************** */

	//atualizar usuario pela $_SESSION. (logado)
	public function atualizarUsuario($nome, $cargo, $imagem)
	{
		$sql = MySql::connect()->prepare("UPDATE `tb_admin.usuarios` SET nome = ?, cargo = ? ,img = ? WHERE user = ?");
		if ($sql->execute(array($nome, $cargo, $imagem, $_SESSION['user']))) {
			return true;
		} else {
			return false;
		}
	}

	//atualizar usuario pela id. (painel)
	public function atualizarUsuarioOutro($user, $nome, $cargo, $imagem, $id)
	{
		$sql = MySql::connect()->prepare("UPDATE `tb_admin.usuarios` SET user = ?,nome = ?,cargo = ?,img = ? WHERE id = ?");
		if ($sql->execute(array($user, $nome, $cargo, $imagem, $id))) {
			return true;
		} else {
			return false;
		}
	}

	//verificar se usuario existe no banco de dados.
	public static function userExists($user)
	{
		$sql = MySql::connect()->prepare("SELECT `id` FROM `tb_admin.usuarios` WHERE user=?");
		$sql->execute(array($user));
		if ($sql->rowCount() == 1)
			return true;
		else
			return false;
	}

	//cadastrar usuario no banco de dados.
	public static function cadastrarUsuario($user, $nome, $senha, $cargo, $img)
	{
		$sql = MySql::connect()->prepare("INSERT INTO `tb_admin.usuarios` VALUES (null,?,?,?,?,?)");
		$sql->execute(array($user, $nome, $senha, $cargo, $img));
	}

	//pernissao de usuario
	public static function permissaoUsuario($user)
	{
		$sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ?");
		$sql->execute(array($user));
		$info = $sql->fetch();
		return $info['cargo'];
	}

	//deletar usuario
	public static function deletarUsuario($id)
	{
		$sql = MySql::connect()->prepare("UPDATE `tb_admin.usuarios` SET status = 0 WHERE id = ?");
		$sql->execute(array($id));
	}

	public static function ativarUsuario($id)
	{
		$sql = MySql::connect()->prepare("UPDATE `tb_admin.usuarios` SET status = 1 WHERE id = ?");
		$sql->execute(array($id));
	}
}