<!-- Modal de confirmação -->
<div class="modal fade" id="excluirArtigoDoAutor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <?php
    //Exibe alerta de sucesso ou erro ao excluir categoria 
    try {

        if (isset($_GET['excluir']) && isset($_GET['idArtigo']) && $_GET['excluir'] == 'ok') {
            $id = intval($_GET['idArtigo']);
            $usuario_id = intval($_GET['id']);


            if (http_response_code() >= 200 && http_response_code() < 300) {
                Artigos::deletarArtigo($id, $usuario_id);
                Painel::redirect(INCLUDE_PATH_PAINEL . $_GET['url']);
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
                <a href="<?php echo INCLUDE_PATH_PAINEL . $_GET['url'] ?>" class="btn-close"></a>
            </div>
            <div class="modal-body">
                <p>Essa ação não poderá ser desfeita!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <!-- Link para exclusão que será atualizado com o ID via JS -->
                <a id="confirmExcluirArtigoAutor" class="btn btn-danger">Excluir</a>
            </div>
        </div><!--modal-content-->
    </div><!--modal-dialog-->
</div><!-- Modal de confirmação -->
<!-- Modal de confirmação -->

<section class="list-user mx-md-3">
    <div class="">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3 mb-0"><span class="lead fs-3 h2 ls-5">Lista de Artigos</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1 d-none">
                    This week
                </button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr class="table-success">
                    <td>Autor</td>
                    <td>Título</td>
                    <td>Data</td>
                    <td>Ações</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $artigos = Artigos::listarArtigosComAutores();  // Chama a função para pegar os artigos

                $imagem = INCLUDE_PATH . 'static/uploads/avatar.jpg';  // Imagem padrão


                if ($artigos) {  // Verifica se há artigos

                ?>

                    <?php foreach ($artigos as $artigo) {
                        if ($artigo['avatar'] == null && $artigo['autor'] == null) {
                            $artigo['avatar'] = $imagem;
                            $artigo['autor'] = $artigo['email'];
                        }
                    ?>
                        <tr>
                            <td>
                                <img src="<?php echo htmlspecialchars($artigo['avatar']); ?>" alt="Imagem do perfil" width="24" height="24" class="rounded-circle mx-2">
                                <span class="fs-6"><?php echo htmlspecialchars($artigo['autor']); ?></span>
                            </td>
                            <td><?php echo htmlspecialchars($artigo['titulo']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($artigo['data_criacao'])); ?></td>
                            <td class='text-end'>
                                <!-- Botão para editar artigo -->
                                <a href='<?php echo INCLUDE_PATH_PAINEL ?>atualizar_artigos?id=<?php echo $artigo['id']; ?>' class="btn btn-warning btn-sm my-1 my-md-0 mx-lg-2">
                                    <svg class='bi'>
                                        <use xlink:href='#pencil' />
                                    </svg>
                                </a>
                                <?php
                                if ($artigo['status'] == 1) {
                                ?>
                                    <!-- Botão para excluir artigo -->
                                    <button title="Excluir artigo" type="button" class="btn btn-danger btn-sm my-1 my-md-0" data-bs-toggle="modal" data-bs-target="#excluirArtigoDoAutor" data-idArtigo='<?php echo $artigo['id']; ?>' data-id='<?php echo $artigo['usuario_id']; ?>'>
                                        <svg class='bi'>
                                            <use xlink:href='#trash' />
                                        </svg>
                                    </button>
                                <?php
                                } else {

                                ?>
                                    <button title="Ativar artigo" type="button" class="btn btn-success btn-sm my-1 my-md-0" data-bs-toggle="modal" data-bs-target="#excluirArtigoDoAutor" data-idArtigo='<?php echo $artigo['id']; ?>' data-id='<?php echo $artigo['usuario_id']; ?>'>
                                        <svg class='bi'>
                                            <use xlink:href='#file-earmark' />
                                        </svg>
                                    </button>

                                <?php
                                }

                                ?>
                            </td>
                        </tr>
                    <?php } ?>

                <?php
                } else {
                    echo "Nenhum artigo encontrado.";
                }
                ?>

            </tbody>
        </table>
    </div>


</section>

<script>
    // Quando o modal é acionado, atualiza o link de confirmação com o ID correto
    const modalExcluirArtigos = document.querySelectorAll('.btn-danger[data-bs-target="#excluirArtigoDoAutor"');
    modalExcluirArtigos.forEach(link => {
        link.addEventListener('click', (event) => {
            const artigoId = link.getAttribute('data-idArtigo');
            const usuarioID = link.getAttribute('data-id');
            const confirmLink = document.getElementById('confirmExcluirArtigoAutor');
            confirmLink.setAttribute('href', '<?php echo INCLUDE_PATH_PAINEL ?>lista_artigos?excluir=ok&idArtigo=' + artigoId + '&id=' + usuarioID);
            console.log(confirmLink);
            console.log(categoriaId);
        });
    });
</script>