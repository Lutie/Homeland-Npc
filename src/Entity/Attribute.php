<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column()
     * @Assert\Type("string")
     * @Assert\Length(min=2)
     * @Assert\Length(max=3)
     */
    private $shortname;

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

    public function setShortName($shortname)
    {
        $this->shortname = $shortname;

        return $this;
    }

    public function getShortName()
    {
        return $this->shortname;
    }
}
