<?php

namespace AppBundle\Pwa;

class Page
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $objectName;

    public function __construct($id, $objectName)
    {
        $this->id = $id;
        $this->objectName = $objectName;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getObjectName()
    {
        return $this->objectName;
    }
}
