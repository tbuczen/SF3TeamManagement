<?php

namespace AppBundle\Form;

use AppBundle\Entity\Country;
use AppBundle\Entity\Player;
use AppBundle\Entity\Team;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('surname');
        $builder->add('position',ChoiceType::class, array(
            'choices' => Player::getPossiblePositions(),
        ));

        $builder->add('country', EntityType::class, array(
            'class'       => 'AppBundle:Country',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('c')
                    ->orderBy('c.name', 'ASC');
            },
            'choice_label' => 'name',
            'mapped' => false,
        ));

        $builder->add('team',  EntityType::class, array(
            'class'       => 'AppBundle:Team',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('t')
                    ->orderBy('t.name', 'ASC');
            },
            'choice_label' => 'name',
        ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Player::class,
        ));

        $resolver->setRequired('entity_manager');
    }

    public function getName()
    {
        return 'app_bundle_player_type';
    }
}
