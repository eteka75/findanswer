
<?php
$p = 'rep';
$titre = 'Gestion des réponses aux question';
include './includes/header.php';
?>
<div class="bloc_search_head">
    <form method="GET" action="search.php">
        <div id="bloc_head_search">
            <div class="bloc_logo1"> 
                <a href="index.php"><img id="mini-logo" src="./assets/images/FindAnswer_All.png" alt="Find Answers"></a>
            </div>
            <div class="bloc_head_right text-right">

                <?php
                if (isset($_SESSION['user'], $_SESSION['id'])) {

                    $db = connect();


                    $user = unserialize($_SESSION['user']);
                    echo "<b>" . $user['nom'] . "</b>";
                    $categorie_id = $user['categorie_id'];
                    $recup_categ = $db->selectOne('categories', "id='" . $categorie_id . "'");
                    $categorie = '';
                    $categorie_id = 0;
                    if (count($recup_categ)) {
                        $categorie = $recup_categ['nom'];
                        $categorie_id = $recup_categ['id'];
                    }
                    ?>
                    <ul class='menu-login no-link  inline fright'>
                        <li><a href="categories.php?id=<?= (isset($categorie_id) ? $categorie_id : ''); ?>"><?= (isset($categorie) ? $categorie : ''); ?></a></li>
                        <li><a  class=" text-mini" href="logout.php">Déconnexion</a></li>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div>
    </form>
</div>
<form method="post" action="add-enterprise.php" enctype="multipart/form-data">
    <div id="bloc_middle">
        <div class="bloc_menu">
            <?php
            require_once './includes/hsmenu.php';
            ?>
        </div>
        <div class="bloc_content">
            <h3 class="page-title">Liste des suggestions <small><a href="add-reponse.php" class="btn3 no-link pull-right text-mini">Ajouter une réponse</a></small></h3>
        
            <div>

            </div>
        </div>
    </div>
</form>
<?php
include './includes/foot.php';
?>

