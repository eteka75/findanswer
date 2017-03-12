
<?php
$p = 'rep';
$titre = 'Gestion des réponses aux question';
include './includes/config.php';
$db = connect();
if (isset($_SESSION['user'])) {
    $user = unserialize($_SESSION['user']);
} else {
    redirect("login.php");
}

$user = unserialize($_SESSION['user']);
$catid = $user['categorie_id'];
$uid = $user['id'];
$list_qr=$db->select('questions',"id IN (select question_id FROM entreprise_question WHERE entreprise_id='".$uid."')");
$list_questions=NULL;
if(count($list_qr)){
    $list_questions=$list_qr;
}
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
              
                if (isset($list_questions) && !(isset($_GET['id_quest']))) {

                if(count($list_questions)){

                    foreach ($list_questions as $question) {
                        ?>
                        <div class="list-question">
                        <a href="reponses.php?id_quest=<?= isset($question['id']) ? ($question['id']) : NULL ?>"><?= isset($question['libelle']) ? htmlspecialchars($question['libelle']) : NULL ?></a>
                        </div>
                        <?php
                    }
                }
                else{
                    echo "<div class='no-content text-center'><h2>Aucune proposition disponible<br><br><br><a href='add-reponse.php' class='btn1  text-mini'>Ajouter une proposition de réponse</a></div>";
                    }
            }
            if(isset($_GET['id_quest'])){
                $q_id=trim($_GET['id_quest']);
                $reponses=$db->executeSelect('entreprise_question,questions','DISTINCT entreprise_question.reponse,questions.libelle',"questions.id=entreprise_question.question_id AND (entreprise_id='".$uid."' AND question_id='".$q_id."')",'limit 1')->fetchAll();
               if(count($reponses)){
                $reponse=$reponses[0];
                ?> <h3><?=(isset($reponse['libelle']))?$reponse['libelle']:'';?></h3>
                    <p>
                        <?=(isset($reponse['reponse']))?$reponse['reponse']:'';?>
                    </p>
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

