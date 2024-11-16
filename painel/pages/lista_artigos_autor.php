<?php


// Pega o ID do autor através de $_GET
$id = $_GET['id'];

$url = INCLUDE_PATH_PAINEL . 'lista_artigos_autor?id=' . $id;

?>

<!-- Modal de confirmação -->
<div class="modal fade" id="excluirArtigo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <?php
    //Exibe alerta de sucesso ou erro ao excluir categoria 
    try {

        if (isset($_GET['excluir']) && isset($_GET['idArtigo']) && $_GET['excluir'] == 'ok') {
            $idArtigo = intval($_GET['idArtigo']);
            $id = intval($_GET['id']);

            if (http_response_code() >= 200 && http_response_code() < 300) {
                Artigos::deletarArtigo($idArtigo, $id);
                Painel::redirect(INCLUDE_PATH_PAINEL . $_GET['url'] . '?id=' . $id);
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
                <a href="<?php echo INCLUDE_PATH_PAINEL . $_GET['url'] . '?id=' . $_GET['id'] ?>" class="btn-close"></a>
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


<?php

// Chama a função listarArtigosAutor para pegar os artigos do autor selecionado
$artigos = Artigos::listarArtigosAutor($id);

$autor = $artigos[0]['autor'];// Pega o nome do autor
$avatar = $artigos[0]['avatar'];// Pega o avatar do autor
var_dump($avatar);
// Se o autor não for encontrado, pega o email do autor
if($autor == NULL){
    $autor = $artigos[0]['email'];
}else{
    $autor = $autor;
}

if($avatar == NULL){
    $avatar = INCLUDE_PATH . 'static/uploads/avatar.jpg';
}else{
    $avatar = $avatar;
}



// Título da página
$titulo = $artigos == false ? 'Nenhum artigo encontrado' : '<span class="lead fs-3 h2 ls-5">Lista de Artigos de</span> <b>' . $autor . '</b>'; 

?>


<section class="list-user mx-md-3">
    <div class="">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3 mb-0"><?php echo $titulo ?></h1>
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
                    <td class='text-end'>Ações</td>
                </tr>
            </thead>
            <tbody>
                <?php

                //var_dump($artigos);
                // Itera sobre os artigos do autor
                foreach ($artigos as $key => $value) {

                ?>

                    <tr>
                        <td>
                            <img src="<?php echo htmlspecialchars($avatar); ?>" alt="Imagem do perfil" width="24" height="24" class="rounded-circle mx-2">
                            <span class="fs-6"><?php echo htmlspecialchars($autor); ?></span>
                        </td> <!-- Nome do autor do artigo -->
                        <td><?php echo $value['titulo']; ?></td> <!-- Título do artigo -->
                        <td><?php echo date('d/m/Y', strtotime($value['data_criacao'])); ?></td> <!-- Data de criação formatada -->
                        <td class='text-end'>
                            <!-- Botão para editar artigo -->
                            <a title="Atualizar artigo" href='<?php echo INCLUDE_PATH_PAINEL ?>atualizar_artigos?id=<?php echo $value['id']; ?>' class="btn btn-warning btn-sm my-1 my-md-0 mx-lg-2">
                                <svg class='bi'>
                                    <use xlink:href='#pencil' />
                                </svg>
                            </a>

                            <?php
                            if ($value['status'] == 1) {
                            ?>
                                <!-- Botão para excluir artigo -->
                                <button title="Excluir artigo" type="button" class="btn btn-danger btn-sm my-1 my-md-0" data-bs-toggle="modal" data-bs-target="#excluirArtigo" data-idArtigo="<?php echo $value['id']; ?>" data-id="<?php echo $_GET['id']; ?>">
                                    <svg class='bi'>
                                        <use xlink:href='#trash' />
                                    </svg>
                                </button>
                            <?php
                            } else {
                            ?>
                                <!-- Botão para ativar artigo -->
                                <button title="Ativar artigo" type="button" class="btn btn-success btn-sm my-1 my-md-0" data-bs-toggle="modal" data-bs-target="#excluirArtigo" data-idArtigo="<?php echo $value['id']; ?>" data-id="<?php echo $_GET['id']; ?>">
                                    <svg class='bi'>
                                        <use xlink:href='#file-earmark' />
                                    </svg>
                                </button>

                            <?php
                            }
                            ?>
                        </td>
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
    const modalExcluirLinks = document.querySelectorAll('.btn-danger[data-bs-target="#excluirArtigo"');
    modalExcluirLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            const artigoId = link.getAttribute('data-idArtigo');
            const usuarioID = link.getAttribute('data-id');
            const confirmLink = document.getElementById('confirmExcluir');
            confirmLink.setAttribute('href', '<?php echo INCLUDE_PATH_PAINEL ?>lista_artigos_autor?excluir=ok&idArtigo=' + artigoId + '&id=' + usuarioID);
            console.log(confirmLink);
            console.log(categoriaId);
        });
    });
</script>