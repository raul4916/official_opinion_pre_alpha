<?php
/**
 * Created by PhpStorm.
 * User: raul4916
 * Date: 3/25/16
 * Time: 3:48 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Query\QueryException;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="categories")
 */
class Categories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type = "integer")
     */
    protected $id;
    /**
     * @ORM\Column(type = "string", unique = true)
     */
    protected $name;
    /**
     * @ORM\Column(type = "string")
     */
    protected $description;
    /**
     * @ORM\ManyToMany(targetEntity = "Channels", mappedBy="categories")
     */
    protected $channels;
    /**
     * @ORM\ManyToMany(targetEntity = "Surveys", mappedBy="categories")
     */
    protected $surveys;
    /**
     * Constructor
     */
    public function __construct($name,$description)
    {
        $this->name = $name;
        $this->description = $description;
        $this->channels = new \Doctrine\Common\Collections\ArrayCollection();
        $this->surveys = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Categories
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Categories
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add channel
     *
     * @param \AppBundle\Entity\Channels $channel
     *
     * @return Categories
     */
    public function addChannel(\AppBundle\Entity\Channels $channel)
    {
        $this->channels[] = $channel;

        return $this;
    }

    /**
     * Remove channel
     *
     * @param \AppBundle\Entity\Channels $channel
     */
    public function removeChannel(\AppBundle\Entity\Channels $channel)
    {
        $this->channels->removeElement($channel);
    }

    /**
     * Get channels
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChannels()
    {
        return $this->channels;
    }

    /**
     * Set surveys
     *
     * @param \AppBundle\Entity\Surveys $surveys
     *
     * @return Categories
     */
    public function setSurveys(\AppBundle\Entity\Surveys $surveys = null)
    {
        $this->surveys = $surveys;

        return $this;
    }

    /**
     * Get surveys
     *
     * @return \AppBundle\Entity\Surveys
     */
    public function getSurveys()
    {
        return $this->surveys;
    }

    /**
     * Add survey
     *
     * @param \AppBundle\Entity\Surveys $survey
     *
     * @return Categories
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
}
