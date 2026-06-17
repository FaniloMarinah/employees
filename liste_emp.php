<?php
include('fonctions.php');
session_start();
if(!isset($_SESSION['offset'])){
    $_SESSION['offset']=0;
}
if(!isset($_SESSION['page'])){
    $_SESSION['page']=20;
}
if(!isset($_SESSION['precedent'])){
    $_SESSION['precedent']=0;
}
if(isset($_GET['id_dept'])){
    $_SESSION['id_dept']=$_GET['id_dept'];
}
if(isset($_SESSION['id_dept'])){
    $id_emp=$_SESSION['id_dept'];
}
else{
    $id_emp='';
}
$liste_e=liste_emp($_SESSION['id_dept'],$_SESSION['offset'],$_SESSION['page']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
        <?php for ($i=0; $i < count($liste_e); $i++) { ?>
            <li><a href="fiche_emp.php?id_emp=<?php echo $liste_e[$i]['emp_no'] ?>"><?php echo $liste_e[$i]['last_name'] . ' ' . $liste_e[$i]['first_name']?></a></li>
        <?php    } ?>
    </ul>
    <?php   
    if($_SESSION['offset']>0){  ?>
    <a href="traitement_emp.php?action=precedent">precedent</a>
    <?php    } ?>
    <p><a href="traitement_emp.php?action=suivant">suivant</a></p>
</body>
</html>