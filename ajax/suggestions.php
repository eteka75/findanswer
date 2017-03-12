<?php

require_once('../lib/Db.php');
require_once('../lib/functions.php');
$db = connect(); /* Connexion à la base de donnée */
//$data=$db->select('entreprises','nom LIKE')

 if(isset($_GET['query'])) {
        // Mot tapé par l'utilisateur
        $q = strtolower(htmlentities($_GET['query']));
       
        // Connexion à la base de données
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
        } catch(Exception $e) {
            exit('Impossible de se connecter à la base de données.');
        }
 
        // Requête SQL
       // $requete = "SSELECT * FROM country WHERE country_name LIKE '". $q ."%' LIMIT 0, 10";
        $data=$db->select('questions',"libelle LIKE '%". $q ."%' AND id IN (SELECT question_id FROM entreprise_question)",' LIMIT 0, 10');
        // Exécution de la requête SQL
        //$resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
        $suggestions=NULL;
        // On parcourt les résultats de la requête SQL
        foreach ($data as $key => $donnees) {
            // On ajoute les données dans un tableau
            $suggestions['suggestions'][] = $donnees['libelle'];
            //$suggestions['suggestions'][] = $donnees[0];
        }
 
        // On renvoie le données au format JSON pour le plugin
        echo json_encode($suggestions);
    }
