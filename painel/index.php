<?php

include('../config.php');

if (isset($_GET['logout'])) {
  Auth::logout();
  Painel::redirect(INCLUDE_PATH);
}

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