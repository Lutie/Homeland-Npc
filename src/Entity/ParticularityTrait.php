<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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

    public function addParticularities($particularity)
    {
        if (is_array($particularity)) {
            $array = $particularity;
        } else {
            $array = [$particularity];
        }

        foreach ($array as $value) {
            if (!$this->particularities->contains($value)) {
                $this->particularities->add($value);
            }
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

    public function clearParticularities()
    {
        $this->particularities = new ArrayCollection();

        return $this;
    }
}