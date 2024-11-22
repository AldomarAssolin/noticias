<?php

$id = $_SESSION['id'];

$mensagem = '';
?>

<!--nav-tabs-->
<div class="container px-2">
    <header>
        <nav class="navbar w-100">
            <div class="row w-100">
                <div class="col-9">
                    <ul class="nav nav-tabs mt-3 mt-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo INCLUDE_PATH ?>perfil?redes_sociais&id=<?php echo $value['id'] ?>">Redes Sociais</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo INCLUDE_PATH ?>perfil?formacao&id=<?php echo $value['id'] ?>">Formação</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo INCLUDE_PATH ?>perfil?interesses&id=<?php echo $value['id'] ?>">Interesses Pessoais</a>
                        </li>
                    </ul>
                </div>
                <div class="col-3">
                    <div class="d-flex aling-items-end justify-content-end">
                        <?php
                        if ($_GET['usuario_edit'] === 'criar') {
                        ?>
                            <a class="btn btn-outline-secondary mx-2" href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=<?php echo $_SESSION['id'] ?>">Voltar</a>
                        <?php
                        } else if ($_GET['usuario_edit'] === 'editar') {
                        ?>
                            <a class="btn btn-outline-secondary mx-2" href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=<?php echo $_SESSION['id'] ?>">Voltar</a>
                        <?php

                        } else {

                        ?>

                            <a class="btn btn-outline-secondary mx-2" href="<?php echo INCLUDE_PATH ?>perfil_usuario?usuario=<?php echo $id ?>">Perfil</a>

                        <?php
                        }

                        ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!--nav-tabs-->

    <main class="px-2">
        <!--Redes Sociais-->
        <div class="page my-4 py-2">
            <div class="card-body">
                <?php

                switch ($_GET['usuario_edit']) {
                    case ($_GET['usuario_edit'] === 'editar'):
                        include('components/edit_redes_sociais.php');
                        break;
                    case ($_GET['usuario_edit'] === 'criar'):
                        include('components/criar_redes_sociais.php');
                        break;
                    default:
                        include('components/redes_sociais.php');
                }

                ?>
            </div><!--card-body-->
        </div>
        <!--Redes Sociais-->


        <!--Formação-->
        <div class="page mb-4">
            <div class="card-body">
                <?php

                if ($_GET['usuario_edit'] === 'editar') {
                    include('components/edit_formacao.php');
                } else {
                    include('components/formacao.php');
                }

                ?>
            </div><!--card-body-->
        </div>
        <!--Formação-->

        <!--Interesses Pessoais-->
        <div class="page mb-4">
            <div class="card-body">
                <?php

                if ($_GET['usuario_edit'] === 'editar') {
                    include('components/edit_interesses.php');
                } else {
                    include('components/interesses_pessoais.php');
                }

                ?>
            </div><!--card-body-->
        </div>
        <!--Interesses Pessoais-->
    </main><!--main-->
</div><!--container-->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.nav-link');
        const pages = document.querySelectorAll('.page');

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', function(event) {
                event.preventDefault();

                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                pages.forEach(page => page.style.display = 'none');
                pages[index].style.display = 'block';
            });
        });

        // Initialize the first tab and page as active
        tabs[0].classList.add('active');
        pages[0].style.display = 'block';
    });
</script>