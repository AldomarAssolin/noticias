<!-- Modal de confirmação -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <?php
    //Exibe alerta de sucesso ou erro ao excluir categoria 
    var_dump(http_response_code());
    try {
        if (isset($_GET['excluir']) && isset($_GET['id']) && $_GET['excluir'] == 'ok') {
            $id = intval($_GET['id']);
            if (http_response_code() >= 200 && http_response_code() < 300) {
                Usuario::deletarUsuario($id);
            }
            Painel::redirect(INCLUDE_PATH_PAINEL);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    ?>

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tem certeza que deseja excluir?</h1>
                <a href="<?php echo INCLUDE_PATH_PAINEL . $_GET['url'] ?>" class="btn-close"></a>
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




<section class="online-users my-3 bg-body-tertiary shadow">
    <div class="p-2">
        <h6 class="d-flex justify-content-start align-items-center mt-4 mb-3 text-body-secondary border-bottom">
            <svg class="bi">
                <use xlink:href="#people" />
            </svg>
            <span class="mx-2 lead">Usuários do Painel</span>
        </h6>
        <table class="table my-3">
            <thead>
                <tr class="table-success">
                    <th scope="col">Nome</th>
                    <th scope="col" class="text-end">Cargo</th>
                    <th scope="col" class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php



                foreach ($totalUsuariosCadastrados as $key => $value) {

                ?>
                    <input type="hidden" name="id" value="<?php echo $value['id'] ?>">

                    <tr>
                        <th scope="row">
                            <?php

                            ?>
                            <img src="<?php echo $value['img'] ?>" alt="Imagem Perfil" width="24" height="24"
                                class="rounded-circle <?php echo  $value['logado'] == 1 ? 'border-success border-2' : '' ?> img-thumbnail mx-2">

                            <?php echo $value['nome'] ?>
                        </th>
                        <td class="text-end"><?php echo Painel::$cargos[$value['cargo']] ?></td>
                        <td class='text-end'>
                            <a title="Ver artigos do usuário" href="<?php echo INCLUDE_PATH_PAINEL ?>lista_artigos_autor?id=<?php echo $value['id'] ?>" class='btn btn-primary btn-sm my-1 my-md-0'>
                                <svg class='bi'>
                                    <use xlink:href='#folder-symlink-fill' />
                                </svg>
                            </a>
                            <a title="Atualizar usuário" href="<?php echo INCLUDE_PATH_PAINEL ?>atualizar_usuario?id=<?php echo  $value['id'] ?>" class='btn btn-warning btn-sm my-1 my-md-0 mx-lg-2'>
                                <svg class='bi'>
                                    <use xlink:href='#pencil' />
                                </svg>
                            </a>
                            <!-- Botão para excluir categoria -->
                            <button title="Excluir usuário" type="button" class="btn btn-danger btn-sm my-1 my-md-0" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?php echo $value['id']; ?>">
                                <svg class='bi'>
                                    <use xlink:href='#trash' />
                                </svg>
                            </button>
                        </td><!--acoes-->
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<script>
    // Quando o modal é acionado, atualiza o link de confirmação com o ID correto
    const modalExcluirLinks = document.querySelectorAll('.btn-danger[data-bs-target="#exampleModal"');
    modalExcluirLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            const categoriaId = link.getAttribute('data-id');
            const confirmLink = document.getElementById('confirmExcluir');
            confirmLink.setAttribute('href', '<?php echo INCLUDE_PATH_PAINEL ?>?excluir=ok&id=' + categoriaId);
        });
    });
</script>