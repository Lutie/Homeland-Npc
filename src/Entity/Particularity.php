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
    const QUALITY = 15;
    const IDEAL = 16;

    const PARTICULARITY_TYPES_BY_STR = [
        'defaults' => self::DEFAULT,
        'ethnic' => self::ETHNIC,
        'morphologies' => self::MORPHOLOGY,
        'occupation' => self::OCCUPATION,
        'job' => self::JOB,
        'character' => self::CHARACTER,
        'alignement' => self::ALIGNEMENT,
        'persona' => self::PERSONA,
        'manias' => self::MANIA,
        'distinctives' => self::DISTINCTIVE,
        'cultural' => self::CULTURAL,
        'liabilities' => self::LIABILITY,
        'universe' => self::UNIVERSE,
        'size' => self::SIZE,
        'stature' => self::STATURE,
        'quality' => self::QUALITY,
        'ideal' => self::IDEAL
    ];

    const PARTICULARITY_TYPES_BY_INT = [
        self::DEFAULT => 'defaults',
        self::ETHNIC => 'ethnic',
        self::MORPHOLOGY => 'morphologies',
        self::OCCUPATION => 'occupation',
        self::JOB => 'job',
        self::CHARACTER => 'character',
        self::ALIGNEMENT => 'alignement',
        self::PERSONA => 'persona',
        self::MANIA => 'manias',
        self::DISTINCTIVE => 'distinctives',
        self::CULTURAL => 'cultural',
        self::LIABILITY => 'liabilities',
        self::UNIVERSE => 'universe',
        self::SIZE => 'size',
        self::STATURE => 'stature',
        self::QUALITY => 'quality',
        self::IDEAL => 'ideal'
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
