<?php
include('fonction.php');
session_start();
if($_GET['action']=='suivant'){
    $_SESSION['offset']+=20;
}
elseif ($_GET['action']=='precedent') {
    if($_SESSION['offset']>=20){
        $_SESSION['offset']-=20;
    }
}
header('location:liste_emp.php');
?>
