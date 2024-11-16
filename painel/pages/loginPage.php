

<?php

if($_GET['url'] != 'register'){
    include('pages/login.php');
}else{
    include('pages/register.php');
}


?>