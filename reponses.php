
<?php
$p = 'rep';
$titre = 'Gestion des réponses aux question';
include './includes/config.php';
$db = connect();
include './includes/header.php';
?>
<div>
    <?php
    require_once './includes/header_search.php';
    ?>
</div>
<form method="post" action="add-enterprise.php" enctype="multipart/form-data">
    <div id="bloc_middle">
        <div class="bloc_menu">
            <?php
            require_once './includes/hsmenu.php';
            ?>
        </div>
        <div class="bloc_content">
            <h3 class="page-title">Liste des réponses <small><a href="add-reponse.php" class="btn3 no-link pull-right text-mini">Ajouter une réponse</a></small></h3>

            <div>
                <?php
                if (isset($list_questions)) {
                    foreach ($list_questions as $key => $question) {
                        ?>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</form>
<?php
include './includes/foot.php';
?>

