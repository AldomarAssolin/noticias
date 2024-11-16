
<?php

include('./config.php');

if (isset($_GET['logout'])) {
    Auth::logout();
  }
include('./layout/layout.php');


?>
