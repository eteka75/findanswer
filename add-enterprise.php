
<?php
$p = 'add-ent';
$titre = 'Inscription des entreprises';
require_once('lib/Db.php');
require_once('./lib/functions.php');
$db = connect(); /* Connexion à la base de donnée */

$error = NULL;
//print_r($categ);
if (isset($_POST['add-ent'])) {/* Traitement du formulaire */
    $is_valide = TRUE;
    $d = extract($_POST); /* extraction des données du formulaire */
    $logo = isset($_FILES['logo']['name']) ? $_FILES['logo']['name'] : '';
    if (strlen($name) <= 2 || strlen($name) > 250) {
        $error[] = "Le nom de l'entrprise n'est pas valide (entre 3 et 250 caractères)";
        $is_valide = FALSE;
    }
    if (intval($cat_id) <= 0) {
        $error[] = $cat_id . "La catégorie n'est pas valide";
        $is_valide = FALSE;
    }
    if (trim($password) != trim($password_confirmation)) {
        $error[] = "Veuillez confirmer le mot de passe";
        $is_valide = FALSE;
    }
    if (strlen($password) <= 4 || strlen($password) > 30) {
        $error[] = "Le mot de passe doit être compris entre 4 et 30 caractères";
        $is_valide = FALSE;
    }

    if ($is_valide) {
        $logo = isset($_FILES['logo']['name']) ? Telecharger('logo', "uploads", 50) : '';
        $ent1 = array(
            'nom' => $name,
            'logo' => $logo,
            'email' => $email,
            'detail' => $description,
            'categorie_id' => $cat_id,
            'created_at' => date("Y-m-d H:i:s"),
            'etat_compte' => '1',
            'password' => md5($password)
        );
        try {
            $db->insert('entreprises', $ent1); /* insertion dans la table */
            unset($_POST);
            login($db,array('email'=>$email,'password'=> md5($password)),'compte.php');
        } catch (Exception $exc) {

            echo $exc->getTraceAsString(); /* Affichage d'erreur */
        }
    } else {
        // echo 'Une erreur est survenue !';
    }
}

$categ = $db->select('categories', '1', 'ORDER BY nom'); /* Sélection de toutes les catégories */


$categories = '';
if (isset($categ)) {
    foreach ($categ as $cat) {
        $selected = (isset($cat_id) && $cat_id == $cat['id']) ? 'selected' : '';
        $categories .= "<option $selected value='" . $cat['id'] . "'>" . $cat['nom'] . "</option>";
    }
}

include './includes/header.php'; /* inlusion de l'entete */
?>
<div>
    <?php
    require_once './includes/header_search.php';
    ?>
</div>
<div class=" pad10">
    <form method="post" action="add-enterprise.php" enctype="multipart/form-data">
        <div class="bloc_middle ">
            <div class="card no-shadow">
                <h2>Création de compte d'entreprise</h2>
                <fieldset>
                    <legend>Information sur l'entreprise</legend>
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
                    <div class="bloc_middle text-left">
                        <div>
                            <label class="text-mini">Secteur d'activité de l'entreprise</label>
                            <select required="required" name="cat_id" class="input-std control select2" >
                                <option value="">-Sélectionnez-</option>
                                <?php
                                echo isset($categories) ? $categories : '';
                                ?>
                            </select>
                        </div>
                        <div>
                            <label class="text-mini">Nom de l'entreprise</label>
                            <input size="30" value="<?= isset($name) ? $name : NULL ?>" required="required" class="input-std control" type="text" placeholder="Nom de l'entreprise" name="name" >
                        </div>

                        <div>
                            <label class="text-mini">Logo de l'entreprise</label>
                            <input size="31" class="input-stds control" type="file" accept=".jpeg,.png,.gif,.bmp" placeholder="Nom de l'entreprise" name="logo" >
                        </div>
                        <div>
                            <label class="text-mini">Description de l'entreprise</label>
                            <textarea class="input-stds control" rows="4" cols="31"  placeholder="Décrivez ce que fait votre entreprise" name="description" ><?= isset($description) ? nl2br($description) : NULL ?></textarea>
                        </div>
                </fieldset>
                <br>
                <fieldset>
                    <legend>Information sur le compte l'entreprise</legend>
                    <div>
                        <label class="text-mini">E-mail</label>
                        <input size="30" value="<?= isset($email) ? $email : NULL ?>" class="input-std control" type="email" required="required" placeholder="Email" name="email" >
                    </div>
                    <div>
                        <label>Mot de passe</label>
                        <input required="required" size="30" class="input-std control" type="password" placeholder="*********" name="password" >
                    </div>
                    <div>
                        <label>Confirmation du mot de passe</label>
                        <input size="30" class="input-std control" required="required" type="password" placeholder="*********" name="password_confirmation" >
                    </div>


                </fieldset>
                <div class="text-center">
                    <br>
                    <input  class="btn2 " name="add-ent" type="submit" value="Créer un compte " >
                    <br><br>
                    <ul class="text- text-muted inline">
                        <li class="no-link"><a href="login.php">J'ai déjà un compte, Me connecter</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </form>
</div>
</div>

<link href="assets/css/select2.min.css" rel="stylesheet" />
<script src="assets/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".select2").select2();
    });
</script>
<?php
include './includes/foot.php';

