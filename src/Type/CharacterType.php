<?php

namespace App\Type;

use App\Entity\Character;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class CharacterType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'entity.character.firstname',
            ])
            ->add('lastname', TextType::class, [
                'label' => 'entity.character.lastname',
            ])
            ->add('sex', ChoiceType::class, [
                'choices' => Character::SEX_TYPES,
                'label' => 'entity.character.sex'
            ])
            ->add('age', IntegerType::class, [
                'label' => 'entity.character.age',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'entity.character.description',
            ]);
    }

}