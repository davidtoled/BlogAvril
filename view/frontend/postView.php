<?php
ob_start();
?>
		<a href="index.php">Retour à la liste des billets</a>


				<div class="news">
					<h3>
				<?= htmlspecialchars($post['titre']).' <em>le '.htmlspecialchars($post['date_fr']).'</em>' ?>
					</h3>
					<p>
					<?= htmlspecialchars($post['contenu']) ?>
					</p>
				</div>
			<br/>
			<h2>Commentaires</h2>

            <form action="index.php?action=addComment&id_post=<?= $post['id'] ?>" method="post">
                <div>
                    <label for="author">Auteur</label>
                    <input type="text" id="author" name="author">
                </div>
                <div>
                    <label for="comment">Commentaire</label>
                    <textarea id="comment" name="comment"></textarea>
                </div>
                <div>
                    <button type="submit">Envoyer</button>
                </div>
            </form>

			<?php

			while ($donnee = $requete_commentaires->fetch()) {
				echo '<strong>'.htmlspecialchars($donnee['auteur']).'</strong> le '.htmlspecialchars($donnee['date_comment_fr']);
				echo '<p>'.htmlspecialchars($donnee['commentaire']).'</p>';
			}
            $requete_commentaires->closeCursor();
$content = ob_get_clean();
$title='Detail du post';
require('template.php');
		?>

