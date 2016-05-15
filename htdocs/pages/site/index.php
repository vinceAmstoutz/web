<?php
require_once dirname(__FILE__) .'/../../../sources/Afup/Bootstrap/Http.php';
require_once dirname(__FILE__).'/../../../sources/Afup/AFUP_Site.php';

$page = new AFUP_Site_Page($bdd);

if (isset($_GET['page']) && $_GET['page'] == 'inscription') {
    header('Location: /pages/administration/index.php?page=inscription');
}

$page->definirRoute(isset($_GET['route']) ? $_GET['route'] : '');

echo $twig->render('site/index.html.twig', [
    'community' => $page->community(),
    'header' => $page->header(),
    'content' => $page->content(),
    'sidebar' => $page->getRightColumn(),
    'social' => $page->social(),
    'footer' => $page->footer()
]);