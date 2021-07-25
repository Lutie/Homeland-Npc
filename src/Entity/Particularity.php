<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="particularities")
 */
class Particularity
{
    const DEFAULT = 0;
    const ETHNIC = 1;
    const MORPHOLOGY = 2;
    const OCCUPATION = 3;
    const JOB = 4;
    const CHARACTER = 5;
    const ALIGNEMENT = 6;
    const PERSONA = 7;
    const MANIA = 8;
    const DISTINCTIVE = 9;
    const CULTURAL = 10;
    const LIABILITY = 11;
    const UNIVERSE = 12;
    const SIZE = 13;
    const STATURE = 14;

    const PARTICULARITY_TYPES = [
        'default' => self::DEFAULT,
        'ethnic' => self::ETHNIC,
        'morphology' => self::MORPHOLOGY,
        'occupation' => self::OCCUPATION,
        'job' => self::JOB,
        'character' => self::CHARACTER,
        'alignement' => self::ALIGNEMENT,
        'persona' => self::PERSONA,
        'mania' => self::MANIA,
        'distinctive' => self::DISTINCTIVE,
        'cultural' => self::CULTURAL,
        'liability' => self::LIABILITY,
        'universe' => self::UNIVERSE,
        'size' => self::SIZE,
        'stature' => self::STATURE
    ];

    use IdTrait;

    use NameTrait;

    use DescriptionTrait;

    use RatioTrait;

    use AttributesTrait;

    /**
     * @ORM\Column()
     * @Assert\NotNull()
     * @Assert\Type("integer")
     */
    private $type = self::DEFAULT;

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }
}
