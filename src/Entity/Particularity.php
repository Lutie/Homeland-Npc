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
    const HEAR_COLOR = 1;
    const HEAR_STYLE = 2;
    const EYE_COLOR = 3;
    const CHARACTER = 4;
    const ALIGNEMENT = 5;
    const PERSONALITY = 6;
    const ATTITUDE = 7;
    const JOB = 8;
    const OCCUPATION = 9;
    const MANIA = 10;
    const DISTINCTIVE = 11;
    const CULTURAL = 12;
    const ETHNIC = 13;
    const LIABILITY = 14;
    const UNIVERSE = 15;

    const PARTICULARITY_TYPES = [
        self::DEFAULT => 'default',
        self::HEAR_COLOR => 'hearcolor',
        self::HEAR_STYLE => 'hearstyle',
        self::EYE_COLOR => 'eyecolor',
        self::CHARACTER => 'character',
        self::ALIGNEMENT => 'alignement',
        self::PERSONALITY => 'personality',
        self::ATTITUDE => 'attitude',
        self::JOB => 'job',
        self::OCCUPATION => 'occupation',
        self::MANIA => 'mania',
        self::DISTINCTIVE => 'distinctive',
        self::CULTURAL => 'cultural',
        self::ETHNIC => 'ethnic',
        self::LIABILITY => 'liability',
        self::UNIVERSE => 'universe'
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
