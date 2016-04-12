<?php
/**
 * Created by PhpStorm.
 * User: raul
 * Date: 2/11/16
 * Time: 6:34 PM
 */

namespace AppBundle\Entity;

use Symfony\Component\Debug\ErrorHandler;
use AppBundle\lib\DefinitionLib;
use AppBundle\Entity\Users;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="surveys")
 */
class Surveys
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     * @ORM\Column(type="bigint")
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity = "Users", inversedBy="surveys");
     */
    protected $user;
    /**
     * @ORM\ManyToOne(targetEntity = "Channels", inversedBy = "surveys");
     */
    protected $channel;
    /**
     * @ORM\Column(type="string")
     */
    protected $question;
    /*
     * @ORM\Column(type="integer")
     */
    protected $type;
    /**
     * @ORM\ManyToMany(targetEntity = "Responses", inversedBy = "surveys");
     */
    protected $responses;
    /**
     * @ORM\Column(type="integer")
     */
    protected $allowComments;
    /**
     * @ORM\ManyToMany(targetEntity="Groups", inversedBy = "surveys")
     */
    protected $groupAllowed;
    /**
     * @ORM\Column(type = "integer")
     */
    protected $recommended;
    /**
     * @ORM\Column(type = "integer")
     */
    protected $boring;
    /**
     * @ORM\Column(type = "integer")
     */
    protected $requests;
    /**
     * @ORM\Column(type="integer")
     */
    protected $date_created;
    /**
     * @ORM\Column(type="integer")
     */
    protected $date_modified;
    /**
     * @ORM\Column(type = "integer")
     */
    protected $survey_status;
    /**
     * @ORM\ManyToOne(targetEntity = "Pages", inversedBy="survey")
     */
    protected $pages;
    /**
     *
     */
    protected $categories;
    /**
     * @ORM\ManyToMany(targetEntity = "Tags", mappedBy="surveys")
     */
    protected $tags;
    /**
     * @ORM\OneToMany(targetEntity = "Reports", mappedBy = "survey")
     */
    protected $reports;

    /**
     * Survey constructor.
     * @param $user
     * @param $question
     * @param $type
     * @param $responses
     * @param $allow_comments
     */
    public function __construct($user, $question, $type, $responses,
                                $allow_comments, $pages=null, $channel=null)
    {
        $this->user = $user;
        $this->question = $question;
        $this->type = $type;
        foreach($responses as $temp){
            $temp->setResults($this->id,0);
        }
        $this->responses = $responses;
        $this->allow_comments = $allow_comments;
        $this->recommended = 0;
        $this->boring = 0;
        $this->requests = 0;
        $this->survey_status = DefinitionLib::ACTIVE;
        $this->date_created = time();
        $this->date_modified = time();
        $this->pages = $pages;
        $this->channel = $channel;
        $this->groupAllowed = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reports = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getResponses()
    {
        return $this->responses;
    }

    /**
     * @param mixed $responses
     */
    public function setResponses($responses)
    {
        $this->responses = $responses;
    }

    /**
     * @return mixed
     */
    public function getAllowComments()
    {
        return $this->allow_comments;
    }

    /**
     * @param mixed $allow_comments
     */
    public function setAllowComments($allow_comments)
    {
        $this->allow_comments = $allow_comments;
    }

    /**
     * @return mixed
     */
    public function getRecommended()
    {
        return $this->recommended;
    }

    /**
     * @param mixed $recommended
     */
    public function setRecommended($recommended)
    {
        $this->recommended = $recommended;
    }

    public function increaseRecommended(){
        $num = $this->getRecommended()+1;
        $this->setRecommended($num);
    }
    /**
     * @return mixed
     */
    public function getBoring()
    {
        return $this->boring;
    }
    /**
     * @param mixed $boring
     */
    public function setBoring($boring)
    {
        $this->boring = $boring;
    }

    public function increaseBoring(){
        $numBore = $this->getBoring()+1;
        $this->setBoring($numBore);
    }
    /**
     * @return mixed
     */
    public function getRequests()
    {
        return $this->requests;
    }

    /**
     * @param mixed $requests
     */
    public function setRequests($requests)
    {
        $this->requests = $requests;
    }
    public function increaseRequest(){
        $numReq = $this->getRequests()+1;
        $this->setRequests($numReq);
    }

    /**
     * @return mixed
     */
    public function getSurveyStatus()
    {
        return $this->survey_status;
    }

    /**
     * @param mixed $survey_status
     */
    public function setSurveyStatus($survey_status)
    {
        $this->survey_status = $survey_status;
    }

    /**
     * @return mixed
     */
    public function getDateModified()
    {
        return $this->date_modified;
    }

    /**
     * @param mixed $date_modified
     */
    public function setDateModified($date_modified)
    {
        $this->date_modified = $date_modified;
    }

    /**
     * @return mixed
     */
    public function getDateCreated()
    {
        return $this->date_created;
    }



    /**
     * Set dateCreate
     *
     * @param integer $dateCreate
     *
     * @return Surveys
     */
    public function setDateCreated($dateCreate)
    {
        $this->date_created = $dateCreate;

        return $this;
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
     * Set channel
     *
     * @param \AppBundle\Entity\Channels $channel
     *
     * @return Surveys
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
     * Set user
     *
     * @param \AppBundle\Entity\Users $user
     *
     * @return Surveys
     */
    public function setUser(\AppBundle\Entity\Users $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\Users
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set pages
     *
     * @param \AppBundle\Entity\Pages $pages
     *
     * @return Surveys
     */
    public function setPages(\AppBundle\Entity\Pages $pages = null)
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * Get pages
     *
     * @return \AppBundle\Entity\Pages
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Set tags
     *
     * @param integer $tags
     *
     * @return Surveys
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return integer
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set categories
     *
     * @param \AppBundle\Entity\Categories $categories
     *
     * @return Surveys
     */
    public function setCategories(\AppBundle\Entity\Categories $categories = null)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Get categories
     *
     * @return \AppBundle\Entity\Categories
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add category
     *
     * @param \AppBundle\Entity\Categories $category
     *
     * @return Surveys
     */
    public function addCategory(\AppBundle\Entity\Categories $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \AppBundle\Entity\Categories $category
     */
    public function removeCategory(\AppBundle\Entity\Categories $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Add groupAllowed
     *
     * @param \AppBundle\Entity\Groups $groupAllowed
     *
     * @return Surveys
     */
    public function addGroupAllowed(\AppBundle\Entity\Groups $groupAllowed)
    {
        $this->groupAllowed[] = $groupAllowed;

        return $this;
    }

    /**
     * Remove groupAllowed
     *
     * @param \AppBundle\Entity\Groups $groupAllowed
     */
    public function removeGroupAllowed(\AppBundle\Entity\Groups $groupAllowed)
    {
        $this->groupAllowed->removeElement($groupAllowed);
    }

    /**
     * Get groupAllowed
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroupAllowed()
    {
        return $this->groupAllowed;
    }

    /**
     * Add response
     *
     * @param \AppBundle\Entity\Responses $response
     *
     * @return Surveys
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
     * Add tag
     *
     * @param \AppBundle\Entity\Tags $tag
     *
     * @return Surveys
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
     * Add report
     *
     * @param \AppBundle\Entity\Reports $report
     *
     * @return Surveys
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
    /**
     * Constructor
     */


}
