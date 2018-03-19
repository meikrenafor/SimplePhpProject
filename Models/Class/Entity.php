<?php

/**
 * Class Entity
 */
abstract class Entity
{
    /**
     * @var - id property
     */
    protected $id;

    /**
     * @param int $id - setter for id property
     */
    public function setId(int $id) {
        $this->id = $id;
    }

    /**
     * @return mixed - getter for id property
     */
    public function getId() {
        return $this->id;
    }
}
