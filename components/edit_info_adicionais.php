<?php

$id = $_SESSION['id'];

$mensagem = '';
?>

<!--nav-tabs-->
<div class="container px-2">

    <header>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo INCLUDE_PATH ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo INCLUDE_PATH ?>perfil?usuario=<?php echo $id ?>">Perfil</a></li>
                <li class="breadcrumb-item"><a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=<?php echo $id ?>">Editando</a></li>
            </ol>
        </nav>
    </header>

    <main class="px-2">
        <!--Redes Sociais-->
        <div class="card my-4 py-2">
            <nav class="navbar navbar-expand-lg">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=redes_sociais&id=<?php echo $_SESSION['id'] ?>" class="nav-link">Redes Sociais</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=formacao&id=<?php echo $_SESSION['id'] ?>" class="nav-link">Formações</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=interesses" class="nav-link">Interesses</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="card-body">

            <?php

            switch ($_GET['usuario_edit']) {
                case ($_GET['usuario_edit'] === 'redes_sociais'):
                    include('components/redes_sociais.php');
                    break;
                case ($_GET['usuario_edit'] === 'editar_redes_sociais'):
                    include('components/edit_redes_sociais.php');
                    break;
                case ($_GET['usuario_edit'] === 'criar_redes_sociais'):
                    include('components/criar_redes_sociais.php');
                    break;
                case ($_GET['usuario_edit'] === 'formacao'):
                    include('components/edit_formacao.php');
                    break;
                case ($_GET['usuario_edit'] === 'editar_formacao'):
                    include('components/atualizar_formacao.php');
                    break;
                case ($_GET['usuario_edit'] === 'criar_formacao'):
                    include('components/criar_formacao.php');
                    break;
                case ($_GET['usuario_edit'] === 'interesses'):
                    include('components/interesses.php');
                    break;
                case ($_GET['usuario_edit'] === 'editar_interesses'):
                    include('components/edit_interesses.php');
                    break;
                case ($_GET['usuario_edit'] === 'criar_interesses'):
                    include('components/criar_interesses.php');
                    break;
                default:
                    include('components/redes_sociais.php');
            }

            ?>
        </div><!--card-body-->
</div><!--page-->
<!--Redes Sociais-->

<?php
//         <!--Formação-->
//         <div class="card mb-4">
//             <div class="card-body">
//                 <?php

//                 include('components/edit_formacao.php');

//                 
//             </div><!--card-body-->
//         </div>
//         <!--Formação-->

//         <!--Interesses Pessoais-->
//         <div class="card mb-4">
//             <div class="card-body">
//                 <?php

//                 if ($_GET['usuario_edit'] === 'editar') {
//                     include('components/edit_interesses.php');
//                 } else {
//                     include('components/interesses_pessoais.php');
//                 }

//                 
//             </div><!--card-body-->
//         </div>
//         <!--Interesses Pessoais-->
//     </main><!--main-->
// </div><!--container-->

?>