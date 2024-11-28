<div class="position mx-0" style="top: 2rem;">
  <div class="p-4 mb-3 bg-body-tertiary shadow rounded">
    <a href="<?php echo INCLUDE_PATH ?>about" class="text-decoration-none text-body-secondary">
      <h4 class="fst-italic">Sobre este BLOG</h4>
      <p class="mb-0">
        Nosso objetivo é fornecer conteúdo relevante, confiável e acessível, abordando assuntos que tocam a vida das pessoas. Aqui você encontra notícias, a
        nálises, dicas e muito mais, sempre com um olhar crítico e informativo. Seja bem-vindo(a) ao nosso blog!
      </p>
    </a>
  </div>

  <!-- Noticias recentes -->
   <?php
   
   include('./components/noticias.php');
   
   ?>
  <!-- Noticias recentes -->

  <!-- Artigos menaslmente -->
   <?php
   
   include('./components/artigos_mensal.php');
   
   ?>
  
  <!-- Artigos mensalmente -->
  

  <!--Redes - Sociais-->
  <div class="p-4">
    <h4 class="fst-italic">Elsewhere</h4>
    <ol class="list-unstyled">
      <li><a href="#">GitHub</a></li>
      <li><a href="#">Twitter</a></li>
      <li><a href="#">Facebook</a></li>
    </ol>
  </div>
  <!--Redes - Sociais-->
</div>