<?php
require_once '../Helpers/LoginHelper.php';
bootstrap();

if (isset($_SESSION['auth']) && users_is_admin($_SESSION['auth']) == true) {
    require_once '../Models/ArticlesDatabaseModel.php';

    $articleId = $_GET['id'];
    $action = $_GET['action'];

    function article_edit_form_print($id)
    {
        if ($id != NULL) {
            $result = articles_one($id);

            $articleTitle = $result['title'];
            $articleText = $result['text'];
        } else {
            $articleTitle = $articleText = "";
        }

        include_once '../Views/ArticleEditorView.php';
    }

    function req_article_delete($id)
    {
        articles_delete($id);
        header("Location: /");
    }

    if ($action == "edit") {
        article_edit_form_print($articleId);

    } else if ($action == "delete") {
        req_article_delete($articleId);
    }
} else {
    echo <<< HTML
    <h1>403 Access Denied</h1>
    <p>You don't have permissions to see content of this page</p>
HTML;
    header('HTTP/1.1 403 Forbidden');
}
