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
			$sql = MySql::connect()->prepare("INSERT INTO `tb_admin.usuarios` (email, senha) VALUES (:email, :senha)");
			$sql->bindParam(':email', $email);
			$sql->bindParam(':senha', $senha);
			return $sql->execute();
		} catch (PDOException $e) {
			echo Painel::alert('erro', 'Erro ao cadastrar usuário: ' . $e->getMessage());
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

	//buscar usuario por id
	public static function buscarUsuarioId($id)
	{
		$sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE id = :id");
		$sql->bindParam(':id', $id);
		$sql->execute();

		return $sql->fetch(PDO::FETCH_ASSOC);
	}

	public static function buscarUsuarioPorId($id)
	{
		$sql = MySql::connect()->prepare("SELECT u.id, u.email, u.cargo, u.logado, u.status, CONCAT(p.nome, ' ', p.sobrenome) as nome, p.avatar
										FROM `tb_admin.usuarios` u 
										INNER JOIN `tb_admin.perfil` p ON u.id = p.usuario_id
										WHERE u.id = :id");
		$sql->bindParam(':id', $id);
		$sql->execute();

		return $sql->fetch(PDO::FETCH_ASSOC);
	}

	// Buscar todos os usuários
	public static function buscarTodosUsuarios()
	{
		$sql = MySql::connect()->prepare("SELECT u.id, u.email, u.cargo, u.logado, u.status, CONCAT(p.nome, ' ', p.sobrenome) as nome_completo, p.avatar 
										FROM `tb_admin.usuarios` u
										INNER JOIN `tb_admin.perfil` p ON u.id = p.usuario_id");
		$sql->execute();

		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	// Buscar usuarios cadastrados e ativos
	public static function listarUsuariosCadastrados($status)
	{
		//self::limparUsuariosOnline();
		$sql = MySql::connect()->prepare("SELECT u.id, u.email, u.cargo, u.logado, u.status, CONCAT(p.nome, ' ', p.sobrenome) as nome_completo, p.avatar 
										FROM `tb_admin.usuarios` u
										INNER JOIN `tb_admin.perfil` p ON u.id = p.usuario_id
										WHERE u.status = ?");
		$sql->execute(array($status));
		return $sql->fetchAll();
	}

	// Buscar usuarios cadastrados e inativos
	public static function listarUsuariosDesativados()
	{
		//self::limparUsuariosOnline();
		$sql = MySql::connect()->prepare("SELECT u.id, u.email, u.cargo, u.logado, u.status, CONCAT(p.nome, ' ', p.sobrenome) as nome_completo, p.avatar 
										FROM `tb_admin.usuarios` u
										INNER JOIN `tb_admin.perfil` p ON u.id = p.usuario_id
										WHERE u.status = 0");
		$sql->execute();
		return $sql->fetchAll();
	}

	/* ************************************************** */

	//atualizar usuario pela $_SESSION. (logado)
	public static function atualizarUsuario($cargo, $id)
	{
		$sql = MySql::connect()->prepare("UPDATE `tb_admin.usuarios` SET cargo = ? WHERE id = ?");
		if ($sql->execute(array($cargo, $id))) {
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
	public static function desativarUsuario($id)
	{
		$sql = MySql::connect()->prepare("UPDATE `tb_admin.usuarios` SET status = 0 WHERE id = ?");
		$sql->execute(array($id));
	}

	public static function ativarUsuario($id)
	{
		$sql = MySql::connect()->prepare("UPDATE `tb_admin.usuarios` SET status = 1 WHERE id = ?");
		$sql->execute(array($id));
	}

	//atualizar cargo do usuario
	public static function atualizarCargo($cargo, $id)
	{
		$sql = MySql::connect()->prepare("UPDATE `tb_admin.usuarios` SET cargo = ? WHERE id = ?");
		$sql->execute(array($cargo, $id));
	}
}
