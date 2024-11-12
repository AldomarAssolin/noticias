<div class="nav-scroller mx-0 py-3 border-top">
    
    <nav class="nav nav-underline justify-content-between">
        <a class="nav-item nav-link link-body-emphasis active" href="home">Todos</a>
        <?php
        
        foreach(Painel::$categorias as $key => $value){
        ?>
        <a class="nav-item nav-link link-body-emphasis text-capitalize" href="?url=<?php echo $value?>"><?php echo $value?></a>
        <?php
        }
        ?>
    </nav>
</div>