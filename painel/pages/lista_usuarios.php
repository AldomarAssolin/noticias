<!--

Lista de usuários com quantidade de artigos/noticias/posts escritos
botões para acessar lista de artigos do usuario, editar usuario e excluir usuario

-->


<section class="list-user mx-md-3">
    <div class="">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3 mb-0">Lista de Usuários</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1 d-none">
                    This week
                </button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <?php 
        $totalUsuariosCadastrados = Usuario::listarUsuariosCadastrado();
        include('./components/cardUserPainel.php') 
        ?>
    </div>
</section>