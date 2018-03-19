<?php
require_once '../Helpers/LoginHelper.php'; bootstrap();
//require_once '../Models/ArticlesDatabaseModel.php';

if (isset($_SESSION['auth'])) {
    $formId = $_POST['id'];
    $formTitle = $_POST['title'];
    $formText = $_POST['text'];

    $articlesData = articles_all();

    if ($formId != NULL) {
        $formElementData = articles_one($formId);

        if (isset($formElementData)) {
            if ($formElementData['title'] != $formTitle || $formElementData['text'] != $formText) {
                articles_update($formId, $formTitle, $formText);
            }
        }
    } else {
        $error = false;

        if ($formTitle == NULL) {
            $error = true;
        }

        if ($formText == NULL) {
            $error = true;
        }

        $result = articles_one_by_title($formTitle);

        if (!isset($result)) {
            $error = true;
        }

        if (!$error) {
            articles_new($formTitle, $formText);
        }
    }

    header("Location: /");
} else {
    echo <<< HTML
    <h1>403 Access Denied</h1>
    <p>You don't have permissions to see content of this page</p>
HTML;
    header('HTTP/1.1 403 Forbidden');
}
