<?php
$VisitasDoDia = Painel::VisitasDoDia();
$nome = Perfil::listarPerfilNomeAvatar($_SESSION['id']);

?>

<section class="card-painel bg-body-tertiary shadow">
    <div class="p-2">
        <h6 class="d-flex justify-content-start align-items-center mt-4 mb-3 text-body-secondary border-bottom">
            <svg class="bi">
                <use xlink:href="#house-fill" />
            </svg>
            <span class="mx-2 lead">Painel de Controle - <strong><?php echo $nome['nome'] ?? $_SESSION['user'] ?></strong
            ></span>
        </h6>
        <div class="d-md-flex flex-wrap align-itens-center justify-content-center justify-content-lg-between py-3 gap-2">
            <div class="card text-bg-success m-auto m-md-0 w-card rounded-none">
                <div class="card-header">
                    <h2>Usuários Online</h2>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo count($usuariosOnline)?></h5>
                </div>
            </div>
            <div class="card text-bg-tertiary m-auto m-md-0 my-3 my-md-0 w-card">
                <div class="card-header">
                    <h2>Total de Visitas</h2>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $totalDeVisitas?></h5>
                </div>
            </div>
            <div class="card text-bg-primary m-auto m-md-0 w-card">
                <div class="card-header">
                    <h2>Visitas Hoje</h2>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $VisitasDoDia?></h5>
                </div>
            </div>
        </div>
    </div>
</section>