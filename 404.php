
<?php
$p = 'add-ent';
$titre = 'Inscription des entreprises';
require_once('lib/Db.php');
require_once('./lib/functions.php');
$db = connect(); /* Connexion à la base de donnée */
$error = NULL;
//print_r($categ);
if (!isset($_SESSION['id'])) {
    redirect("login");
}
$userid=$uid = $_SESSION['id'];
$users_select = $db->select('entreprises', "id='" . $userid . "'");
$updateUser = array();
if (count($users_select)) {
    $updateUser = $users_select[0];
    extract($updateUser);
    $name = $nom;
    $description = $detail;
    $cat_id = $categorie_id;
}
//print_r($users_select);
if (isset($_POST['add-ent'])) {/* Traitement du formulaire */
    $is_valide = TRUE;
    $d = extract($_POST); /* extraction des données du formulaire */
//    echo$logo = isset($_FILES['logo']['name']) ? $_FILES['logo']['name'] : '';
    if (strlen($name) <= 2 || strlen($name) > 250) {
        $error[] = "Le nom de l'entrprise n'est pas valide (entre 3 et 250 caractères)";
        $is_valide = FALSE;
    }
    if (intval($cat_id) <= 0) {
        $error[] = $cat_id . "La catégorie n'est pas valide";
        $is_valide = FALSE;
    }
    /*if (trim($password) != trim($password_confirmation)) {
        $error[] = "Veuillez confirmer le mot de passe";
        $is_valide = FALSE;
    }*/
    if (strlen($password) <= 4 || strlen($password) > 30) {
        $error[] = "Le mot de passe doit être compris entre 4 et 30 caractères";
        $is_valide = FALSE;
    }

    if ($is_valide) {
        $logo = isset($_FILES['logo']['name']) ? Telecharger('logo', "uploads/entreprises", 80) : '';
       
        $ent1 = array(
            'nom' => $name,
            
            'email' => $email,
            'detail' => $description,
            'categorie_id' => $cat_id,
            //'created_at' => date('Y-m-s H:i:s'),
            'etat_compte' => '1',
            'password' => md5($password_confirmation)
        );
        if($logo!=''){
            $ent1['logo'] = $logo;
        }
        
        $uservalid = $db->select('entreprises', "id='" . $userid . "' AND password='" . md5($password) . "'");
        //print_r($uservalid);
        if (count($uservalid)>0) {
            try {
                $db->update('entreprises', $ent1,"id='".$uid."'"); /* insertion dans la table */

                $conditions = Array('email' => $email, 'password' => md5($password_confirmation));
                login($db,$conditions);
                return redirect('compte.php');
            } catch (Exception $exc) {

                echo $exc->getTraceAsString(); /* Affichage d'erreur */
            }
        } else {
            $error[]="L'ancien mot de passe n'est pas valide";
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
<div class="body_gradient">
<div class="no-content ">
            <img src="assets/images/icon-bulb.png" class="info-image" alt="Welcome">
            <h1>404 !</h1>
            <h3>Not Found !</h3>
            <p class="text-center text-muted">La page que vous recherchez n'existe pas ou a été déplacée </p>
            <br>
            <br>
            <a href="index.php" class="btn1">Retour à l'accueil</a>

        
        </div>
</div>
</div>
<?php
include './includes/foot.php';

