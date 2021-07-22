<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CharacterRepository")
 * @ORM\Table(name="characters")
 */
class Character extends AbstractType
{

    use IdTrait;

    /**
     * @ORM\Column()
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Assert\Length(min=2, max=50)
     */
    private $firstname;

    /**
     * @ORM\Column()
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Assert\Length(min=2, max=50)
     */
    private $lastname;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="characters")
     */
    private $author;

    /**
     * @ORM\Column(type="createAt")
     * @Assert\Date()
     */
    private $createdAt;

    /**
     * @ORM\Column()
     * @Assert\NotNull()
     */
    private $sex;

    /**
     * @ORM\Column()
     * @Assert\NotNull()
     * @Assert\Type("integer")
     */
    private $age;

    /**
     * @ORM\ManyToMany(targetEntity="Morphology")
     */
    private $morphology;

    /**
     * @ORM\ManyToOne(targetEntity="Personality")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     * @Assert\NotNull()
     */
    private $personality;

    /**
     * @ORM\ManyToMany(targetEntity="Particularity")
     */
    private $particularities;

    /**
     * @ORM\ManyToMany(targetEntity="Liability")
     */
    private $liabilities;

    /**
     * @ORM\ManyToOne(targetEntity="Ethnic")
     * @ORM\Column(nullable=true)
     */
    private $ethnic;

    /**
     *
     */
    private $size;

    /**
     *
     */
    private $weight;

    /**
     *
     */
    private $build;

    public function __construct()
    {
        $this->particularities = new ArrayCollection();
        $this->liabilities = new ArrayCollection();
        $this->morphology = new ArrayCollection();

        $this->date = new \DateTime();
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Character
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Character
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Character
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set universe
     *
     * @param string $universe
     *
     * @return Character
     */
    public function setUniverse($universe)
    {
        $this->universe = $universe;

        return $this;
    }

    /**
     * Get universe
     *
     * @return string
     */
    public function getUniverse()
    {
        return $this->universe;
    }

    /**
     * Set sex
     *
     * @param string $sex
     *
     * @return Character
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set age
     *
     * @param string $age
     *
     * @return Character
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return string
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set ethnic
     *
     * @param string $ethnic
     *
     * @return Character
     */
    public function setEthnic($ethnic)
    {
        $this->ethnic = $ethnic;

        return $this;
    }

    /**
     * Get ethnic
     *
     * @return string
     */
    public function getEthnic()
    {
        return $this->ethnic;
    }

    /**
     * Set author
     *
     * @param \AppBundle\Entity\User $author
     *
     * @return Character
     */
    public function setAuthor(\AppBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \AppBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set personality
     *
     * @param \AppBundle\Entity\Personality $personality
     *
     * @return Character
     */
    public function setPersonality(\AppBundle\Entity\Personality $personality)
    {
        $this->personality = $personality;

        return $this;
    }

    /**
     * Get personality
     *
     * @return \AppBundle\Entity\Personality
     */
    public function getPersonality()
    {
        return $this->personality;
    }

    /**
     * Get particularities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticularities()
    {
        return $this->particularities;
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

    /**
     * Get liabilities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLiabilities()
    {
        return $this->liabilities;
    }


    public function addLiabilities(Liability $liability)
    {
        if (!$this->liabilities->contains($liability)) {
            $this->liabilities->add($liability);
        }

        return $this;
    }

    public function removeLiabilities(Liability $liability)
    {
        if ($this->liabilities->contains($liability)) {
            $this->liabilities->removeElement($liability);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMorphology()
    {
        return $this->morphology;
    }

    public function addMorphology(Morphology $morphology)
    {
        if (!$this->morphology->contains($morphology)) {
            $this->morphology->add($morphology);
        }

        return $this;
    }

    public function removeMorphology(Morphology $morphology)
    {
        if ($this->morphology->contains($morphology)) {
            $this->morphology->removeElement($morphology);
        }

        return $this;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function getBuild()
    {
        return $this->build;
    }

    public function setBuild($build)
    {
        $this->build = $build;
    }

}
