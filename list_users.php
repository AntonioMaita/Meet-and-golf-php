<?php
session_start();

require("includes/init.php");  


header("Cache-Control: no-cache, must-revalidate");


$req = $db->query("SELECT id FROM users WHERE active='1'");

$nbre_total_users = $req->rowCount();

if($nbre_total_users >=1){

    $nbre_users_par_page = 12;

    $nbre_pages_max_gauche_et_droite = 4;

    $last_page = ceil($nbre_total_users / $nbre_users_par_page);

    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $page_num = $_GET['page'];
    } else {
        $page_num = 1;
    }

    if ($page_num < 1) {
        $page_num = 1;
    } else if ($page_num > $last_page) {
        $page_num = $last_page;
    }

    $limit = 'LIMIT ' . ($page_num - 1) * $nbre_users_par_page . ',' . $nbre_users_par_page;

    //Cette requête sera utilisée plus tard
    $q = $db->query("SELECT id, pseudo, email, avatar, club FROM users WHERE active='1' ORDER BY pseudo $limit");
    $users = $q->fetchAll(PDO::FETCH_OBJ);

    $pagination = '<nav class="text-center">
    <ul class="pagination">';

    if ($last_page != 1) {
        if ($page_num > 1) {
            $previous = $page_num - 1;
            $pagination .= '<li class="page-item"><a class="page-link" aria-label="Previous" href="list_users.php?page=' . $previous . '"><span aria-hidden="true">&laquo;</span></a></li> ';

            for ($i = $page_num - $nbre_pages_max_gauche_et_droite; $i < $page_num; $i++) {
                if ($i > 0) {
                    $pagination .= '<li class="page-item"><a class="page-link" href="list_users.php?page=' . $i . '">' . $i . '</a></li>';
                }
            }
        }

        $pagination .= '<li class="page-item active"><a class="page-link">' . $page_num . '</a></li>';

        for ($i = $page_num + 1; $i <= $last_page; $i++) {
            $pagination .= '<li class="page-item"><a class="page-link" href="list_users.php?page=' . $i . '">' . $i . '</a></li> ';

            if ($i >= $page_num + $nbre_pages_max_gauche_et_droite) {
                break;
            }
        }

        if ($page_num != $last_page) {
            $next = $page_num + 1;
            $pagination .= '<li class="page-item"><a class="page-link" aria-label="Next" href="list_users.php?page=' . $next . '"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
    $pagination .= '</ul></nav>';




    require("views/list_users.view.php");
} else {
    set_flash('Aucun utilisateur pour le moment ....');
    redirect('profile.php');
}