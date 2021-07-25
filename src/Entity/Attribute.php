<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="attributes")
 */
class Attribute
{
    use IdTrait;

    use NameTrait;

    use DescriptionTrait;

    /**
     * @ORM\Column(name="isPrimary", type="boolean", options={"default":"0"})
     */
    private $isPrimary = true;

    public function getIsPrimary()
    {
        return $this->isPrimary;
    }

    public function setIsPrimary($isPrimary)
    {
        $this->isPrimary = $isPrimary;
    }
}
