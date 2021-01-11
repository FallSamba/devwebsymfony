<?php
namespace App\Entity;



class Platsearch {





/**
 * @var text|null
 */
 private $name;







 


    /**
     * @return text|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param text|null $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}










?>