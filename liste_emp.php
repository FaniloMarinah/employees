<?php
include('fonctions.php');
$id_emp=$_GET['id_dept'];
$liste_e=liste_emp($id_emp);
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
</body>
</html>