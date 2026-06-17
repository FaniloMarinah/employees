<?php
function dbconnect(){
    static $connect =null;
    if ($connect===null) {
        $connect=mysqli_connect('localhost','root','','employees');
        if (!$connect) {
            die('Erreur de connexion a la base de donnees : ' . mysqli_connect_error());
        }
        mysqli_set_charset($connect, 'utf8mb4');
    }
    return $connect;
}

function liste_departement(){
    $sql="SELECT dept.dept_no,dept.dept_name,e.last_name,e.first_name 
    FROM departments as dept JOIN dept_manager as dept_m ON 
    dept.dept_no=dept_m.dept_no JOIN employees as e ON 
    e.emp_no=dept_m.emp_no WHERE dept_m.to_date = '9999-01-01'";
    $resultat=mysqli_query(dbconnect(),$sql);
    $tableau=array();
    while ($donne=mysqli_fetch_assoc($resultat)) {
        $tableau[]=$donne;
    }
mysqli_free_result($resultat);
return $tableau;
}

function liste_emp($id_emp,$offset,$page){
    $sql="SELECT e.last_name,e.first_name,e.emp_no FROM departments as 
    dept JOIN dept_emp as dept_e ON dept.dept_no=dept_e.dept_no 
    JOIN employees as e ON e.emp_no=dept_e.emp_no WHERE dept.dept_no= '%s' AND dept_e.to_date = '9999-01-01' 
    LIMIT $offset , $page";
    $sql=sprintf($sql, $id_emp);
    $resultat=mysqli_query(dbconnect(),$sql);
    $tableau=array();
    while ($donne=mysqli_fetch_assoc($resultat)) {
        $tableau[]=$donne;
    }
mysqli_free_result($resultat);
return $tableau;
}

function fiche_emp($id_emp){
    $sql="SELECT * FROM employees AS e WHERE e.emp_no = %d";
    $sql=sprintf($sql, $id_emp);
    $resultat=mysqli_query(dbconnect(),$sql);
    $donne=mysqli_fetch_assoc($resultat);
mysqli_free_result($resultat);
return $donne;
}

function post_salaries($id_emp){
    $sql="SELECT t.title,t.from_date,t.to_date,s.salary FROM
    titles AS t JOIN salaries AS s ON t.emp_no=s.emp_no WHERE t.emp_no = %d";
    $sql=sprintf($sql, $id_emp);
    $resultat=mysqli_query(dbconnect(),$sql);
    $tableau=array();
    while ($donne=mysqli_fetch_assoc($resultat)) {
        $tableau[]=$donne;
    }
mysqli_free_result($resultat);
return $tableau;
}

function min_max(){
    $sql="SELECT MIN(TIMESTAMPDIFF(YEAR,birth_date,CURDATE())) AS age_min,
    MAX(TIMESTAMPDIFF(YEAR,birth_date,CURDATE())) AS age_max FROM employees";
    $resultat=mysqli_query(dbconnect(),$sql);
    $donne=mysqli_fetch_assoc($resultat);
mysqli_free_result($resultat);
return $donne;
}

function rechercherEmployes($departement, $nom, $age_min, $age_max) {
    $conn = dbconnect();

    $sql = "SELECT e.*, d.dept_name,
                TIMESTAMPDIFF(YEAR, e.birth_date, CURDATE()) AS age
            FROM employees e
            LEFT JOIN dept_emp de ON e.emp_no = de.emp_no
            LEFT JOIN departments d ON de.dept_no = d.dept_no
            WHERE 1=1";

    $params = [];
    $types  = "";

    if (!empty($departement)) {
        $sql     .= " AND d.dept_name LIKE ?";
        $params[] = "%$departement%";
        $types   .= "s";
    }

    if (!empty($nom)) {
        $mots       = explode(" ", trim($nom));
        $conditions = [];

        foreach ($mots as $mot) {
            $motRecherche  = "%$mot%";
            $conditions[]  = "(e.first_name LIKE ? OR e.last_name LIKE ?)";
            $params[]      = $motRecherche;
            $params[]      = $motRecherche;
            $types        .= "ss";
        }

        $sql .= " AND (" . implode(" AND ", $conditions) . ")";
    }

    if (!empty($age_min) && !empty($age_max)) {
        $sql     .= " AND TIMESTAMPDIFF(YEAR, e.birth_date, CURDATE()) BETWEEN ? AND ?";
        $params[] = (int)$age_min;
        $params[] = (int)$age_max;
        $types   .= "ii";

    } elseif (!empty($age_min)) {
        $sql     .= " AND TIMESTAMPDIFF(YEAR, e.birth_date, CURDATE()) >= ?";
        $params[] = (int)$age_min;
        $types   .= "i";

    } elseif (!empty($age_max)) {
        $sql     .= " AND TIMESTAMPDIFF(YEAR, e.birth_date, CURDATE()) <= ?";
        $params[] = (int)$age_max;
        $types   .= "i";
    }

    $stmt = mysqli_prepare($conn, $sql);

    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    mysqli_stmt_execute($stmt);
    $resultat = mysqli_stmt_get_result($stmt);

    $tableau = [];
    while ($donne = mysqli_fetch_assoc($resultat)) {
        $tableau[] = $donne;
    }

    mysqli_free_result($resultat);
    return $tableau;
}
?>