<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Controllers/IController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/Class/DbArticlesExtractor.php';

/**
 * Class ArticlesController
 */
class ArticlesController implements IController
{
    /**
     * - method prints articles to index page
     */
    public function IndexAction()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Helpers/LoginHelper.php';

        LoginHelper::bootstrap();

        $extractor = DbArticlesExtractor::getInstance();
        $articles = $extractor->getAllArticles();

        include_once $_SERVER['DOCUMENT_ROOT'].'/Views/ArticlesView.php';
    }
}
