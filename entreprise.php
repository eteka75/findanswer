
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
            $les_questions=$db->select('questions,entreprise_question',"questions.id=entreprise_question.question_id AND type_id='".$typeid."' AND entreprise_id='".$ent_id."'");
            
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
<div id="bloc_middle">
    <div class="bloc_menu">
        <ul class="menu-onglet2">
        <?php
        foreach ($les_types as  $v) {
     // print_r($v['']);
        ?>
            <li class="active">
                <a href="entreprise.php?id=<?=($ent_id)?$ent_id:'0';?>&type_id=<?=(isset($v['id']))?$v['id']:'0';?>"><?=(isset($v['nom']))?$v['nom']:'';?></a>
            </li>
            <?php
             # code...
        }
        ?>
            
        </ul>
    </div>
    <div class="bloc_content bgf">
        <?php
        print_r($les_questions);
        foreach ($les_questions as $v) {
            # code...
        }
        ?>
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

