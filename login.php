
<?php
//session_start();$
$p = 'con';
$titre = 'Connexion à votre compte';
require_once('./lib/functions.php');
if (isset($_SESSION['user'], $_SESSION['id'])) {
    redirect('index.php');
    exit();
}
//controle_login('index.php');
require_once('lib/Db.php');
$db = connect(); /* Connexion à la base de donnée */

if (isset($_POST["login"])) {
    extract($_POST);
    $l = $_POST['login'];
    $p = md5(trim($_POST['password']));

    $conditions = Array('email' => $l, 'password' => $p);
    $error[]=login($db, $conditions);
    /* $is_connected = FALSE;
      $entreprise = $db->select("entreprises", $conditions, 'Limit 1');
      if (count($entreprise)) {
      $newuser= array_map('utf8_encode', $entreprise[0]);
      //print_r($newuser);
      $_SESSION['id'] = $newuser['id'];
      $_SESSION['user'] = serialize($newuser);
      $is_connected = TRUE;
      redirect('index.php');
      } else {
      $error[] = 'Login ou mot de passe incorrecte';
      } */
}

include './includes/header.php';
?>
<div class="body_gradient">
    <br>
    <div class="bloc_search_head2 pad5_0 text-center"> 
        <a href="index.php"><img id="mini-logo" src="./assets/images/FindAnswer_All.png" alt="Find Answers"></a>
    </div>
    <form method="post" action="login.php">
        <div class="bloc_auto">

            <div class="bloc_login has-shadow text-left">
                <h3 class="page-title pad5_0 ">CONNECTEZ VOUS !</h3><br>

                <?php
                if (isset($error) && count($error)) {
                    echo '<div class="error"><ul>';
                    foreach ($error as $e) {
                        echo "<li>" . $e . "</li>";
                    }
                    echo '</ul></div>';
                }
                ?>
                <div>
                    <label class="text-mini">Email</label>
                    <input required="required" size="30" value="<?= isset($login) ? $login : NULL; ?>" class="inputform1 control" type="email" placeholder="Nom d'utilisateur" name="login" >
                </div>
                <div>
                    <label class="text-mini">Mot de passe</label>
                    <input size="30" class="inputform1 control" type="password" placeholder="Mot de passe" name="password" >
                </div>
                <div class="text-center">
                    <br>
                    <input  class="btn1 block w100" type="submit" value="Connexion" >
                    
                    <ul class="text-mini text-muted inline">
                        <li class="no-link"><a href="add-enterprise.php">Nouveau, Créer un compte</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
include './includes/foot.php';
?>

