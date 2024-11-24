<?php

$id = $_GET['usuario'];

$mensagem = '';

//info usuario
$perfil = Perfil::listarPerfilUsuario($id);
$redes = Perfil::getAllRedesSociais($id);
$formacao = Perfil::getFormacao($id);
$interesses = Perfil::getInteresses($id);

//Padrao de imagem
$avatar = '';
$capa = '';
$redesImg = '';
if ($avatar == null || $avatar == '' || $capa == null || $capa == '' || $redes == null || $redes == '') {
    $avatar = INCLUDE_PATH . 'static/uploads/avatar.jpg';
    $capa = INCLUDE_PATH . 'static/uploads/capa.jpeg';
    $redesImg = INCLUDE_PATH . 'static/uploads/redes_sociais.jpeg';
}

if ($redes == false || $redes == '' || $formacao == false || $formacao == '' || $interesses == false || $interesses == '') {
    $mensagem .= '<h2>Atualize seu perfil</h2>';
}

if ($perfil == false) {
    $perfil = array(
        'nome' => $_SESSION['user'],
        'email' => $_SESSION['user'],
        'bio' => 'BIO',
        'cidade' => 'Cidade',
        'uf' => 'UF',
        'sobre' => 'Sobre mim',
        'avatar' => $avatar,
        'capa' => $capa
    );
} else {
    $perfil = array(
        'nome' => $perfil['nome'],
        'sobrenome' => $perfil['sobrenome'],
        'email' => $perfil['email'] ?? $_SESSION['user'],
        'bio' => $perfil['bio'],
        'cidade' => $perfil['cidade'],
        'uf' => $perfil['uf'],
        'sobre' => $perfil['sobre'],
        'avatar' => $perfil['avatar'],
        'capa' => $perfil['capa']
    );
}
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-4">
            <!--sidebar-->
            <div class="card p-2">
                <img src="<?php echo $perfil['avatar'] ?? $avatar ?>" class="card-img-top" alt="User Image">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $perfil['nome'] . ' ' . $perfil['sobrenome'] ?? 'Nome' ?></h5>
                    <p class="card-text"><?php echo $perfil['email'] ?? 'Email' ?></p>
                    <p class="card-text"><?php echo $perfil['bio'] ?? 'BIO' ?></p>
                    <div class="mb-3">
                        <h5 class="card-title">Endereço</h5>
                        <p class="card-text"><?php echo ucfirst($perfil['cidade']) . ' - ' . strtoupper($perfil['uf']) ?></p>
                    </div><!--endereco-->
                    <div>
                        <h5 class="card-title">Redes Sociais</h5>
                        <p class="card-text">
                            <?php
                            foreach ($redes as $key => $value) {
                            ?>
                                <a href="<?php echo  $value['link'] ?>" class="btn btn-outline-<?php echo  $value['cor'] ?> btn-sm my-1" target="_blank">
                                    <?php echo  $value['nome'] ?? $mensagem ?>
                                </a>

                            <?php
                            }
                            ?>
                        </p>
                    </div><!--redes-sociais-->
                </div><!--card-body-->
                <?php
                if ($_SESSION) {
                    if ($_SESSION['id'] == $_GET['usuario']) {
                ?>
                        <a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=<?php echo $_SESSION['id'] ?>" class="btn btn-primary">Editar Perfil</a>
                <?php
                    }
                }
                ?>
            </div><!--card-->
            <!--sidebar-->
        </div><!--col-md-4-->


        <div class="col-md-8">

            <!--nav-tabs-->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Sobre Mim</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Formação</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Interesses Pessoais</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" aria-disabled="true">Disabled</a>
                </li> -->
            </ul>
            <!--nav-tabs-->

            <!--card sobre mim -->
            <div class="page px-4 border-bottom my-3">
                <h1 class="display-6 fw-bold text-body-emphasis">Sobre mim</h1>
                <div class="mx-auto">
                    <p class="lead mb-4 text-justify"><?php echo $perfil['sobre'] ?></p>
                </div>
                <div class="overflow-hidden" style="max-height: 30vh;">
                    <div class="container px-5">
                        <img src="<?php echo $perfil['capa'] ?? $capa ?>" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="700" height="500" loading="lazy">
                    </div>
                </div>
            </div>
            <!--card sobre mim -->

            <!--card formacao-->
            <div class="card page my-3">
                <div class="card-body">
                    <h5 class="card-title">Formação</h5>
                    <?php
                    echo $mensagem;
                    foreach ($formacao as $key => $value) {
                    ?>
                        <div class="card mb-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="card-header fs-6 fst-italic">
                                        <?php echo $value['nivel'] ?>
                                    </div>
                                    <div class="card-body">
                                        <p>
                                            <?php echo $value['nome'] ?> -
                                            <span class="text-info"><?php echo $value['instituicao'] ?></span>
                                        </p>
                                        <p>
                                            <?php echo $value['cidade'] ?> - <?php echo $value['uf'] ?>
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted fst-italic"><?php echo date('d/m/y', strtotime($value['data_inicio'])) ?> - <?php echo date('d/m/y', strtotime($value['conclusao'])) ?></small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <img src="<?php echo $value['logo'] ?>" class="card-img-top" alt="logo">
                                </div>
                            </div><!--row-->
                        </div><!--card-->

                    <?php
                    }
                    ?>
                </div><!--formacao-->
            </div><!--card-->
            <!--card formacao-->

            <!--Interesses Pessoais-->
            <div class="card page my-3">
                <div class="card-header">
                    Interesses Pessoais
                </div><!--card-header-->
                <div class="card-body">
                    <?php
                    echo $mensagem;
                    foreach ($interesses as $key => $value) {

                    ?>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="area"><?php echo $value['area'] ?></h4>
                            </div>
                            <div class="card-body mb-3" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="<?php echo $value['imagem'] ?>" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $value['nome'] ?></h5>
                                            <p class="card-text">
                                                Conteúdo
                                            </p>
                                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div><!--card-body-->
            </div><!--card-->
            <!--Interesses Pessoais-->
        </div><!--col-md-8-->
    </div><!--row-->
</div><!--container-->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.nav-link');
        const pages = document.querySelectorAll('.page');

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', function(event) {
                event.preventDefault();

                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                pages.forEach(page => page.style.display = 'none');
                pages[index].style.display = 'block';
            });
        });

        // Initialize the first tab and page as active
        tabs[0].classList.add('active');
        pages[0].style.display = 'block';
    });
</script>