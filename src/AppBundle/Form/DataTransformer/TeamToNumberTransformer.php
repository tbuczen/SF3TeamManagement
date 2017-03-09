<?php

namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Team;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class TeamToNumberTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  Team|null $team
     * @return string
     */
    public function transform($team)
    {
        if (null === $team) {
            return '';
        }
        return $team->getId();
    }

    /**
     * @param  string $teamNumber
     * @return Team|null
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($teamNumber)
    {
        if (!$teamNumber) {
            return null;
        }

        $team = $this->manager ->getRepository('AppBundle:Team')->find($teamNumber);
        if ($team == null) {
            throw new TransformationFailedException(sprintf(
                'A team with id "%s" does not exist!',
                $teamNumber
            ));
        }

        return $team;
    }
}