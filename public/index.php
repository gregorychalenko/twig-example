<?php

    require __DIR__.'/../vendor/autoload.php';

    define('PATH_TMPL', __DIR__.'/../tmpl');
    define('PATH_DATA', __DIR__.'/../data');

    $page = empty($_REQUEST['page']) ? 'index' : strtolower($_REQUEST['page']);
    $data_file = PATH_DATA. '/'. $page. '.json';
    $data = file_exists($data_file) ? json_decode(file_get_contents($data_file), true) : [];
    $page = $page . '.html';

    $loader = new Twig_Loader_Filesystem(PATH_TMPL);
    $twig = new Twig_Environment($loader);

    try {
        echo $twig->render($page, $data);
    } catch (Exception $e) {
        echo $twig->render('index.html', []);
    }
    