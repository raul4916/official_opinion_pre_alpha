<?php
/**
 * Created by PhpStorm.
 * User: raul4916
 * Date: 4/8/16
 * Time: 12:27 AM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="groups")
 */
class Groups
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     * @ORM\Column(type="bigint")
     */
    protected $id;
    /**
     * @ORM\Column(type="string",unique = true)
     */
    protected $type;
    /**
     * @ORM\ManyToMany(targetEntity = "Surveys", mappedBy = "groupAllowed")
     */
    protected $surveys = null;
    /**
     * @ORM\OneToMany(targetEntity = "Users", mappedBy = "userGroup")
     */
    protected $users = null;
    /**
     * Constructor
     */
    public function __construct($type)
    {
        $this->type = $type;
        $this->surveys = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add survey
     *
     * @param \AppBundle\Entity\Surveys $survey
     *
     * @return Groups
     */
    public function addSurvey(\AppBundle\Entity\Surveys $survey)
    {
        $this->surveys[] = $survey;

        return $this;
    }

    /**
     * Remove survey
     *
     * @param \AppBundle\Entity\Surveys $survey
     */
    public function removeSurvey(\AppBundle\Entity\Surveys $survey)
    {
        $this->surveys->removeElement($survey);
    }

    /**
     * Get surveys
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSurveys()
    {
        return $this->surveys;
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\Users $user
     *
     * @return Groups
     */
    public function addUser(\AppBundle\Entity\Users $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\Users $user
     */
    public function removeUser(\AppBundle\Entity\Users $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Groups
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
