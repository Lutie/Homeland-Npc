<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait ParticularityTrait
{
    /**
     * @ORM\ManyToMany(targetEntity="Particularity")
     * @ORM\JoinColumn(name="particularities")
     */
    private $particularities;

    public function getParticularities()
    {
        return $this->particularities;
    }

    public function setParticularities($particularities)
    {
        $this->particularities = $particularities;
    }

    public function addParticularities(Particularity $particularity)
    {
        if (!$this->particularities->contains($particularity)) {
            $this->particularities->add($particularity);
        }

        return $this;
    }

    public function removeParticularities(Particularity $particularity)
    {
        if ($this->particularities->contains($particularity)) {
            $this->particularities->removeElement($particularity);
        }

        return $this;
    }
}