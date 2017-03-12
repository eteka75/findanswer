
<?php
$p = 'rep';
$titre = 'Ajout de réponse';
include './includes/config.php';
$db = connect();
$reponses_get=$db->select('entreprise_question');
if (!isset($_SESSION['user'])) {
    redirect("login.php");
}
$user = unserialize($_SESSION['user']);
$uid = $user['id'];
if (!isset($_SESSION['user'])) {
    redirect("login.php");
}
if (isset($_POST['add-rep'])) {
    $is_valide = TRUE;
    extract($_POST);
   // echo $typequestion;
    if (intval($typequestion) <= 0) {
        $error[] = "Veuillez choisir un type de question valide";
        $is_valide = FALSE;
    }
    if (intval($question) <= 0) {
        $error[] = "Veuillez choisir une question";
        $is_valide = FALSE;
    }
    if (strlen($contenu) <= 50) {
        $error[] = "La réponse à la question n'est pas valide (au moins 50 caractères)";
        $is_valide = FALSE;
    }
    if ($is_valide) {
        $logo = isset($_FILES['logo']['name']) ? Telecharger('logo', "uploads", 50) : '';
        $qr = array(
            'entreprise_id' => $uid,
            'question_id' => $question ,           
            'type_id' => $typequestion,
            'reponse' => $contenu            
        );
        try {
            $db->insert('entreprise_question', $qr); /* insertion dans la table */
            unset($_POST);
            return redirect('add-reponse.php');
        } catch (Exception $exc) {

            echo $exc->getTraceAsString(); /* Affichage d'erreur */
        }
    }
}
$user = unserialize($_SESSION['user']);
$cat_ent = $user['categorie_id'];
$uid = $user['id'];
$qests = $db->select('question_categorie,questions', "question_categorie.categorie_id='" . $cat_ent . "' AND questions.id=question_categorie.question_id");
$qests = $db->select('questions', "questions.id IN (SELECT question_id FROM question_categorie WHERE  question_categorie.categorie_id='" . $cat_ent . "')");

$questions = "";
foreach ($qests as $key => $mq) {
    $selected = (isset($question) && $question == $mq['id']) ? 'selected' : '';
    $questions .= "<option $selected value='" . $mq['id'] . "'>" . $mq['libelle'] . "</option>";
}
$typesq = '';
$typesquest = $db->select("types", "ent_id='" . $uid . "'");
$typeq = "";
foreach ($typesquest as $key => $tp) {
    $selected = (isset($question) && $question == $mq['id']) ? 'selected' : '';
    $typesq .= "<option $selected value='" . $tp['id'] . "'>" . $tp['nom'] . "</option>";
}
include './includes/header.php';
?>
<div>
    <?php
    require_once './includes/header_search.php';
    ?>
</div>
<form method="post" action="add-reponse.php" enctype="multipart/form-data">
    <div id="bloc_middle">
        <div class="bloc_menu">
            <?php
            require_once './includes/hsmenu.php';
            ?>
        </div>
        <div class="bloc_content">
            <h3 class="page-title">Ajout d'une réponse</h3>
            <div>
                <div>
                    <?php
                    if (isset($error) && $is_valide != TRUE) {
                        echo '<div class="error"><ul>';
                        foreach ($error as $e) {
                            echo "<li>" . $e . "</li>";
                        }
                        echo '</ul></div>';
                    }
                    ?>
                </div>
                <fieldset>
                    <legend>Ajout d'une réponse</legend>

                    <div class="bloc_middle text-left">
                        <div>
                        <a href="add-type.php" class="text-mini pull-rights">Ajouter un type</a>
                            <label class="text-mini">Type de réponse</label>
                            <div class="text-rights pad">

                                
                            </div>
                            
                            <select  name="typequestion" class="input-std control" >
                                <option value="">-Sélectionnez-</option>
                                <?= isset($typesq) ? $typesq : ''; ?>
                            </select>
                        </div>
                        <div>
                        <a href="add-question.php" class="text-mini pull-rights">Ajouter une question</a>
                            <label class="text-mini">Sélectionnez la question</label>
                            <select  name="question" class="input-std control" >
                                <option value="">-Sélectionnez-</option>
                                <?= isset($questions) ? $questions : ''; ?>
                            </select>
                        </div>

                        <div>
                            <label class="text-mini pad5_0">Réponse à la question</label>
                            <textarea class="input-std control" rows="4" cols="31"  placeholder="Réponse à la question sélectionnée" name="contenu" ><?= isset($contenu) ? $contenu : NULL; ?></textarea>
                        </div>
                        <div>

                            <input  class="btn1" name="add-rep" type="submit" value="Enrégistrer" >
                            <hr class="mhr">
                            <a href="index.php" class="">Retour à l'accueil</a>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</form>
<!-- Include Editor style. -->
<link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.0/css/froala_editor.min.css' rel='stylesheet' type='text/css' />
<link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.0/css/froala_style.min.css' rel='stylesheet' type='text/css' />

<!-- Include JS file. -->
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.0/js/froala_editor.min.js'></script>

<script>
    $(function () {
        $('textarea').froalaEditor({
            toolbarButtons: ['undo', 'redo', '|', 'fontSize', 'insertImage', 'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', 'outdent', 'indent', 'clearFormatting', 'insertTable', 'html'],
            toolbarButtonsXS: ['undo', 'redo', '-', 'bold', 'italic', 'underline']
        });
    });</script>
<?php
include './includes/foot.php';
?>

