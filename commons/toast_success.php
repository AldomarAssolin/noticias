<!-- Toasts -->
<div class="bd-example-snippet bd-code-snippet">
    <div class="bd-example m-0 border-0 w-25 p-5 align-items-center">
        <div class="alert bg-success p-2 border rounded-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="./assets/images/perfil.jpg" alt="" width="20" height="20" class="rounded-circle me-2">
                <strong class="me-auto">Olá, Aldomar Assolin!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?php 
                
                if(!isset($mensagem)){
                    echo $mensagem;
                }elseif(!isset($erro)){
                    echo $erro;
                }

                ?>
            </div>
        </div>
    </div>
</div>
<!-- Toasts -->