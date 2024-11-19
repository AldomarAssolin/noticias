<?php

$imagem = INCLUDE_PATH.'static/uploads/avatar.jpg';

$email = $_SESSION['user'];

if(isset($_GET['usuario_edit'])){
    $usuario = Usuario::buscarUsuario($email);
    
    $email = $usuario['email'];
    $nome = $usuario['nome'] ?? $email;
    $formacao = 'Análise e Desenvolvimento de Sistemas';
    $bio = $usuario['bio'] ?? 'Meu nome é Aldomar Assolin, meu apelido é Manex, fui soldador por 15 anos, Hoje faço Análise e Desenvolvimento de Sistemas, estou no 5° semestre.';
    
    if($usuario['img'] === NULL){
        $img = $imagem;
    }else{
        $img = INCLUDE_PATH_PAINEL.$usuario['img'];
    }
    
}


?>
<!--

<svg class="bi bi-camera" width="16" height="16" fill="currentColor">
                <use xlink:href="#camera" />
            </svg>

-->

<div class="card">
    <div class="card-header">
        <img src="<?php echo $img ?>" class="card-img-top" alt="User Image">
        <div class="d-flex align-items-center my-2" title="editar imagem de perfil">
            
            <input type="file" name="nova_imagem">
        </div>
    </div>
    <div class="card-body">
        <h5 class="card-title"><input type="text" class="form-control" name="nome" value="<?php echo $nome ?>"></h5>
        <p class="card-text"><input type="text" class="form-control" name="formacao" value="<?php echo $formacao ?>"></p>
        <p class="card-text"><textarea type="text" rows="5" class="form-control" name="bio" placeholder="<?php echo $bio ?>"></textarea></p>
    </div><!--card-body-->
    <div class="card-footer">
        <?php
        if ($_SESSION) {
        ?>
            <input type="submit" class="btn btn-success" value="Salvar">
            <a href="<?php echo INCLUDE_PATH ?>perfil?usuario=<?php echo $_SESSION['user'] ?>" class="btn btn-secondary">Cancelar</a>
        <?php
        }
        ?>
    </div><!--card-footer-->
</div><!--card-->