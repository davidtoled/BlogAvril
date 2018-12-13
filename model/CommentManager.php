<?php
/**
 * Created by PhpStorm.
 * User: olivi
 * Date: 10/05/2018
 * Time: 15:49
 */

class CommentManager extends Manager
{

    public function getComments($postId)
    {

        $bdd = $this->dbConnect();
        $requete_commentaires = $bdd->prepare('SELECT id, id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, "%d/%c/%Y à %Hh%imin%Ss") as date_comment_fr FROM commentaires WHERE id_billet = ?');
        $requete_commentaires->execute(array($postId));
        return $requete_commentaires;


    }

    public function setComment($postId, $author, $comment)
    {

        $bdd = $this->dbConnect();
        $comments = $bdd->prepare('INSERT INTO commentaires(id_billet, auteur, commentaire, date_commentaire) VALUES (?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));
        return $affectedLines;
    }



}