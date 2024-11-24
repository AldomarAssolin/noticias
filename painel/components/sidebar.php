<?php
//Objetivo: Sidebar para o painel de controle

$perfil = Perfil::viewUsuarioPerfil($_SESSION['id']);


$imagem = INCLUDE_PATH . 'static/uploads/avatar.jpg';

?>

<div class="sidebar border border-right p-0">
  <div class="offcanvas-md offcanvas-end   overflow-y-auto" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="sidebarMenuLabel"><?php echo $_SESSION['nome'] ?></h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
    </div>

    <section class="user shadow">
      <div class="d-flex flex-column align-items-center text-center p-3">
        <a href="<?php echo INCLUDE_PATH ?>perfil_usuario?usuario=<?php echo $_SESSION['id'] ?>" title="Ir para perfil"><img class="rounded-circle img-thumbnail" width="120" height="120" src="<?php echo $perfil['avatar'] ?? $imagem ?>" alt="Imagem do perfil"></a>
        <div class="mt-3">
          <h4><?php echo $perfil['nome'] ?? $_SESSION['user'] ?></h4>
          <p class="text-secondary mb-1"><?php echo pegaCargo($_SESSION['cargo']) ?></p>
        </div>
      </div>
    </section>

    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3">
      <div class="nav-item px-3 py-2 shadow hover">
        <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="<?php echo INCLUDE_PATH_PAINEL ?>">
          <svg class="bi">
            <use xlink:href="#house-fill" />
          </svg>
          Página Inicial
        </a>
      </div><!-- nav-item -->

      <div class="accordion accordion-flush my-2" id="accordionFlushExample">
        <!-- Cadastros -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                <span>CADASTRO</span>
              </h6>
            </button>
          </h2>
          <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body px-0">
              <ul class="nav flex-column">
                <li class="nav-item shadow">
                  <a class="nav-link d-flex align-items-center gap-2" href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar_slides">
                    <svg class="bi">
                      <use xlink:href="#file-earmark" />
                    </svg>
                    Slides
                  </a>
                </li>
                <li class="nav-item shadow">
                  <a class="nav-link d-flex align-items-center gap-2" href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar_sobre">
                    <svg class="bi">
                      <use xlink:href="#file-earmark" />
                    </svg>
                    Sobre
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Gestão -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                <span>GESTÃO</span>
              </h6>
            </button>
          </h2>
          <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body px-0">
              <ul class="nav flex-column">
                <li class="nav-item shadow">
                  <a class="nav-link d-flex align-items-center gap-2" href="<?php echo INCLUDE_PATH_PAINEL ?>lista_slides">
                    <svg class="bi">
                      <use xlink:href="#file-earmark" />
                    </svg>
                    Listar Slides
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Administração -->
        <div <?php permissaoPagina(2) ?> class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                <span>ADMINISTRAÇÃO</span>
              </h6>
            </button>
          </h2>
          <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body px-0">
              <ul class="nav flex-column">
                <li class="nav-item shadow">
                  <a class="nav-link d-flex align-items-center gap-2" href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar_usuario">
                    <svg class="bi">
                      <use xlink:href="#people" />
                    </svg>
                    Adicionar Usuários
                  </a>
                </li>
                <li class=" nav-item shadow">
                  <a class="nav-link d-flex align-items-center gap-2" href="<?php INCLUDE_PATH_PAINEL ?>lista_usuarios">
                    <svg class="bi">
                      <use xlink:href="#people" />
                    </svg>
                    Gerenciar Usuários
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Gestão de Conteúdo -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                <span>Gestão de Conteúdo</span>
              </h6>
            </button>
          </h2>
          <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body px-0">
              <ul class="nav flex-column">
                <li class="nav-item shadow">
                  <a class="nav-link d-flex align-items-center gap-2" href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar_artigo">
                    <svg class="bi">
                      <use xlink:href="#file-earmark" />
                    </svg>
                    Adicionar Conteúdo
                  </a>
                </li>
                <li class="nav-item shadow">
                  <a class="nav-link d-flex align-items-center gap-2" href="<?php echo INCLUDE_PATH_PAINEL ?>lista_artigos">
                    <svg class="bi">
                      <use xlink:href="#file-earmark" />
                    </svg>
                    Gerenciar Conteúdo
                  </a>
                </li>
                <li class="nav-item shadow">
                  <a class="nav-link d-flex align-items-center gap-2" href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar_categoria">
                    <svg class="bi">
                      <use xlink:href="#file-earmark" />
                    </svg>
                    Adicionar Categoria
                  </a>
                </li>
                <li class="nav-item shadow">
                  <a class="nav-link d-flex align-items-center gap-2" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar_categorias">
                    <svg class="bi">
                      <use xlink:href="#file-earmark" />
                    </svg>
                    Gerenciar Categoria
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div><!-- accordion -->

      <hr class="my-3">

      <ul class="nav flex-column mb-auto">
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2" href="<?php echo INCLUDE_PATH_PAINEL ?>?loggout">
            <svg class="bi">
              <use xlink:href="#gear-wide-connected" />
            </svg>
            Settings
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2" href="<?php echo INCLUDE_PATH_PAINEL ?>?logout">
            <svg class="bi">
              <use xlink:href="#door-closed" />
            </svg>
            Sair
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>