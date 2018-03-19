<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/Class/DbUsersExtractor.php';

/**
 * Class LoginHelper
 */
class LoginHelper
{
    /**
     * - bootstrap method which runs on every page
     */
    public static function bootstrap()
    {
        if (!isset($_COOKIE["PHPSESSID"])) {
            session_start();
        }
    }

    /**
     * @param string $username - writes username to session
     */
    public static function login(string $username)
    {
        $extractor = new DbUsersExtractor();
        $isExist = $extractor->getOneUserByKeyValuePair('username', $username);

        if (isset($isExist))
            $_SESSION['auth'] = $username;
    }

    /**
     * - helper method need for logout
     */
    public static function logout()
    {
        unset($_SESSION["auth"]);
        session_destroy();
    }
}
