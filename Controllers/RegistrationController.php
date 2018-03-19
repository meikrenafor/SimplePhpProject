<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Helpers/LoginHelper.php';

LoginHelper::bootstrap();

require_once $_SERVER['DOCUMENT_ROOT'] . '/Controllers/IController.php';

class RegistrationController implements IController
{
    public function IndexAction()
    {
        $action = $_POST['action'];

        switch ($action) {
            case 'login' : {
                $username = $_POST['username'];

                $extractor = new DbUsersExtractor();
                $userExists = $extractor->getOneUserByKeyValuePair('name', $username);

                if ($userExists)
                    LoginHelper::login($username);
                else
                    echo "ERROR: Username is not exist";
                break;
            }
            case 'logout' : {
                LoginHelper::logout();
                break;
            }
            case 'register' : {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $passwordConfirm = $_POST['passwordConfirm'];

                $extractor = new DbUsersExtractor();
                $userExists = $extractor->getOneUserByKeyValuePair('name', $username);

                if (!$userExists && isset($username) && isset($password) && $password == $passwordConfirm) {
                    $extractor = new DbUsersExtractor();
                    $extractor->addNewUser($username, $password);
                } else
                    echo "ERROR: Cannot register user: " . $username;
                break;
            }
            default: {
                echo "ERROR: Action Unrecognized";
            }
        }
    }

    public function login($username, $password)
    {
        $extractor = new DbUsersExtractor();
        $result = $extractor->getOneUserByKeyValuePair('name', $username);

        if (isset($result)) {
            $temp = $extractor->getOneUserByKeyValuePair('password', md5($password));

            if (isset($temp) && $result->getPassword() == $temp->getPassword()) {
                $_SESSION['auth'] = $username;
            } else {
                echo "ERROR: Username and password doesn't match";
            }
        } else {
            echo "ERROR: User " . $username . " is not exists";
        }
    }
}
