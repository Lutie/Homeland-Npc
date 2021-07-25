<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait SummaryTrait
{
    /**
     * @ORM\Column()
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Assert\Length(min=10)
     */
    private $summary;

    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    public function getSummary()
    {
        return $this->summary;
    }
}