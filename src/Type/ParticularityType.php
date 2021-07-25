<?php

namespace App\Type;

use App\Entity\Attribute;
use App\Entity\Particularity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class ParticularityType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder
            ->add('type', ChoiceType::class, [
                'label' => 'entity.particularity.type',
                'choices' => Particularity::PARTICULARITY_TYPES,
            ])
            ->add('name', TextType::class, [
                'label' => 'entity.particularity.name',
            ])
            ->add('description', TextType::class, [
                'label' => 'entity.particularity.description',
                'required' => false,
            ])
            ->add('attributes', EntityType::class, [
                'label' => 'entity.character.attribute',
                'class' => Attribute::class,
                'multiple' => true
            ])
            ->add('ratio', IntegerType::class, [
                'label' => 'entity.particularity.ratio',
            ]);
    }

}
