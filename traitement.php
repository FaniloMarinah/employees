<?php
include('fonctions.php');

$departement = trim($_POST['departement'] ?? '');
$nom         = trim($_POST['nom']         ?? '');
$age_min     = trim($_POST['age_min']     ?? '');
$age_max     = trim($_POST['age_max']     ?? '');

$resultats = rechercherEmployes($departement, $nom, $age_min, $age_max);

if (empty($resultats)) {
    echo "<p>Aucun employé trouvé.</p>";
} else {
    echo "<table border='1'>";
    echo "<tr>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Département</th>
            <th>Âge</th>
          </tr>";

    foreach ($resultats as $employe) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($employe['first_name']) . "</td>";
        echo "<td>" . htmlspecialchars($employe['last_name'])  . "</td>";
        echo "<td>" . htmlspecialchars($employe['dept_name'])  . "</td>";
        echo "<td>" . htmlspecialchars($employe['age'])        . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}
?>