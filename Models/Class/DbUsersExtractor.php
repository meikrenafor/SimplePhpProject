<?php

define('MYSQL_USERS_TABLENAME', 'Users');

require_once($_SERVER['DOCUMENT_ROOT'] . '/Models/Class/User.php');

/**
 * Class DbArticlesExtractor
 */
class DbUsersExtractor
{
    /**
     * @var - stores class instance
     */
    private static $instance = NULL;

    /**
     * @var array - array for storing articles
     */
    protected $users = array();

    /**
     * @param string $sql - method runs sql queries
     * @return PDOStatement - returns query object which can be used to fetch data
     */
    private function performSqlQuery(string $sql)
    {
        $db = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DATABASE . ';charset=utf8', MYSQL_USERNAME, MYSQL_PASSWORD);
        $query = $db->prepare($sql);
        $query->execute();

        return $query;
    }

    /**
     * - method loads data from db and put it to array
     */
    private function loadDataFromDb()
    {
        if (!isset($this->users))
            $this->users = array();

        $sql = "SELECT * FROM " . MYSQL_USERS_TABLENAME;
        $query = $this->performSqlQuery($sql);
        $extractedItems = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($extractedItems as $extractedItem) {
            $item = new User();

            $item->setId($extractedItem['id']);
            $item->setName($extractedItem['name']);
            $item->setPassword($extractedItem['password']);
            $item->setAdmin($extractedItem['admin']);

            array_push($this->users, $item);
        }
    }

    /**
     * @return DbArticlesExtractor|null - method returns one instance
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return array - method load all articles from db and
     */
    public function getAllUsers()
    {
        $this->loadDataFromDb();

        return $this->users;
    }

    /**
     * @param string $fieldKey - name of a key
     * @param string $fieldValue - value of a key
     * @return mixed|null - found article got by key and value criteria
     */
    public function getOneUserByKeyValuePair(string $fieldKey, string $fieldValue)
    {
        $this->loadDataFromDb();

        foreach ($this->users as $user) {
            foreach ($user as $key => $value) {
                if ($key == $fieldKey && $value == $fieldValue) {
                    return $user;
                }
            }
        }

        return NULL;
    }

    /**
     * @param $username - username
     * @param $password
     */
    public function addNewUser($username, $password)
    {
        $this->loadDataFromDb();

        $result = $this->getOneUserByKeyValuePair('name', $username);

        if (!isset($result)) {
            $sql = "INSERT INTO " . MYSQL_USERS_TABLENAME . "(name, password, admin) VALUES (\"" . $username . "\", \"" . md5($password) . "\", \"0\")";
            $this->performSqlQuery($sql);
        } else {
            echo "ERROR: User " . $username . " is already exist";
        }
    }

    /**
     * @param $id - remove articles using id
     */
    public function removeNewArticle($id)
    {
        $this->loadDataFromDb();

        $result = $this->getOneUserByKeyValuePair('id', $id);

        if (isset($result)) {
            $sql = "DELETE FROM " . MYSQL_USERS_TABLENAME . " WHERE id = \"" . $id . "\"";
            $this->performSqlQuery($sql);
        } else {
            echo "ERROR: User with ID = " . $id . " was not found";
        }
    }
}
