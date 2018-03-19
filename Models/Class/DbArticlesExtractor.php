<?php

define('MYSQL_HOST', 'localhost');
define('MYSQL_USERNAME', 'root');
define('MYSQL_PASSWORD', 'root');
define('MYSQL_DATABASE', 'Articles');
define('MYSQL_ARTICLES_TABLENAME', 'Articles');

require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/Class/Article.php';

/**
 * Class DbArticlesExtractor
 */
class DbArticlesExtractor
{
    /**
     * @var - stores class instance
     */
    private static $instance = NULL;

    /**
     * @var array - array for storing articles
     */
    protected $articles = array();

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
     * - couldn't figure out how to make class properties fill dynamically
     */
    private function loadDataFromDb()
    {
        if (!isset($this->articles))
            $this->articles = array();

        $sql = "SELECT * FROM " . MYSQL_ARTICLES_TABLENAME;
        $query = $this->performSqlQuery($sql);
        $extractedItems = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($extractedItems as $extractedItem) {
            $item = new Article();

            $item->setId($extractedItem['id']);
            $item->setTitle($extractedItem['title']);
            $item->setText($extractedItem['text']);

            array_push($this->articles, $item);
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
    public function getAllArticles()
    {
        $this->loadDataFromDb();

        return $this->articles;
    }

    /**
     * @param string $fieldKey - name of a key
     * @param string $fieldValue - value of a key
     * @return mixed|null - found article got by key and value criteria
     */
    public function getOneArticleByKeyValuePair(string $fieldKey, string $fieldValue)
    {
        $this->loadDataFromDb();

        foreach ($this->articles as $article) {
            foreach ($article as $key => $value) {
                if ($key == $fieldKey && $value == $fieldValue) {
                    return $article;
                }
            }
        }

        return NULL;
    }

    /**
     * @param $title - new article title
     * @param $text - new article text (content)
     */
    public function addNewArticle($title, $text)
    {
        $this->loadDataFromDb();

        $result = $this->getOneArticleByKeyValuePair('title', $title);

        if (!isset($result)) {
            $sql = "INSERT INTO " . MYSQL_ARTICLES_TABLENAME . "(title, text) VALUES (\"" . $title . "\", \"" . $text . "\")";
            $this->performSqlQuery($sql);
        } else {
            echo "ERROR: Article " . $title . " is already exist";
        }
    }

    /**
     * @param $id - remove articles using id
     */
    public function removeNewArticle($id)
    {
        $this->loadDataFromDb();

        $result = $this->getOneArticleByKeyValuePair('id', $id);

        if (isset($result)) {
            $sql = "DELETE FROM " . MYSQL_ARTICLES_TABLENAME . " WHERE id = \"" . $id . "\"";
            $this->performSqlQuery($sql);
        } else {
            echo "ERROR: Article with ID = " . $id . " was not found";
        }
    }
}
