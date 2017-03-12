
<?php
$p = 'rep';
$titre = 'Ajout de questions';
include './includes/config.php';
$db = connect();
$categorie_id = 1;
$list_quests = $db->select('categories', "1", 'ORDER BY nom');
if (isset($_SESSION['user'])) {
    $user = unserialize($_SESSION['user']);
} else {
    redirect("login.php");
}
$listquest = '';

$error = NULL;
if (isset($_POST['add-quest'])) {
    $donnes = extract($_POST);
    //print_r($_POST);
    $quest_cat = isset($_POST['quest_cat']) ? $_POST['quest_cat'] : array();


    if (!is_array($quest_cat)) {
        $error[] = 'Veuillez sélectionner une catégorie';
    }
    if (count($quest_cat) <= 0) {
        $error[] = 'Veuillez sélectionner une catégorie';
    }
    if (strlen($question) <= 10 || strlen($question) > 250) {
        $error[] = 'Veuillez saisir votre réponse(entre 10 et 250 caractères)';
    }
    $search_q = $db->select('questions', "libelle='" . $question . "'", 'limit 1');
    if (count($search_q) > 0) {
        $error[] = 'Cette question existe déjà. Merci de saisir une nouvelle question';
    }
    $quest = array(
        'libelle' => $question
    );
    if ($error == NULL) {
        $id_question = 0;
        $id_question = 5;
        try {
            $db->insert('questions', $quest);
            $id_question = $db->lastInsertId();
        } catch (Exception $exc) {
            echo "<hr>" . $exc->getTraceAsString();
        }
        if ($id_question > 0) {
            $Tab_question = $quest_cat;
             $nb = count($Tab_question);
            $i = 1;
            $data='';
            foreach ($Tab_question as $key => $qid) {
                if ($i == $nb) {
                    $data .= "($id_question,$qid,'" . date('Y-m-d H:i:s') . "')";
                } else {
                    $data .= "($id_question,$qid,'" . date('Y-m-d H:i:s') . "'), ";
                }
                $i++;
                //echo 'Super<br>';
                //echo $qid."<br>";
            }
            $query = ("INSERT INTO question_categorie(question_id,categorie_id,created_at) VALUES $data");
            $datad = $db->query($query);
        //exit();
            /*
             *  try {
              print_r($cat_q);
              $db->insert('question_categorie', $cat_q);
              //                    $id_question = $db->lastInsertId();
              } catch (Exception $exc) {
              echo "<hr>" . $exc->getTraceAsString();
              }
             */
            redirect('add-question.php');
        }
    }
}
if (isset($list_quests)) {
    foreach ($list_quests as $cat) {
        $selected = (isset($quest_cat,$cat['id']) && in_array($cat['id'], $quest_cat)) ? 'selected' : '';
        
        $listquest .= "<option $selected value='" . $cat['id'] . "'>" . $cat['nom'] . "</option>";
    }
}
include './includes/header.php';
?>
<div>
<?php
require_once './includes/header_search.php';
?>
</div>
<form method="post" action="add-question.php" enctype="multipart/form-data">
    <div id="bloc_middle">
        <div class="bloc_menu">
<?php
require_once './includes/hsmenu.php';
?>
        </div>
        <div class="bloc_content">
            <h3 class="page-title">Ajout d'une question</h3>
            <div>
                <fieldset>
                    <legend>Ajout d'une question</legend>

                    <div class="bloc_middle text-left">
                        <div>
<?php
if (isset($error) && count($error) > 0) {
    echo '<div class="error"><ul>';
    foreach ($error as $e) {
        echo "<li>" . $e . "</li>";
    }
    echo '</ul></div>';
}
?>
                        </div>
                        <div>
                            <label class="text-mini">Sélectionnez la catégorie d'entreprise</label>
                            <select  name="quest_cat[]" class="input-std control select2" multiple="true" >
<?php
echo isset($listquest) ? $listquest : '';
?>
                            </select>
                        </div>

                        <div>
                            <label class="text-mini">Question à poser </label>
                            <textarea class="input-std control " rows="4" cols="31"  placeholder="Réponse à la question sélectionnée" name="question" ><?= isset($question) ? $question : NULL; ?></textarea>
                        </div>
                        <div>

                            <input  class="btn1 " name="add-quest" type="submit" value="Enrégistrer" >
                            <hr class="mhr">
                            <a href="index.php" class="">Retour à l'accueil</a>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</form>

<link href="assets/css/select2.min.css" rel="stylesheet" />
<script src="assets/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".select2").select2();
    });
</script>
<?php
include './includes/foot.php';
?>

