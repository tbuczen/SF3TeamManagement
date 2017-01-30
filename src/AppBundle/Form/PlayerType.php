<?php

namespace AppBundle\Form;

use AppBundle\Entity\Country;
use AppBundle\Entity\Player;
use AppBundle\Entity\Team;
use AppBundle\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{

    private $em;

    function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('surname');
        $builder->add('position',ChoiceType::class, array(
            'choices' => Player::getPossiblePositions(),
        ));

        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
    }

    protected function addElements(FormInterface $form, Country $country = null) {
        $form->add('country', EntityType::class, array(
            'class'       => 'AppBundle:Country',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('c')
                    ->orderBy('c.name', 'ASC');
            },
            'data' => $country,
            'choice_label' => 'name',
            'mapped' => false,
        ));


        if($country == null) {
            $country = $this->em->getRepository('AppBundle:Country')->findOneBy([], ["name" => "asc"]);
        }

        $teamOptions = array(
            'class'       => 'AppBundle:Team',
            'query_builder' => function (TeamRepository $tr) use ($country) {
                return $tr->findByCountryQB($country->getId());
            },
            'choice_label' => 'name',
        );

        $form->add('team',  EntityType::class, $teamOptions);

    }


    function onPreSetData(FormEvent $event)
        /** @var Player $player */{
        $player = $event->getData();
        $form = $event->getForm();

        $country = $player->getTeam() ? $player->getTeam()->getCountry() : null;
        $this->addElements($form, $country);
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
