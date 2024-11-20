<?php

$avatar = '';
$capa = '';
if($avatar == null || $avatar == '' || $capa == null || $capa == ''){
    $avatar = INCLUDE_PATH . 'static/uploads/avatar.jpg';
    $capa = INCLUDE_PATH . 'static/uploads/capa.jpeg';
}
  
$id = $_GET['id'];

$artigos = Artigos::listarArtigosAutor($id);
$perfil = Perfil::listarPerfilNomeAvatar($id);

?>

<div class="container my-5">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
        <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
            <h1 class="display-4 fw-bold lh-1 text-body-emphasis"><?php echo $perfil['nome'] ?></h1>
            <p class="lead">Veja todos os artigos do autor.</p>
            <a href="<?php echo INCLUDE_PATH ?>perfil?usuario=<?php echo Painel::generateSlug($perfil['usuario_id']); ?>" class="btn btn-primary">Ver Perfil</a>
        </div>
        <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
            <img class="rounded-lg-3" src="<?php echo $avatar ?>" alt="" width="450" height="320">
        </div>
    </div>
</div>

<div class="album py-5 mb-3 bg-body-tertiary">
    <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

            <?php
            if ($artigos == false) {
                Painel::alert('erro', 'Autor não encontrado!');
            } else {
                foreach ($artigos as $key => $value) {
            ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="<?php echo $value['capa'] ? $value['capa'] : $capa ?>" class="bd-placeholder-img card-img-top" width="100%" height="225">
                            <div class="card-header">
                                <h4 class="my-0 fw-normal"><?php echo $value['titulo'] ?></h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><?php echo $value['descricao'] ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="<?php echo INCLUDE_PATH ?>artigos?id=<?php echo urlencode($value['id']) ?>" class="btn btn-sm btn-outline-secondary">Ver</a>
                                    </div><!-- /.btn-group -->
                                    <small class="text-body-secondary"><?php echo date('d M y', strtotime($value['data_criacao'])) ?></small>
                                </div><!-- /.d-flex -->
                            </div><!-- /.card-body -->
                        </div><!-- /.card -->
                    </div><!-- /.col -->
            <?php
                } // Fim do foreach
            } // Fim do else
            ?>
        </div><!-- /.row -->
    </div><!-- /.container -->