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

function liste_emp($id_emp){
    $sql="SELECT e.last_name,e.first_name,e.emp_no FROM departments as 
    dept JOIN dept_emp as dept_e ON dept.dept_no=dept_e.dept_no 
    JOIN employees as e ON e.emp_no=dept_e.emp_no WHERE dept.dept_no= '%s' AND dept_e.to_date = '9999-01-01'";
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

?>