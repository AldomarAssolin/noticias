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

<!-- Modal de confirmação -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

<?php
//Exibe alerta de sucesso ou erro ao excluir categoria 
var_dump(http_response_code());
try	{
    if (isset($_GET['excluir-categoria']) && isset($_GET['id']) && $_GET['excluir-categoria'] == 'ok') {
        $id = intval($_GET['id']);
        if (http_response_code() >= 200 && http_response_code() < 300) {
            Categorias::delete($id);
        } 
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tem certeza que deseja excluir?</h1>
                <a href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar_categorias" class="btn-close"></a>
            </div>
            <div class="modal-body">
                <p>Essa ação não poderá ser desfeita!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <!-- Link para exclusão que será atualizado com o ID via JS -->
                <a id="confirmExcluir" class="btn btn-danger">Excluir</a>
            </div>
        </div><!--modal-content-->
    </div><!--modal-dialog-->
</div><!-- Modal de confirmação -->
<!-- Modal de confirmação -->



<!-- Tabela de categorias -->
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <?php

        ?>
        <!-- <div class="alert alert-danger" role="alert">
  A simple danger alert—check it out!
</div> -->
        <?php

        ?>
        <thead class="thead-dark">
            <tr class="table-success">
                <th>#</th>
                <th>Nome da Categoria</th>
                <th class="text-end">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Lista as categorias
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
                        <button type="button" class="btn btn-danger btn-sm my-1 my-md-0" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?php echo $value['id']; ?>">
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
<!-- Tabela de categorias -->

<script>
    // Quando o modal é acionado, atualiza o link de confirmação com o ID correto
    const modalExcluirLinks = document.querySelectorAll('.btn-danger[data-bs-toggle="modal"]');
    modalExcluirLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            const categoriaId = link.getAttribute('data-id');
            const confirmLink = document.getElementById('confirmExcluir');
            confirmLink.setAttribute('href', '<?php echo INCLUDE_PATH_PAINEL ?>gerenciar_categorias?excluir-categoria=ok&id=' + categoriaId);
        });
    });
</script>