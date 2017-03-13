<div class="bloc_search_head">
    <form method="GET" action="search.php">
        <div id="bloc_head_search">
            <div class="bloc_logo1"> 
                <a href="index.php"><img id="mini-logo" src="./assets/images/FindAnswer_All.png" alt="Find Answers"></a>
            </div>
            <div class="bloc_search2">

                <input class="search-input" value="<?= isset($_GET['q']) ? htmlentities(trim($_GET['q'])) : NULL; ?>"  type="search" placeholder="Salut, posez moi une question concernant une entreprise !" name="q" id="search-entreprise">

            </div>
            <div class="bloc_search3 text-mini">
                <?php
                if (isset($_SESSION['user'], $_SESSION['id'])) {

                    $db = connect();


                    $user = unserialize($_SESSION['user']);
                    echo "<b>" . ($user['nom']) . "</b>";
                    $categorie_id = $user['categorie_id'];
                    $recup_categ = $db->selectOne('categories', "id='" . $categorie_id . "'");
                    $categorie = '';
                    $categorie_id = 0;
                    if (count($recup_categ)) {
                        $categorie = $recup_categ['nom'];
                        $categorie_id = $recup_categ['id'];
                    }
                    ?>
                    <ul class='menu-login no-link  inline fright'>
                        <!--li><a class="text-muted" href="categories.php?id=<?= (isset($categorie_id) ? $categorie_id : ''); ?>"><?= (isset($categorie) ? ($categorie) : ''); ?></a></li-->
                        <li><a  class=" text-mini" href="logout.php">Déconnexion</a></li>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div>
    </form>
</div>

<script src="assets/js/autocomplete/jquery.mockjax.js" type="text/javascript"></script>
<script src="assets/js/autocomplete/jquery.autocomplete.js" type="text/javascript"></script>
<link href="assets/js/autocomplete/jquery.autocomplete.css" rel="stylesheet" />

<script>
    $(function () {
        'use strict';
        $('#search-entreprise').autocomplete({
            serviceUrl: './ajax/suggestions.php',
            dataType: 'json',
            onSelect: function (suggestion) {
                $("#rechercheform").submit();
                //$('#selction-ajax').html('You selected: ' + suggestion.slug + ', ' + suggestion.data);
                $('#rechercheforms').submit();
            }

        });
    });
    </script>