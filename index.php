<?php

require('controller/frontend.php');

try {
    if (isset($_GET['action'])) {
        if($_GET['action'] == 'listpost') {
            listPosts();
        } else if ($_GET['action'] == 'post') {
            post();
        } else if ($_GET['action'] == 'addComment') {
            addComment();
        } else {
            listPosts();
        }
    } else {
        listPosts();
    }
} catch (Exception $e) {
    $title = 'Erreur';
    $content = '<div class="error">'.$e->getMessage().'</div>';
    require('view/frontend/template.php');
}

  
