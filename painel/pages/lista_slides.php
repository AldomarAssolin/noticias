<?php




$slides = Slides::listarSlides();



?>

<div class="">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 mb-0"><span class="lead fs-3 h2 ls-5">Lista de Slides</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1 d-none">
                This week
            </button>
        </div>
    </div>
</div>



<div class="container mt-5">
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagem</th>
                <th class='text-end'>Ações</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($slides as $key => $value) {
            ?>
                <tr>
                    <td><?php echo $value['id'] ?></td>
                    <td><?php echo $value['titulo'] ?></td>
                    <td><img src='<?php echo $value['imagem'] ?>' alt='<?php echo $value['id'] ?>' width='100'></td>
                    <td class='text-end'>
                        <!-- Botão para editar artigo -->
                        <a href='<?php echo INCLUDE_PATH_PAINEL ?>atualizar_slide?id=<?php echo $value['id']; ?>' class="btn btn-warning btn-sm my-1 my-md-0 mx-lg-2">
                            <svg class='bi'>
                                <use xlink:href='#pencil' />
                            </svg>
                        </a>
                        <!-- Botão para excluir artigo -->
                        <a href='<?php echo INCLUDE_PATH_PAINEL ?>?excluir=<?php echo $value['id']; ?>' class="btn btn-danger btn-sm my-1 my-md-0">
                            <svg class='bi'>
                                <use xlink:href='#trash' />
                            </svg>
                        </a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>