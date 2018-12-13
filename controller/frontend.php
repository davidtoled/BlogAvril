<?php
/**
 * Created by PhpStorm.
 * User: arb
 * Date: 02/05/2018
 * Time: 16:29
 */

function chargerClasse($classe){
    require('model/'.$classe.'.php');
}
  spl_autoload_register('chargerClasse');

function listPosts() {
    if(isset($_GET['page']) AND ($_GET['page']) > 0) {
        $start = ($_GET['page']-1) * 5;
    } else {
        $start = 0;
    }
    $postManager = new PostManager();

    $requete =  $postManager->getPosts($start);
    $nb_posts =  $postManager->getPostsCount();
    require('view/frontend/indexView.php');
}


function post() {
    if(isset($_GET['id_post']) and $_GET['id_post'] > 0) {
        $postManager = new PostManager();
        $post =  $postManager->getPost($_GET['id_post']);
        if (!empty($post)) {
            $commentManager = new CommentManager();
            $requete_commentaires =  $commentManager->getComments($_GET['id_post']);
            require('view/frontend/postView.php');
        } else {
            //echo 'aucun post pour cet id';
            throw new Exception('Ce post n\'existe pas');
        }
    } else {
        //echo 'aucun identifiant de billet envoyé ou identifiant négtif';
        throw new Exception('aucun identifiant de billet envoyé ou identifiant négtif');
    }
}


function addComment() {
    if(isset($_GET['id_post']) and $_GET['id_post'] > 0) {
        if (isset($_POST['author']) AND isset($_POST['comment'])) {
            $commentManager = new CommentManager();
            $affectedLines = $commentManager->setComment($_GET['id_post'], $_POST['author'], $_POST['comment']);
            if ($affectedLines == '0' OR $affectedLines == 0 OR $affectedLines == false) {
                //echo 'Impossible d\'ajouter le commentaire';
                throw new Exception('Impossible d\'ajouter le commentaire');
            } else {
                header('Location: index.php?action=post&id_post='.$_GET['id_post']);
            }
        } else {
            header('Location: index.php?action=post&id_post='.$_GET['id_post']);
        }
    } else {
        header('Location: index.php?action=listpost');
    }
}

