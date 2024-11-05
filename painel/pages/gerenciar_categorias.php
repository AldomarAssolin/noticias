<div class="">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 mb-0">Gerenciamento de Categorias</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1 d-none">
                This week
            </button>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead class="thead-dark">
            <tr class="table-success">
                <th>#</th>
                <th>Nome da Categoria</th>
                <th class="text-end">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php


            // Verifica se o usuário clicou no botão de excluir
            if (isset($_GET['excluir'])) {
                $modal = true;
                $modalID = 
                $idExcluir = intval($_GET['excluir']);
                Categorias::delete($idExcluir);
                Painel::alert('sucesso', 'Categoria excluída com sucesso!');
            } else if (isset($_GET['order']) && isset($_GET['id'])) {
                Categorias::orderItem('tb_site.categorias', $_GET['order'], $_GET['id']);
            }

            

            
            ?>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Excluir esta categoria?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Se você realmente deseja excluir esta categoria, clique no botão excluir.
                            <?php var_dump($_GET) ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <a href='<?php echo INCLUDE_PATH_PAINEL ?>gerenciar_categorias?excluir=<?php echo $_GET['id'] ?>' class="btn btn-danger">
                                Excluir
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <?php


            //lista as categorias
            $categorias = Categorias::listarCategorias();

            foreach ($categorias as $key => $value) {


            ?>


                <tr>
                    <td><?php echo $value['id'] ?></td>
                    <td><?php echo $value['nome'] ?></td>
                    <td class='text-end'>
                        <!-- Botão para editar categoria -->
                        <a href='<?php echo INCLUDE_PATH_PAINEL ?>editar_categoria?id=<?php echo $value['id'] ?>' class="btn btn-warning btn-sm my-1 my-md-0 mx-lg-2">
                            <svg class='bi'>
                                <use xlink:href='#pencil' />
                            </svg>
                        </a>
                        <!-- Botão para excluir categoria -->
                        <!-- Button trigger modal -->
                        <button type="button" onclick="excluir()" class="btn btn-danger btn-sm my-1 my-md-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <svg class='bi'>
                                <use xlink:href='#trash' />
                            </svg>
                        </button>

                    </td>
                </tr>

            <?php
            }
            ?>
        </tbody>
    </table>
</div>