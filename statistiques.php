
<?php
$p = 'stat';
$titre = 'Satistiques des recherches';
include './includes/config.php';
include './includes/header.php';
?>
<div>
    <?php
    require_once './includes/header_search.php';
    ?>
</div>
<form method="post" action="add-enterprise.php" enctype="multipart/form-data">
    <div id="bloc_middle">
        <div class="bloc_menu">
            <?php
            require_once './includes/hsmenu.php';
            ?>
        </div>
        <div class="bloc_content">
            <h3 class="page-title">Statistiques</h3>
            <div>
                
            </div>
        </div>
    </div>
</form>
<?php
include './includes/foot.php';
?>

