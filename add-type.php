
<?php
$p = 'rep';
$titre = 'Ajout de réponse';
include './includes/config.php';
$db = connect();
if (!isset($_SESSION['user'])) {
    redirect("login.php");
}
$user = unserialize($_SESSION['user']);
$catid = $user['categorie_id'];
$uid = $user['id'];
$alltypes = $db->select("types","ent_id='".$uid."'");
if (isset($_POST['add-type'])) {/* Traitemnt du formulaire */
    $is_valide = TRUE;
    $d = extract($_POST); /* extraction des données du formulaire */
    $img = isset($_FILES['img']['name']) ? $_FILES['img']['name'] : '';
    if (strlen($nomtype) <= 2 || strlen($nomtype) > 250) {
        $error[] = "Le nom du type n'est pas valide (entre 3 et 250 caractères)";
        $is_valide = FALSE;
    }
    if (strlen($img) <= 1) {
        $error[] = "Veuillez ajouter une image décrivant votre type d'activité";
        $is_valide = FALSE;
    }
    if ($is_valide) {
        $img = isset($_FILES['img']['name']) ? Telecharger('type', "uploads/types", 350) : '';
        $type = array(
            'nom' => $nomtype,
            'img' => $img,
            'ent_id' => $uid
        );
        try {
            $db->insert('types', $type); /* insertion dans la table */
            return redirect('add-type.php');
        } catch (Exception $exc) {

            echo $exc->getTraceAsString(); /* Affichage d'erreur */
        }
    }
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
        <h3 class="page-title">Type réponse</h3>
        <div>
            <form method="post" action="add-type.php" enctype="multipart/form-data">
                <fieldset>
                    <legend>Ajout d'un type de réponse</legend>
                    <div>
                        <?php
                        if (isset($error) && count($error)) {
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
                            <label class="text-mini">Nom du type</label>
                            <input class="control" name="nomtype" value="<?= isset($nomtype) ? htmlentities($nomtype) : NULL ?>" placeholder="Evènements, Clientèle,..." >
                        </div>

                        <div>
                            <label class="text-mini">Photo</label>
                            <input type="file" name="img" required="true" class="control">
                        </div>
                        <div>

                            <input  class="btn1 " name="add-type" type="submit" value="Enrégistrer" >
                            <hr class="mhr">
                            <a href="index.php" class="">Retour à l'accueil</a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        
        <div class="page-titles bold pad10 ">Liste des types</div>
        <div class="list_mini1 ">
        <table class="l-table">
            <tbody>
                <?php
                $dns = "hostname=localhost;dbname=qr";
                $user = "root";
                $password = "";

                try {
                    //$con = new PDO($dns, $user, $password);
                } catch (Exception $exc) {
                    echo $exc->getTraceAsString();
                }
                
                if (count($alltypes) <= 0) {
                    echo '<tr>';
                    echo '<td class="bold">Aucun type pour le moment</td>';
                    echo '</tr>';
                }
                foreach ($alltypes as $type) {
                    echo '<tr>';
                    echo '<td>'.$type['nom'].'</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
            </div>
    </div>
</div>
<?php
include './includes/foot.php';
?>

