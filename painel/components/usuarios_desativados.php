<!-- Modal de confirmação -->
<div class="modal fade" id="ativarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <?php
    //Exibe alerta de sucesso ou erro ao excluir categoria 
    var_dump(http_response_code());
    try {
        if (isset($_GET['ativar']) && isset($_GET['id']) && $_GET['ativar'] == 'ok') {
            $id = intval($_GET['id']);
            if (http_response_code() >= 200 && http_response_code() < 300) {
                Usuario::ativarUsuario($id);
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tem certeza que deseja ativar?</h1>
                <a href="<?php echo INCLUDE_PATH_PAINEL . $_GET['url'] ?>" class="btn-close"></a>
            </div>
            <div class="modal-body">
                <p>O usuário será reativado!</p>
                <p><?php var_dump($_GET)  ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <!-- Link para exclusão que será atualizado com o ID via JS -->
                <a id="confirmAtivar" class="btn btn-danger">Ativar</a>
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
            <span class="mx-2 lead">Usuários Desativados</span>
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



                foreach ($usuariosDesativados as $key => $value) {

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
                            <!-- Botão para ativar usuario -->
                            <button type="button" class="modal-ativar btn btn-success btn-sm my-1 my-md-0" data-bs-toggle="modal" data-bs-target="#ativarUsuario" data-id="<?php echo $value['id']; ?>" title="Ativar usuário" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
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
    const modalAtivarLinks = document.querySelectorAll('.btn-success[data-bs-target="#ativarUsuario"]');
    modalAtivarLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            const categoriaId = link.getAttribute('data-id');
            const confirmLink = document.getElementById('confirmAtivar');
            confirmLink.setAttribute('href', '<?php echo INCLUDE_PATH_PAINEL ?>?ativar=ok&id=' + categoriaId);
        });
    });
</script>