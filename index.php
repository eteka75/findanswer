
<?php
$p = 'home';
$titre = 'Tout ce que vous recherchez sur vos entreprises';
include './includes/config.php';
include './includes/header.php';

//$db = connect(); 
//print_r($db);
$pdo= new PDO('sqlite:./db/qr.db');
print_r($pdo);
/* Connexion à la base de donnée */
//$entreprises = $db->select("entreprises", '1', 'ORDER BY created_at');
?>

<?php
include './includes/foot.php';
?>

