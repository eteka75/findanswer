
<?php
$p = 'compt';
$titre = "Tableau de bord";
require_once('lib/Db.php');
require_once('./lib/functions.php');
//controle_login();
$db = connect(); /* Connexion à la base de donnée */
$entreprises = $db->select("entreprises", '1', 'ORDER BY created_at');
$user = NULL;

if (isset($_SESSION['user'])) {
    $user = unserialize($_SESSION['user']);
} else {
    redirect("/");
}
include './includes/header.php';
?>
<div>
    <?php
    require_once './includes/header_search.php';
    ?>
</div>
<div id="bloc_middle">
    <div class="bloc_menu">
        <?php
        require_once './includes/hsmenu.php';
        ?>
    </div>
    <div class="bloc_content">
        <h3 class="page-title">Mon compte </h3>
        <div class="pad10"><small><a href="update-compte.php" class="btn1 no-link pull-right text-mini">Modifier mon compte</a></small></div>
        <?php
          $logo = (isset($user['logo']) && trim($user['logo']) != '') ? $user['logo'] : 'uploads/default.jpeg';
        ?>


        <div class="text-mini">
            <h3 class="">
                <img class="img-logo-home text-mini" src="<?= ($logo) ?>" alt="<?= $user['nom'] ?>">

                <?php
                print($user['nom']);
                $idcat = isset($user['categorie_id']) ? $user['categorie_id'] : 0;
                $categ = $db->selectOne('categories', "id='" . $idcat . "'");
                //print_r($categ);
                $nomcat = '';
                if (count($categ)) {
                    $nomcat = ($categ["nom"]);
                }
                ?>
            </h3>
            <br>
            <div class="has-shadow white-card">

                <table class="m-table">
                    <tbody>

                        <tr>
                            <td class="text-muted bold" width='100px'> Catégorie :</td>
                            <td class="" > <?= isset($nomcat) ? $nomcat : '' ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted bold" width='100px'> Email :</td>
                            <td class="" > <?= isset($user['email']) ? $user['email'] : '' ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted bold" width='100px'> Date d'inscription :</td>
                            <td class="" > <?= isset($user['created_at']) ? date_fr($user['created_at']) : '' ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted bold" width='100px'> Détail  :</td>
                            <td class="" > <?= isset($user['detail']) ? $user['detail'] : '' ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<?php
include './includes/foot.php';
?>

