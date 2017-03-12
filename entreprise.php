
<?php
//controle_login();
$p = 'ent';
$titre = 'Entreprise';
require_once('lib/Db.php');
require_once('./lib/functions.php');

$db = connect(); /* Connexion à la base de donnée */
$user=null;
if(isset($_SESSION['user']))
$user = unserialize($_SESSION['user']);

$catid = $user['categorie_id'];
$uid = $user['id'];

if(isset($_GET['id'])){
    $ent_id=(int)trim($_GET['id']);
    if($ent_id>0){
        //insertion
        $entreprises=$db->select('entreprises',"id='".$ent_id."'",'limit 1');
        $unom='';
        $entreprise=NULL;
        if(count( $entreprises)){
            $entreprise=$entreprises[0];
            $unom=$entreprise['nom'];
        }
        $top= array('ent_id' =>$ent_id ,
        'ip'=> getIp());
        //$db->insert("tops",$top);
        $les_types=$db->select('types',"id IN (select type_id FROM entreprise_question WHERE entreprise_id='".$ent_id."')");
        //print_r($ent_id);
       // print_r($les_types);
        if(isset($_GET['type_id'])){
            $typeid=(int)trim($_GET['type_id']);
            $les_questions=$db->select('questions'," id IN (select question_id FROM entreprise_question WHERE type_id='".$typeid."' AND entreprise_id='".$ent_id."')");

            $letypes=$db->select('types',"id='".$typeid."'",'limit 1');
            $letype=NULL;
            if(count($letypes)){
                $letype=$letypes[0];
            }
        }
    }
}
$entreprises = $db->select("entreprises", '1', 'ORDER BY created_at');
include './includes/header.php';

?>

<div>
<?php
require_once './includes/header_search.php';
?>
</div>
<?php
          $logo = (isset($entreprise['logo']) && trim($entreprise['logo']) != '') ? $entreprise['logo'] : 'uploads/default.jpeg';
        ?>
<div class="cadre-entreprise text-center" id="couverture" >

    <img class="img-logo-profil" id="coverImage" src="<?= ($logo) ?>" alt="<?= $user['nom'] ?>">
    <h1><?=$unom;?></h1>
</div>

    <?php
        $typeCat=isset($letype['nom'])?$letype['nom']:'';
        if(isset($typeCat) && $typeCat!=''){
             echo"<div class='categorie-page'><h3 class='m0 pad0'>".$typeCat."</h3></div>";
        }
        ?>
<div id="bloc_middle2" class="body_gradient">
    <div class="bloc_menu bloc_menu2">
        <ul class="menu-onglet2">
        <?php
        foreach ($les_types as  $v) {
     // print_r($les_types);
        ?>
            <li class="active">
                <a href="entreprise.php?id=<?=($ent_id)?$ent_id:'0';?>&type_id=<?=(isset($v['id']))?$v['id']:'0';?>"><?=(isset($v['nom']))?$v['nom']:'';?></a>
                <?php
                if(isset($_GET['type_id']) &&  trim($_GET['type_id'])==$v['id']){
                    if(isset($les_questions) && count($les_questions)){
                    echo "<ul>";
                    foreach ($les_questions as $val) {
                        //Pour chaque type de question, on charges les questions associées
                        ?>
                        <li><a href="entreprise.php?id=<?=($ent_id)?$ent_id:'0';?>&type_id=<?=(isset($v['id']))?$v['id']:'0';?>&q_id=<?=(isset($val['id']))?$val['id']:'0';?>"><b>&Square;</b> <?=(isset($val['libelle']))?$val['libelle']:'';?></a></li>
                       <?php
                    }
                    echo "</ul>";
                    }
                }
                ?>
            </li>
            <?php
             # code...
        }
        ?>
            
        </ul>
    </div>

    <div class="bloc_content2 bgf">
    
    <div>

        <?php
        $typeCat=isset($letype['nom'])?$letype['nom']:'';
        
        //print_r($les_questions);
        if(isset($_GET["id"],$_GET["type_id"],$_GET["q_id"])){
            $id=(int)trim($_GET['id']);
            $type_id=(int)trim($_GET['type_id']);
            $q_id=(int)trim($_GET['q_id']);
            $reponses=$db->executeSelect('entreprise_question,questions','DISTINCT entreprise_question.reponse,questions.libelle',"questions.id=entreprise_question.question_id AND (entreprise_id='".$id."' AND type_id='".$type_id."' AND question_id='".$q_id."')",'limit 1')->fetchAll();
            $reponse=NULL;
           // print_r($reponses);
            if(count($reponses)){
                $reponse=$reponses[0];
                //Recherche et affichage de la réponse
                //print_r($reponse['libelle']);
                ?>
                <h1 class="questionpage"><?=(isset($reponse['libelle']))?$reponse['libelle']:'';?></h1>
                <div>
                <?=(isset($reponse['reponse']))?$reponse['reponse']:'';?>
                </div>
                <?php
            }else{
                echo "<div class='no-content'>
                    <h1>Aucune réponse disponible</h1>
                </div>" ;
            }
        }else{
            ?>
            <div class="no-content ">
            <img src="assets/images/icon-bulb.png" class="info-image" alt="Welcome">
            <h3>Bienvenue sur la page d'information de <?=''?></h3>
            <p class="text-center">Vous retrouverez ici toutes les informations relatives à notre structure  </p>
            
            <div class="text-left ">
            <h3>Etapes à suivre: </h3>
            <ul>
                <li>Choissisez la catégorie de votre choix</li>
                <li>Sélectionnez l'une des questions </li>
                <li>Consultez la réponse proposée</li>
            </ul>
            </div>
            </div>
            <?php
        }

        ?>
         </div>
    </div>
    </div>
    <script type="text/javascript" src="assets/js/color-thief.js"></script>
    <script type="text/javascript">
        // Include Color Thief Script
        // https://github.com/lokesh/color-thief

        function colorChange(){
          //Be sure to include <img id="coverImage" src="" alt=""/>
          var $myImage = $("#coverImage");
          var colorThief = new ColorThief();
          
          //Grabs 8 swatch color palette from image and sets quality to 5 (0 =slow, 10=default/fast)
          var cp = colorThief.getPalette($myImage[0], 8, 5);
         
          //Sets background to 3rd color in the palette.
          $('#couverture').css('background-color', 'rgb('+cp[2][0]+','+cp[2][1]+','+cp[2][2]+')');
          var invR=255-cp[2][0],invG=255-cp[2][1],invB=255-cp[2][2];
          $('#couverture').css('color', 'rgb('+invR+','+invG+','+invB+')');
        }

        $(document).ready(function() {
          //Make sure image is loaded before running.
          //alert("")
          colorChange();
        });
    </script>
    <?php
    include './includes/foot.php';
    ?>

