<div class="nav-scroller py-3 border-top">
    <?php
    if(isset($_GET['categoria'])){
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_site.artigos` WHERE categoria = ?");
        $sql->execute(array($_GET['categoria']));
        $categoria = $sql->fetchAll();
    }
    ?>
    <nav class="nav nav-underline justify-content-between">
        <?php
        
        foreach(Painel::$categorias as $key => $value){
        ?>
        <a class="nav-item nav-link link-body-emphasis" href="#"><?php echo $value?></a>
        <?php
        }
        ?>
    </nav>
</div>