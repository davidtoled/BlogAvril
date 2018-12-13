<?php ob_start(); ?>

<p>
    Derniers billets du blog :
</p>

<?php

while ($donnee = $requete->fetch()) {
    ?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($donnee['titre']).' <em>le '.htmlspecialchars($donnee['date_fr']).'</em>' ?>
        </h3>
        <p>
            <?= htmlspecialchars($donnee['contenu']) ?>
            <br/>
            <a href="?action=post&id_post=<?= $donnee['id'] ?>">Commentaire</a>
        </p>
    </div>
    <?php

}
/*le code en bas est pour la pagination
*/
$requete->closeCursor();
echo '<div class="center">';
    $separateur = ' - ';
    for ($page = 1; $page < ($nb_posts/5)+1; $page++ ) {
        if ($page == ceil($nb_posts/5)) {
            $separateur = '';
        }
        if (isset($_GET['page'])) {
            if ($page == $_GET['page']) {
                echo '<a href="index.php?action=listpost&page='.$page.'"><strong>'.$page.'</strong></a>'.$separateur;
            } else {
                echo '<a href="index.php?action=listpost&page='.$page.'">'.$page.'</a>'.$separateur;
            }
        } else {
            if ($page == 1) {
                echo '<a href="index.php?action=listpost&page='.$page.'"><strong>'.$page.'</strong></a>'.$separateur;
            } else {
                echo '<a href="index.php?action=listpost&page='.$page.'">'.$page.'</a>'.$separateur;
            }
        }
    }
echo '</div>';



$content = ob_get_clean();
$title='Accueil';
require('template.php');

?>
