<ul class="menu-onglet">
   <li <?= (isset($p)&& $p=='ent-h')?"class='active'":''?>>
        <a href="ent-home.php">Accueil</a>
    </li>
    <li  <?= (isset($p)&& $p=='compt')?"class='active'":''?>>
        <a href="compte.php">Mon compte</a>
    </li>
    <li  <?= (isset($p)&& $p=='rep')?"class='active'":''?>>
        <a href="reponses.php">Mes Propositions</a>
    </li>
    <!--li  <?= (isset($p)&& $p=='stat')?"class='active'":''?>>
        <a href="statistiques.php">Statistiques</a>
    </li-->
</ul>