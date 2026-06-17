<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include("fonctions.php");
    $departments=liste_departement();
    ?>
    <table>
        <tr>
        <th>Numero</th>
        <th>Nom departement</th>
        <th>Nom manager</th>
        <?php for ($i=0; $i < count($departments); $i++) { ?>
            <tr>
                <td><?php echo $departments[$i]['dept_no']; ?></td>
                <td><a href="liste_emp.php?id_dept=<?php echo $departments[$i]['dept_no']; ?>"><?php echo $departments[$i]['dept_name']; ?></a></td>
                <td><?php echo $departments[$i]['last_name'] . " " . $departments[$i]['first_name']; ?></td>
            </tr>
        <?php   }?>
        </tr>
    </table>
</body>
</html>