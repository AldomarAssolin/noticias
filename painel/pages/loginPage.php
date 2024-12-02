

<?php

if(isset($_GET['url']) && $_GET['url'] != 'register'){
    include('pages/login.php');
}else{
    include('pages/register.php');
}


?>