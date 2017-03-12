
<?php
$p = 'rech';
$p = 'add-ent';
$titre = ' ';
require_once('lib/Db.php');
require_once('./lib/functions.php');

if (isset($_GET['q']) && !empty($_GET['q'])) {
    $q = trim($_GET['q']);
    $q1 = trim(($_GET['q']));
    $titre.="". $q1."| Résultat de la recherche"; 
    $q = Parser(trim(addslashes($_GET['q'])));
    $start = 0;
    $offset = 10;
    $db = connect();
    $COMPTEUR = 0;
    $DATA = NULL;
    // $reponses = $db->select('entreprise_question,questions', "entreprise_question.reponse LIKE '%" . $q . "%' OR questions.libelle LIKE '%" . $q . "%'", " LIMIT $start, $offset");
    /* $reponse1 = $db->select('questions', "questions.libelle LIKE '" . $q . "'", " LIMIT $start, $offset");
      $COMPTEUR= count($reponse1);

      $reponse2 = $db->select('questions', "questions.libelle LIKE '%" . $q . "'", " LIMIT $start, $offset");
      $COMPTEUR+= count($reponse2);
      $reponse3 = $db->select('questions', "questions.libelle LIKE '%" . $q . "%'", " LIMIT $start, $offset");
      $COMPTEUR+= count($reponse3); */
    $reponses = $db->executeSelect('entreprise_question,entreprises', '*', "question_id in (select id from questions where questions.libelle LIKE '%" . $q . "%' OR questions.libelle LIKE '%" . $q1 . "%' OR entreprises.nom LIKE '%" . $q . "%' OR entreprises.nom LIKE '%" . $q1 . "%' ORDER BY LIBELLE) AND (entreprise_question.entreprise_id=entreprises.id)", " ORDER BY entreprise_id LIMIT $start, $offset")->fetchAll();

    //print_r($reponses);
}
include './includes/header.php';
?>
<div>
    <?php
    require_once './includes/header_search.php';
    ?>
</div>

<div id="bloc_resultat_recherche">

    <div class="bloc_resultat1">
        <?php
        if (isset($q)) {
            ?>
            <p class="bloc_mot_search ">Résultat de la recherche pour  <small class="text-muted"><?= ($q1) ?></small><br>
            <?php
              if($q!=$q1 && trim($q)!=''){
            ?>
            <a class="" href="search.php?q=<?= ($q) ?>">Vous vous dire : <?=($q);?></a>
              <?php
        }
        ?>
            </p>

            <?php
        }
            ?>
        <?php
        if (isset($reponses) && count($reponses)) {
            ?>
            <ul id="search-list">
                <?php
                //$tmpnom=null;
                $i = 0;
                $TabEnt = array();
                foreach ($reponses as $key => $reponse) {

                    $id_q = (int) $reponse['question_id'];
                    $the_question = $db->executeSelect('questions', 'libelle', "id='" . $id_q . "'")->fetch();
                    //print_r($the_question);

                    $nom_entreprise = $reponse['nom'];
//                    $nom_entreprise= (isset($tmpnom) && $reponse['nom']=$tmpnom)? '':$reponse['nom'];
                    $nm = $reponse['entreprise_id'];
                    if (!in_array($nm, $TabEnt)) {
                        $TabEnt[$i++] = $nm;
                        $write = TRUE;
                    } else {
                        $write = FALSE;
                    }
                    ?>
                    <?= ($write) ? "<h3 id='resultat$nm'><a href='entreprise.php?id=".$nm."'>" . $nom_entreprise . "</a></h3>" : ''; ?>
                    <li >
                        <p class="question_liste2 pad0 m0">
                            <a href='entreprise.php?id=<?=$nm;?>'>&RightTriangle; <?= isset($the_question['libelle']) ? ($the_question['libelle']) : '' ?> </b></a>
                        </p>

                        <p class="reponse_liste pad0 m0" id="art_c_<?= ($nm); ?>">
                            <?php
                            $reponse['reponse'] = $reponse['reponse'];
                            $aff_rep = $reponse['reponse'];
                            $rep = truncate(trim($reponse['reponse']), 250, " ...", TRUE);
                            $sdetails = FALSE;
                            if (strlen($aff_rep) > 350) {
                                $sdetails = TRUE;
                            }
                            if($write) {
                            ?>
                            <?= isset($rep) ? (gras_Search($rep, $q) ) : '' ?>
                            <?php
                            }
                            ?>
                        </p>
                       <!-- <?php
                        if ($sdetails) {
                            ?>
                            <div class="reponse_liste hidden" id="art_o_<?= ($nm); ?>">

                                <?= isset($aff_rep) ? (gras_Search($aff_rep, $q)) : '' ?>
                            </div>
                            <div class="lire_suite ">
                                <a href="#resultat<?= ($nm); ?>" rel="<?= ($nm); ?>" class="basculer">Afficher la suite &Downarrow;</a>
                            </div>
                            <?php
                        }
                        ?>-->
                    </li>
                    <?php
                    (isset($tmpnom) && $nom_entreprise == $tmpnom) ? "<b>" . $tmpnom . "</b>" : '<hr>';
                    $tmpnom = $reponse['nom'];
                    //echo  $tmpnom."<hr>";
                }
                ?>
            </ul>
            <?php
        } else {
            ?>          
                        <div class="card" >
                            <img id="iconsearch" src="<?= ('assets/images/icon_search.png'); ?>" alt="Recherche">

                            <h2 class="text-center"> Aucun résultat trouvé </h2>
                            <b class="text-muted">Veuillez réessayer en tenant compte des paramètres suivants:</b>
                            <ul class="pad10">
                                <li>Assurez vous que ce que vous saissez concerne les services d'une entreprise données</li>
                                <li>Utilisez des mot clé con venable (ex: produit, article, livre, ...) </li>
                                <li>Recherchez en saisissant le nom d'une entreprise donnée</li>
                            </ul>
                        </div> 
            <?php
        }
        ?>
    </div>
</div>
<script src="assets/js/autocomplete/jquery.mockjax.js" type="text/javascript"></script>
<script src="assets/js/autocomplete/jquery.autocomplete.js" type="text/javascript"></script>
<link href="assets/js/autocomplete/jquery.autocomplete.css" rel="stylesheet" />
<style type="text/css">
</style>
<script>
    $(function () {
        'use strict';
        $('#search-entreprise').autocomplete({
            serviceUrl: './ajax/suggestions.php',
            dataType: 'json',
            onSelect: function (suggestion) {
                //$(this).parent().find('form').submit();
                //$('#selction-ajax').html('You selected: ' + suggestion.slug + ', ' + suggestion.data);
            }

        });

    });
    var face = true;
    $(".basculer").click(function () {
        var id = $(this).attr('rel');

        if (face === true) {
            face = false;
            $('#art_c_' + id).hide(0);
            $('#art_o_' + id).show(0);
            $(this).html("Masquer les détails &Uparrow;");
        } else {
            face = true;
            $('#art_c_' + id).show(0);
            $('#art_o_' + id).hide(0);
            $(this).html("Afficher la suite &Downarrow;");
        }
    });
</script>
<?php
include './includes/foot.php';
?>

