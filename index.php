<?php
/**
 * @author Thibaud BARDIN (https://github.com/Irvyne).
 * This code is under MIT licence (see https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/_header.php';

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem([
    __DIR__.'/views',
]);



$perPage = 6;
$total = countArticles($link);
$currentPage = !empty($_GET['p']) ? (int)$_GET['p'] : 0;
$lastPage = (int)floor($total/$perPage);




if (0 >= $currentPage) {
    header('Location: articles.php?p=1');
}
if ($currentPage > ($lastPage+1)) {
    header('Location: articles.php?p='.($lastPage+1));
}
$articles = getArticles($link, null, ($currentPage-1)*$perPage, $perPage);
$twig = new Twig_Environment($loader,[
//'cache' => null,
]);
$homeUsername = [
    'getUsername' => getSession(),
];
$homeAdmin = [
    'isAdmin' => isAdmin(),
];
$homeConnected = isConnected();

$homeSession = $_SESSION;

echo $twig->render('articles.html.twig', [
    'articles' => $articles,
    'perPage' => $perPage,
    'total' => $total,
    'currentPage' => $currentPage,
    'lastPage' => $lastPage,
    'homeUsername' => $homeUsername,
    'homeAdmin' => $homeAdmin,
    'homeConnected' => $homeConnected,
    'homeSession' => $homeSession,
]);
