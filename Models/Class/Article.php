<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/Class/Entity.php';

/**
 * Class Article
 */
class Article extends Entity
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $text;

    /**
     * Article constructor.
     */
    public function __construct() { }

    /**
     * @param $title string
     */
    public function setTitle(string $title) {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $text
     */
    public function setText(string $text) {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function  getText() {
        return $this->text;
    }
}
