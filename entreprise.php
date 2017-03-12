
<?php
//controle_login();
$p = 'ent';
$titre = 'Entreprise';
require_once('lib/Db.php');
require_once('./lib/functions.php');

$db = connect(); /* Connexion à la base de donnée */
if(isset($_GET['id'])){
    $ent_id=(int)trim($_GET['id']);
}
$entreprises = $db->select("entreprises", '1', 'ORDER BY created_at');
include './includes/header.php';
?>


<div id="bloc_middle">
    <div class="bloc_menu">
        <ul class="menu-onglet">
            <li class="active">
                <a href="ent-home.php">Accueil</a>
            </li>
            <li>
                <a href="compte.php">Mon compte</a>
            </li>
            <li>
                <a href="reponses.php">Mes Propositions</a>
            </li>
            <li>
                <a href="statistiques.php">Statistiques</a>
            </li>
        </ul>
    </div>
    <div class="bloc_content">
        <h4 class="page-title">Liste des Entreprise enrégistrées</h4>
        <div class="">
            <ul class="list-entreprise">
                <?php
                foreach ($entreprises as $key => $ent) {
                    $logo = (isset($ent['logo']) && $ent['logo'] != '') ? $ent['logo'] : 'uploads/default.png';
                    ?>
                    <li>
                        <span class="puce1"></span>
                        <img class="img-app" src="<?= $logo ?>" alt="<?= $ent['nom'] ?>"> <?= $ent['nom'] ?><small><?= date_fr($ent['created_at']) ?></small>

                        <div class="hiddens block text-mini text-muted pad10">
                            <b>Infos</b>
                            <div>
                                <b>Email : </b> <?= $ent['email'] ?>
                            </div>
                            <div>
                                <b>Description : </b> <?= $ent['detail'] ?>
                            </div>
                        </div>
                    </li> 
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <?php
    include './includes/foot.php';
    ?>

