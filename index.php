<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Helpers/LoginHelper.php';

LoginHelper::bootstrap();

require_once $_SERVER['DOCUMENT_ROOT'].'/Controllers/DefaultController.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Controllers/ArticlesController.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Controllers/ArticleEditorController.php';

//function __autoload( $className ) {
//    $className = str_replace( "..", "", $className );
//    require_once($_SERVER['DOCUMENT_ROOT'].'/Models/Class/' . $className . '.php');
//}

function handleRequest() {
    $page = $_GET['page'];
    $controller = NULL;

    if (isset($page)) {
        switch ($page) {

            case 'Articles': {
                $controller = new ArticlesController();
                break;
            }

            case 'ArticleEditor': {
                //$articleId = $_GET['id'];
                //$action = $_GET['action'];
                // by any way we should put data above into controller below

                $controller = new ArticleEditorController();
                break;
            }

            default: {
                $controller = new DefaultController();
                break;
            }
        }
    } else {
        $controller = new ArticlesController();
    }

    $controller->IndexAction();
}

handleRequest();
