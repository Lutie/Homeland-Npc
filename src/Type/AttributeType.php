<?php

namespace App\Type;

use App\Entity\Attribute;
use App\Entity\Particularity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

class AttributeType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'entity.particularity.name',
            ])
            ->add('description', TextType::class, [
                'label' => 'entity.particularity.description',
                'required' => false,
            ])
            ->add('shortname', TextType::class, [
                'label' => 'entity.particularity.shortname',
                'required' => false,
            ])
            ->add('isPrimary', CheckboxType::class, [
                'label' => 'entity.particularity.isprimary',
            ]);
    }

}
