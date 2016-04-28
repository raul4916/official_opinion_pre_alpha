<?php
/**
 * Created by PhpStorm.
 * User: raul4916
 * Date: 4/10/16
 * Time: 9:18 PM
 */
namespace AppBundle\Entity;

use Symfony\Component\Debug\ErrorHandler;
use AppBundle\lib\DefinitionLib;
use AppBundle\Entity\Users;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tags")
 */

class Tags{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     * @ORM\Column(type="bigint")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", unique = true)
     */
    protected $tag;
    /**
     * @ORM\ManyToMany(targetEntity = "Surveys", inversedBy = "tags")
     */
    protected $surveys= null;
    /**
     * @ORM\ManyToMany(targetEntity = "Channels", inversedBy = "tags")
     */
    protected $channels = null;
    /**
     * @ORM\ManyToMany(targetEntity = "Pages", inversedBy = "tags")
     */
    protected $pages= null;
    /**
     * @ORM\ManyToMany(targetEntity = "Responses", inversedBy = "tags")
     */
    protected $responses;
    /**
     * @ORM\OneToMany(targetEntity = "Reports", mappedBy = "tag")
     */
    protected $reports;


    /**
     * Constructor
     */
    public function __construct($tag)
    {
        $this->tag = $tag;
        $this->surveys = new \Doctrine\Common\Collections\ArrayCollection();
        $this->channels = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->responses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reports = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set tag
     *
     * @param string $tag
     *
     * @return Tags
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Add survey
     *
     * @param \AppBundle\Entity\Surveys $survey
     *
     * @return Tags
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
     * Add channel
     *
     * @param \AppBundle\Entity\Channels $channel
     *
     * @return Tags
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
     * Add page
     *
     * @param \AppBundle\Entity\Pages $page
     *
     * @return Tags
     */
    public function addPage(\AppBundle\Entity\Pages $page)
    {
        $this->pages[] = $page;

        return $this;
    }

    /**
     * Remove page
     *
     * @param \AppBundle\Entity\Pages $page
     */
    public function removePage(\AppBundle\Entity\Pages $page)
    {
        $this->pages->removeElement($page);
    }

    /**
     * Get pages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Add response
     *
     * @param \AppBundle\Entity\Responses $response
     *
     * @return Tags
     */
    public function addResponse(\AppBundle\Entity\Responses $response)
    {
        $this->responses[] = $response;

        return $this;
    }

    /**
     * Remove response
     *
     * @param \AppBundle\Entity\Responses $response
     */
    public function removeResponse(\AppBundle\Entity\Responses $response)
    {
        $this->responses->removeElement($response);
    }

    /**
     * Get responses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResponses()
    {
        return $this->responses;
    }

    /**
     * Add report
     *
     * @param \AppBundle\Entity\Reports $report
     *
     * @return Tags
     */
    public function addReport(\AppBundle\Entity\Reports $report)
    {
        $this->reports[] = $report;

        return $this;
    }

    /**
     * Remove report
     *
     * @param \AppBundle\Entity\Reports $report
     */
    public function removeReport(\AppBundle\Entity\Reports $report)
    {
        $this->reports->removeElement($report);
    }

    /**
     * Get reports
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReports()
    {
        return $this->reports;
    }
}
