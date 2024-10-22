<?php

include('../config.php');



if (Painel::logado() == false) {
  include('pages/login.php');
} else {
  include('layout/layout.php');
}


?>