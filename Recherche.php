<?php
include('fonctions.php');
$age_min_max=min_max();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="traitement.php" method=post>
        <div><label for="departement">Departement : </label><input type="text" name="departement"></div>
        <div><label for="nom">Nom : </label><input type="text" name="nom"></div>
        <div><label for="age">Age : </label><input type="number" name="age_min" MIN=<?php echo $age_min_max['age_min']?> MAX=<?php echo $age_min_max['age_max']?>></div>
        <div><label for="age">Age : </label><input type="number" name="age_max" MIN=<?php echo $age_min_max['age_min']?> MAX=<?php echo $age_min_max['age_max']?>></div>

        <button type="submit">Rechercher</button>
    </form>
</body>
</html>