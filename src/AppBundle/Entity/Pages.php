<?php
/**
 * Created by PhpStorm.
 * User: raul4916
 * Date: 3/25/16
 * Time: 3:48 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query\QueryException;

/**
 * @ORM\Entity
 * @ORM\Table(name="pages")
 */
class Pages
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type = "bigint")
     */
    protected $id;
    /**
     * @ORM\Column(name = "website", type = "string", unique = true)
     */
    protected $website;
    /**
     * @ORM\ManyToOne(targetEntity = "Channels", inversedBy = "pages")
     */
    protected $channel;
    /**
     * @ORM\OneToMany(targetEntity = "Surveys", mappedBy = "pages")
     */
    protected $surveys;
    /**
     * @ORM\ManyToMany(targetEntity = "Tags", mappedBy = "page")
     */
    protected $tags= null;
    /**
     * @ORM\OneToMany(targetEntity = "Reports", mappedBy = "page")
     */
    protected $reports;

    /**
     * Constructor
     */
    public function __construct($website, $channel = null)
    {
        $this->fullWebsite = $website;
        $this->channel = $channel;
        $this->survey = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set fullWebsite
     *
     * @param string $fullWebsite
     *
     * @return Pages
     */
    public function setWebsite($fullWebsite)
    {
        $this->website = $fullWebsite;
        return $this;
    }

    /**
     * Get fullWebsite
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }
    /**
     * Set channel
     *
     * @param \AppBundle\Entity\Channels $channel
     *
     * @return Pages
     */
    public function setChannel(\AppBundle\Entity\Channels $channel = null)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Get channel
     *
     * @return \AppBundle\Entity\Channels
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Add survey
     *
     * @param \AppBundle\Entity\Surveys $survey
     *
     * @return Pages
     */
    public function addSurvey(\AppBundle\Entity\Surveys $survey)
    {
        $this->survey[] = $survey;

        return $this;
    }

    /**
     * Remove survey
     *
     * @param \AppBundle\Entity\Surveys $survey
     */
    public function removeSurvey(\AppBundle\Entity\Surveys $survey)
    {
        $this->survey->removeElement($survey);
    }

    /**
     * Get survey
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSurvey()
    {
        return $this->survey;
    }
    /**
     * Add tag
     *
     * @param \AppBundle\Entity\Tags $tag
     *
     * @return Pages
     */
    public function addTag(\AppBundle\Entity\Tags $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \AppBundle\Entity\Tags $tag
     */
    public function removeTag(\AppBundle\Entity\Tags $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }
    /**
     * Add report
     *
     * @param \AppBundle\Entity\Reports $report
     *
     * @return Pages
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
