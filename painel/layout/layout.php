<div class="container-fluid p-0 m-auto">
  <div>
    <?php

    ?>
  </div>
  <div class="d-flex p-0">
    <?php
    
    include('./painel/components/sidebar.php');

    ?>
    <main class="main w-100">

      <a href="<?php echo INCLUDE_PATH_PAINEL ?>userList">LINK</a>
      <?php
      include('./painel/commons/header.php');
      ?>
      <section class="section-main overflow-y-auto p-3">
        <?php
        echo '<br>';
        var_dump($arquivo);

        // switch (is_file($arquivo)) {
        //   case 'home':
        //     echo '<br>';
        //     var_dump($arquivo);
        //     include $arquivo;
        //     break;
        //   case 'cadastrarUsuario':
        //     include $arquivo;
        //     break;
        //   case 'cadastrarArtigo':
        //     include $arquivo;
        //     break;
        //   case 'userList':
        //     include $arquivo;
        //     break;
        //   case 'articleListAutor':
        //     include $arquivo;
        //     break;
        //   default:
        //     include './pages/404.php';
        //     break;
        // }

        //include('./painel/pages/home.php');
        //include('./painel/pages/cadastrarUsuario.php');
        //include('./painel/pages/cadastrarArtigo.php');
        //include('./painel/pages/userList.php');
        //include('./painel/pages/articleListAutor.php');
        ?>
      </section>
      <div class="p-0">
        <?php
        include('./painel/commons/footer.php');
        ?>
      </div>
    </main>
  </div>

</div>