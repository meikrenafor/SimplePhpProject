<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Controllers/IController.php';

/**
 * Class ArticleEditorController
 */
class ArticleEditorController implements IController
{
    /**
     * - action method which load data from collection to form
     */
    public function IndexAction()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Helpers/LoginHelper.php';

        LoginHelper::bootstrap();

        $action = $_GET['action'];

        $extractor = DbArticlesExtractor::getInstance();
        $articles = $extractor->getAllArticles();

        $articleId = $_GET['id'];
        $articleTitle = "";
        $articleText = "";

        if ($action == 'edit') {
            if (isset($articleId)) {
                $result = $extractor->getOneArticleByKeyValuePair('id', $articleId);
                $articleTitle = $result->getTitle();
                $articleText = $result->getText();
                echo "Edited";
            } else {
                $articleTitle = $articleText = "";
            }
        } else if ($action == 'delete') {
            // delete whatever
            echo "Deleted";
        }

        include_once $_SERVER['DOCUMENT_ROOT'] . '/Views/ArticleEditorView.php';
    }
}
