
<?php
$p = 'ent-h';
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
        <?php
        $logo = (isset($user['logo']) && $user['logo'] != '') ? $user['logo'] : 'uploads/default.png';
        ?>
        <!--h4 class="page-title ">
            <img class="img-logo-home text-mini" src="<?= ($logo) ?>" alt="<?= $user['nom'] ?>">

            <?php
            
            $idcat = isset($user['categorie_id']) ? $user['categorie_id'] : 0;
            $categ = $db->selectOne('categories', "id='" . $idcat . "'");
            //print_r($categ);
            $nomcat = '';
            if (count($categ)) {
                $nomcat = utf8_encode($categ["nom"]);
            }
             $user_id=$user['id'];
            $my_reponses=$db->executeSelect('entreprise_question',"count(id_question) as nb_questions","id_entreprise='".$user_id."'")->fetch();
            $reponses=($my_reponses['nb_questions']);
             $user_id=$user['id'];
             
            $my_suggest=$db->executeSelect('suggestion_questions',"count(id) as nb_sug","entreprise_id='".$user_id."'")->fetch();
            $suggest=($my_suggest['nb_sug']);
            ?>
        </h4-->
        
        <h4 class="page-title ">Tableau de board <small class="text-mini text-muted pull-rights">(<?php print($user['nom']);?>)</small></h4>
        <div class="text-mini">
            <div>
                <h4 class="pad0 text-muted">Activités</h4>
                <table class="w100">
                    <tbody>
                        <tr>
                            <td class="text-muted bold text-center" >
                                <div class="white-card">
                                    <div class="number">
                                        <h1><a class="no-link" href="reponses.php"><?=($reponses)?></a></h1>
                                        <p><a  class="no-link" href="suggestions.php">Réponses</a></p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted bold text-center" >
                                <div class="white-card">
                                    <div class="number">
                                        <h1><a class="no-link" href="reponses.php"><?=($suggest)?></a></h1>
                                        <p><a  class="no-link" href="reponses.php">Suggestions</a></p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include './includes/foot.php';
?>

