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

$articles = getArticles($link);
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



echo $twig->render('admin-article-list.html.twig', [
    'articles' => $articles,
    'homeUsername' => $homeUsername,
    'homeAdmin' => $homeAdmin,
    'homeConnected' => $homeConnected,
    'homeSession' => $homeSession,

]);

