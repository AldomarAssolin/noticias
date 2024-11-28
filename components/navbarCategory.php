<!-- Navbar de categorias -->
<div class="nav-scroller p-3 shadow mt-3">
    <nav class="nav nav-underline">
        <a class="nav-item nav-link link-body-emphasis active" href="home">Todos</a>
        <?php
        $categorias_artigo = Categorias::listarCategorias();
        foreach($categorias_artigo as $key => $value){
        ?>
        <a class="nav-item nav-link link-body-emphasis text-capitalize" href="?url=<?php echo $value?>"><?php echo $value['nome']?></a>
        <?php
        }
        ?>
    </nav>
</div>
<!-- Navbar de categorias -->
