<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait AttributesTrait
{
    /**
     * @ORM\ManyToMany(targetEntity="Attribute")
     * @ORM\JoinColumn(name="attributes")
     */
    private $attributes;

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    public function addAttributes(Attribute $attribute)
    {
        if (!$this->attributes->contains($attribute)) {
            $this->attributes->add($attribute);
        }

        return $this;
    }

    public function removeAttributes(Attribute $attribute)
    {
        if ($this->attributes->contains($attribute)) {
            $this->attributes->removeElement($attribute);
        }

        return $this;
    }
}