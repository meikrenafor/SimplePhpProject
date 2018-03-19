<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/Class/Entity.php';

/**
 * Class User
 */
class User extends Entity
{
    /**
     * @var string - name property
     */
    protected $name;

    /**
     * @var string - password property
     */
    protected $password;

    /**
     * @var bool - is user admin property
     */
    protected $admin;

    /**
     * @param string $name - setter for name property
     */
    public function setName(string $name) {
        $this->name = $name;
    }

    /**
     * @return string - getter for name property
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param $password string - setter for password property
     */
    public function setPassword(string $password) {
        $this->password = $password;
    }

    /**
     * @return string - getter for password property
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param bool $admin - setter for admin property
     */
    public function setAdmin(bool $admin) {
        $this->admin = $admin;
    }

    /**
     * @return bool - getter for admin property
     */
    public function getAdmin() {
        return $this->admin;
    }
}
