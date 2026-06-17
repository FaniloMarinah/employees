<?php
include('fonctions.php');
$id_emp=$_GET['id_emp'];
$fiche=fiche_emp($id_emp);
$salaries=post_salaries($id_emp);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border=1>
    <tr>
        <td>ID_EMPLOYE</td>
        <td><?php echo $fiche['emp_no']?></td>
    </tr>
    <tr>
        <td>BIRTH_DATE</td>
        <td><?php echo $fiche['birth_date']?></td>
    </tr>
    <tr>
        <td>FIRST_NAME</td>
        <td><?php echo $fiche['first_name']?></td>
    </tr>
    <tr>
        <td>LAST_NAME</td>
        <td><?php echo $fiche['last_name']?></td>
    </tr>
    <tr>
        <td>SEX</td>
        <td><?php echo $fiche['gender']?></td>
    </tr>
    <tr>
        <td>HIRE_DATE</td>
        <td><?php echo $fiche['hire_date']?></td>
    </tr>
    </table>
    <table border=1>
        <tr>
            <td>POSTE</td>
            <td>DEBUT CONTRAT</td>
            <td>FIN CONTRAT</td>
            <td>SALAIRE</td>
        </tr>
<?php for ($i=0; $i < count($salaries); $i++) { ?>
        <tr>
            <td><?php echo $salaries[$i]['title']?></td>
            <td><?php echo $salaries[$i]['from_date']?></td>
            <td><?php echo $salaries[$i]['to_date']?></td>
            <td><?php echo $salaries[$i]['salary']?></td>
        </tr>
        <?php   } ?>
    </table>
</body>
</html>