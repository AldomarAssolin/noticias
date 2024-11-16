<?php

include('../config.php');


  // Verifica se o usuário está logado
  if (Painel::logado() == false) {
    include('pages/loginPage.php');
  } else {
    if($_SESSION['cargo'] >= 1){
    include('layout/layout.php');
  }else{
    Painel::redirect(INCLUDE_PATH);
  }
  }



?>