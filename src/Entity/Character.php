<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="characters")
 */
class Character
{
    const SEX_UNDEFINED = 0;
    const SEX_MALE = 1;
    const SEX_FEMALE = 2;

    const SEX_TYPES = [
        'male' => self::SEX_MALE,
        'female' => self::SEX_FEMALE,
        'unknown' => self::SEX_UNDEFINED
    ];

    use IdTrait;

    use DescriptionTrait;

    use AttributesTrait;

    use ParticularityTrait;

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
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\Type("\DateTimeInterface")
     */
    private $createAt;

    /**
     * @ORM\Column()
     * @Assert\NotNull()
     * @Assert\Type("integer")
     */
    private $sex = self::SEX_UNDEFINED;

    /**
     * @ORM\Column()
     * @Assert\NotNull()
     * @Assert\Type("integer")
     */
    private $age;

    public function __construct()
    {
        $this->particularities = new ArrayCollection();
        $this->attributes = new ArrayCollection();
        $this->createAt = new \DateTime();
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getCreateAt()
    {
        return $this->createAt;
    }

    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;
    }

    public function getSex()
    {
        return $this->sex;
    }

    public function setSex($sex)
    {
        $this->sex = $sex;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }
}
