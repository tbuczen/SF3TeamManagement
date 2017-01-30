<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Mixins\TimestampTrait;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Sluggable\Util as Sluggable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Player
 *
 * @ORM\Table(name="player", indexes={@ORM\Index(name="fk_player_team1_idx", columns={"team_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayerRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Player
{
    use TimestampTrait;

    const POSITION_GOALKEEPER = "Goalkeeper";
    const POSITION_MIDFIELD = "Midfield";
    const POSITION_ATTACKING = "Attacking";
    const POSITION_DEFENSIVE = "Defensive";

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "Country name must be at least {{ limit }} characters long",
     *      maxMessage = "Country name cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(name="name", type="string", length=20, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=45, nullable=true)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=70, nullable=true)
     */
    private $slug;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="datetime", nullable=true)
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", columnDefinition="ENUM('Goalkeeper', 'Midfield', 'Attacking', 'Defensive') NOT NULL DEFAULT 'Midfield'"))
     */
    private $position;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Team
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Team")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     * })
     */
    private $team;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        $now = new \DateTime('now');
        $age = $this->birthday->diff($now);
        return $age->format('%y');
    }

    /**
     * @param \DateTime $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @param Team $team
     */
    public function setTeam($team)
    {
        $this->team = $team;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function __toString()
    {
        return (string) $this->id;
    }

    /**
     * @ORM\PrePersist
     */
    public function updateSlug()
    {
        $toSlug = $this->name . " " . $this->surname;
        $slug = Sluggable\Urlizer::urlize($toSlug, '');
        $this->setSlug($slug);
    }

    static function getPossiblePositions() {
        $oClass = new \ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }

}

