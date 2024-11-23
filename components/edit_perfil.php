<?php
// Definição de constantes e variáveis iniciais
$imagem = INCLUDE_PATH . 'static/uploads/avatar.jpg';
$capa_ficticia = INCLUDE_PATH . 'static/uploads/capa.jpeg';

$email = $_SESSION['user'];
$id = $_SESSION['id'];

// Obter dados do perfil do usuário
$perfil = Perfil::listarPerfilUsuario($id);

// Definir valores padrão ou usar dados do perfil
$nome = $perfil['nome'] ?? $email;
$sobrenome = $perfil['sobrenome'] ?? 'Sobrenome';
$bio = $perfil['bio'] ?? 'Resuma aqui sua biografia.';
$sobre = $perfil['sobre'] ?? 'Sobre mim';
$cidade = $perfil['cidade'] ?? 'Cidade';
$data_nasc = $perfil['data_nasc'] ?? '2000-10-10'; // Formato YYYY-MM-DD para input date
$uf = $perfil['uf'] ?? 'UF';
$avatar = $perfil['avatar'] ?? $imagem;
$capa = $perfil['capa'] ?? $capa_ficticia;

// Processar o formulário quando enviado
if (isset($_POST['editar_perfil']) && $_POST['editar_perfil'] == 'Salvar') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Coletar e limpar dados do formulário
        $nome = trim($_POST['nome']);
        $sobrenome = trim($_POST['sobrenome']);
        $data_nasc = $_POST['data_nasc'];
        $bio = trim($_POST['bio']);
        $sobre = trim($_POST['sobre']);
        $cidade = trim($_POST['cidade']);
        $uf = trim($_POST['uf']);
        $avatar_atual = $perfil['avatar'];
        $capa_atual = $perfil['capa'];
        
        // Validação dos campos
        $erros = [];
        if (empty($nome) || empty($sobrenome) || empty($data_nasc) || empty($bio)) {
            $erros[] = "Todos os campos obrigatórios devem ser preenchidos.";
        }
        if (strlen($nome) < 3 || strlen($sobrenome) < 3) {
            $erros[] = "Nome e sobrenome devem ter no mínimo 3 caracteres.";
        }
        if (strpos($nome, ' ') !== false || strpos($sobrenome, ' ') !== false) {
            $erros[] = "Nome e sobrenome não podem conter espaços.";
        }

        // Processamento de upload de imagens
        if($_FILES['avatar'] != null && $_FILES['avatar']['name'] != '' && $_FILES['avatar']['name'] != $avatar_atual) {
            $avatar = $_FILES['avatar'];
            $avatar = Painel::uploadFile($avatar);
        }else{
            $avatar = $avatar_atual;
        }

        if($_FILES['capa'] != null && $_FILES['capa']['name'] != '' && $_FILES['capa']['name'] != $capa_atual) {
            $capa = $_FILES['capa'];
            $capa = Painel::uploadFile($capa);
        }else{
            $capa = $capa_atual;
        }

        // Se não houver erros, atualizar o perfil
        if (empty($erros)) {
            $perfil = new Perfil();
            if ($perfil->atualizarPerfil($nome, $sobrenome, $data_nasc, $bio, $sobre, $avatar, $capa, $cidade, $uf, $id)) {
                echo Painel::alert('sucesso', 'Perfil atualizado com sucesso!');
            } else {
                echo Painel::alert('erro', 'Erro ao atualizar o perfil. Tente novamente.');
            }
        } else {
            foreach ($erros as $erro) {
                echo Painel::alert('erro', $erro);
            }
        }
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <div class="card">
        <div class="card-header">
            <img src="<?php echo htmlspecialchars($avatar) ?>" class="card-img-top" alt="Imagem de Perfil">
            <div class="d-flex align-items-center my-2" title="Editar imagem de perfil">
                <label for="avatar" class="file btn btn-outline-success">Escolha a sua imagem de perfil</label>
                <input id="avatar" type="file" name="avatar" accept="image/*">
            </div>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" id="nome" class="form-control" name="nome" value="<?php echo htmlspecialchars($nome) ?>" required>
            </div>
            <div class="mb-3">
                <label for="sobrenome" class="form-label">Sobrenome:</label>
                <input type="text" id="sobrenome" class="form-control" name="sobrenome" value="<?php echo htmlspecialchars($sobrenome) ?>" required>
            </div>
            <div class="mb-3">
                <label for="data_nasc" class="form-label">Data de Nascimento:</label>
                <input type="date" id="data_nasc" class="form-control" name="data_nasc" value="<?php echo htmlspecialchars($data_nasc) ?>" required>
            </div>
            <div class="mb-3">
                <label for="bio" class="form-label">Bio:</label>
                <textarea id="bio" class="form-control" name="bio" rows="3" required><?php echo htmlspecialchars($bio) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="sobre" class="form-label">Sobre mim:</label>
                <textarea id="sobre" class="form-control" name="sobre" rows="5"><?php echo htmlspecialchars($sobre) ?></textarea>
            </div>
            <div class="mb-3">
                <img src="<?php echo htmlspecialchars($capa) ?>" class="card-img-top" alt="Imagem de Capa">
                <div class="d-flex align-items-center my-2" title="Editar imagem de capa">
                    <label for="capa" class="file btn btn-outline-success">Escolha a sua imagem de capa</label>
                    <input id="capa" type="file" name="capa" accept="image/*">
                </div>
            </div>
            <div class="mb-3">
                <label for="cidade" class="form-label">Cidade:</label>
                <input type="text" id="cidade" class="form-control" name="cidade" value="<?php echo htmlspecialchars($cidade) ?>">
            </div>
            <div class="mb-3">
                <label for="uf" class="form-label">UF:</label>
                <input type="text" id="uf" class="form-control" name="uf" value="<?php echo htmlspecialchars($uf) ?>" maxlength="2">
            </div>
        </div>
        <div class="card-footer">
            <input type="submit" class="btn btn-success" name="editar_perfil" value="Salvar">
            <a href="<?php echo INCLUDE_PATH ?>perfil?usuario=<?php echo urlencode($_GET['usuario_edit']) ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
</form>
