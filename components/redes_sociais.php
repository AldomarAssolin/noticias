<div class="text-end py-2">
    <a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=criar" class="btn btn-success btn-sm">Criar Nova</a>
</div>
<?php
$redesImg = INCLUDE_PATH . 'static/uploads/redes_sociais.jpeg';

$redes = Perfil::getAllRedesSociais($id);

foreach ($redes as $key => $value) {
?>
    <!--Redes Sociais-->
    <div class="card mb-3 " style="height:150px">
        <div class="row g-0">
            <div class="col-md-4">
                <div class="card-body p-0">
                    <img src="<?php echo $value['imagem'] ?? $redesImg ?>" alt=" Imagem de <?php echo $value['nome'] ?>" class="img-fluid rounded-start image" alt="<?php echo ucfirst($value['nome']) ?>">
                </div>
            </div><!--col-md-4-->
            <div class="col-md-8">
                <div class="card-body pb-0">
                    <h5 class="card-title"><?php echo ucfirst($value['nome']) ?></h5>
                    <p class="card-text"><?php echo ucfirst($value['link']) ?></p>
                    <p class="card-text">
                        <small class="text-body-secondary">
                            <div class="card-footer w-100 pb-2 text-end d-flex align-items-center justify-content-end">
                                <a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=editar&id=<?php echo $value['id'] ?>" class="btn btn-outline-warning btn-sm">Editar</a>
                                <a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=excluir&id=<?php echo $value['id'] ?>" class="btn btn-outline-danger btn-sm">Excluir</a>
                            </div>
                        </small>
                    </p>
                </div><!--card-body-->
            </div><!--col-md-8-->
        </div><!--row-->
    </div><!--card-->
    <!--Redes Sociais-->
<?php
}
?>