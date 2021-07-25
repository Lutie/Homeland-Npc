<?php

namespace App\Type;

use App\Entity\Character;
use App\Entity\Particularity;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ])
            ->add('defaults', EntityType::class, [
                'label' => 'entity.character.defaults',
                'class' => Particularity::class,
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('particularity')
                        ->where('particularity.type = 0');
                },
            ])
            ->add('ethnic', EntityType::class, [
                'label' => 'entity.character.ethnic',
                'class' => Particularity::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('particularity')
                        ->where('particularity.type = 1');
                },
            ])
            ->add('morphologies', EntityType::class, [
                'label' => 'entity.character.morphologies',
                'class' => Particularity::class,
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('particularity')
                        ->where('particularity.type = 2');
                },
            ])
            ->add('occupation', EntityType::class, [
                'label' => 'entity.character.occupation',
                'class' => Particularity::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('particularity')
                        ->where('particularity.type = 3');
                },
            ])
            ->add('job', EntityType::class, [
                'label' => 'entity.character.job',
                'class' => Particularity::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('particularity')
                        ->where('particularity.type = 4');
                },
            ])
            ->add('character', EntityType::class, [
                'label' => 'entity.character.character',
                'class' => Particularity::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('particularity')
                        ->where('particularity.type = 5');
                },
            ])
            ->add('alignement', EntityType::class, [
                'label' => 'entity.character.alignement',
                'class' => Particularity::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('particularity')
                        ->where('particularity.type = 6');
                },
            ])
            ->add('persona', EntityType::class, [
                'label' => 'entity.character.persona',
                'class' => Particularity::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('particularity')
                        ->where('particularity.type = 7');
                },
            ])
            ->add('manias', EntityType::class, [
                'label' => 'entity.character.manias',
                'class' => Particularity::class,
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('particularity')
                        ->where('particularity.type = 8');
                },
            ])
            ->add('distinctives', EntityType::class, [
                'label' => 'entity.character.distinctives',
                'class' => Particularity::class,
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('particularity')
                        ->where('particularity.type = 9');
                },
            ])
            ->add('culturals', EntityType::class, [
                'label' => 'entity.character.culturals',
                'class' => Particularity::class,
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('particularity')
                        ->where('particularity.type = 10');
                },
            ])
            ->add('liabilities', EntityType::class, [
                'label' => 'entity.character.liabilities',
                'class' => Particularity::class,
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('particularity')
                        ->where('particularity.type = 11');
                },
            ])
            ->add('universe', EntityType::class, [
                'label' => 'entity.character.universe',
                'class' => Particularity::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('particularity')
                        ->where('particularity.type = 12');
                },
            ])
            ->add('size', EntityType::class, [
                'label' => 'entity.character.size',
                'class' => Particularity::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('particularity')
                        ->where('particularity.type = 13');
                },
            ])
            ->add('stature', EntityType::class, [
                'label' => 'entity.character.stature',
                'class' => Particularity::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('particularity')
                        ->where('particularity.type = 14');
                },
            ]);
    }
}