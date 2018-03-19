<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Controllers/IController.php';

/**
 * Class DefaultController
 */
class DefaultController implements IController
{
    /**
     * - action which throws 404 error
     */
    public function IndexAction()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Helpers/LoginHelper.php';

        LoginHelper::bootstrap();

        include_once $_SERVER['DOCUMENT_ROOT'] . '/Views/DefaultView.php';
    }
}
