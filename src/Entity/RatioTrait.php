<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait RatioTrait
{
    /**
     * @ORM\Column(options={"default" = 0})
     * @Assert\Type("integer")
     */
    private $ratio;

    public function getRatio()
    {
        return $this->ratio;
    }

    public function setRatio($ratio)
    {
        $this->ratio = $ratio;
    }
}