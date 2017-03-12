
<?php
$p = 'home';
$titre = 'Tout ce que vous recherchez sur vos entreprises';
include './includes/config.php';
include './includes/header.php';

//$db = connect(); 


/* Connexion à la base de donnée */
//$entreprises = $db->select("entreprises", '1', 'ORDER BY created_at');
?>

<div class="body_gradient">
    <form id="rechercheforms" action="search.php" method="GET">
        <div  class="bloc_auto">
            <div class="bloc_logo"> 
                <a href="index.php"><img src="assets/images/FindAnswer_All.png" alt="Find Answers"></a>
            </div>

            <div class="bloc_search">
                <input class="search-input2" required="required" value="<?= isset($_GET['q']) ? htmlentities(trim($_GET['q'])) : NULL; ?>"  type="search" placeholder="Saisissez le nom d'une entreprise pour commencer" name="q" id="search-entreprise">
            </div>
        </div>
    </form>
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
                $("#rechercheform").submit();
                //$('#selction-ajax').html('You selected: ' + suggestion.slug + ', ' + suggestion.data);
                $('#rechercheforms').submit();
            }

        });
    });
</script>
<?php
include './includes/foot.php';
?>

