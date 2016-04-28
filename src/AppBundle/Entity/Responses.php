<?php
/**
 * Created by PhpStorm.
 * User: raul4916
 * Date: 4/10/16
 * Time: 9:34 PM
 */

namespace AppBundle\Entity;


use Symfony\Component\Debug\ErrorHandler;
use AppBundle\lib\DefinitionLib;
use AppBundle\Entity\Users;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="responses")
 */
class Responses
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     * @ORM\Column(type="bigint")
     */
    protected $id;
    /**
     * @ORM\Column(type="string")
     */
    protected $answer;
    /**
     * @ORM\ManyToMany(targetEntity = "Surveys", inversedBy = "responses");
     */
    protected $surveys;
    /**
     * @ORM\Column(type="array")
     * Put this in the constructor
     */
    protected $results;
    /**
     * @ORM\ManyToMany(targetEntity = "Tags", mappedBy = "responses")
     */
    protected $tags;
    /**
     * @ORM\OneToMany(targetEntity = "Reports", mappedBy = "response")
     */
    protected $reports;

    /**
     * Constructor
     */
    public function __construct($surveyID,$answer)
    {
        $this->answer= $answer;
        $this->results = new \Doctrine\Common\Collections\ArrayCollection();
        $this->surveys = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set answer
     *
     * @param string $answer
     *
     * @return Responses
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set results
     *
     * @param array $results
     *
     * @return Responses
     */
    public function setResults($surveyID,$amount)
    {
        $this->results[$surveyID] = $amount;
        return $this;
    }
    public function getResult($surveyID)
    {
        return $this->results[$surveyID];

    }
    /**
     * Get results
     *
     * @return array
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * Add survey
     *
     * @param \AppBundle\Entity\Surveys $survey
     *
     * @return Responses
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
     * Add tag
     *
     * @param \AppBundle\Entity\Tags $tag
     *
     * @return Responses
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
     * @return Responses
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
