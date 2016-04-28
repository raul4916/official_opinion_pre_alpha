<?php

/**
 * Created by PhpStorm.
 * User: raul4916
 * Date: 3/25/16
 * Time: 3:49 PM
 */

namespace AppBundle\Entity;

use AppBundle\lib\DefinitionLib;
use Doctrine\ORM\Query\QueryException;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Users;

/**
 * @ORM\Entity
 * @ORM\Table(name="reports")
 */
class Reports
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type = "integer")
     */
    protected $id;
    /**
     * @ORM\Column(type = "integer")
     */
    protected $status;
    /**
     * @ORM\Column(type = "integer")
     */
    protected $count;
    /**
     * @ORM\Column(type="array", nullable=true)
     */
    protected $reasons = array();
    /**
     * @ORM\ManyToOne(targetEntity = "Surveys", inversedBy = "reports")
     */
    protected $survey;
    /**
     * @ORM\ManyToOne(targetEntity = "Users", inversedBy = "reports")
     */
    protected $user;
    /**
     * @ORM\ManyToOne(targetEntity = "Channels", inversedBy = "reports")
     */
    protected $channel;
    /**
     * @ORM\ManyToOne(targetEntity = "Responses", inversedBy = "reports")
     */
    protected $response;
    /**
     * @ORM\ManyToOne(targetEntity = "Pages", inversedBy = "reports")
     */
    protected $page;
    /**
     * @ORM\ManyToOne(targetEntity = "Tags", inversedBy = "reports")
     */
    protected $tag;

    /**
     * Reports constructor.
     * @param array $reasons
     * @param $survey
     * @param $user
     * @param $channel
     * @param $response
     * @param $page
     * @param $tag
     */
    public function __construct( Surveys $survey = null, Users $user = null, Channels $channel = null, Responses $response = null,
                                    Pages $page = null, Tags $tag = null,\Doctrine\Common\Collections\ArrayCollection $reasons)
    {
        $this->status = DefinitionLib::ACTIVE;
        $this->count = 1;
        $this->reasons = $reasons;
        $this->survey = $survey;
        $this->user = $user;
        $this->channel = $channel;
        $this->response = $response;
        $this->page = $page;
        $this->tag = $tag;
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
     * Set status
     *
     * @param integer $status
     *
     * @return Reports
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set count
     *
     * @param integer $count
     *
     * @return Reports
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set reasons
     *
     * @param array $reasons
     *
     * @return Reports
     */
    public function setReasons($reasons)
    {
        $this->reasons = $reasons;

        return $this;
    }

    /**
     * Get reasons
     *
     * @return array
     */
    public function getReasons()
    {
        return $this->reasons;
    }

    /**
     * Set survey
     *
     * @param \AppBundle\Entity\Survey $survey
     *
     * @return Reports
     */
    public function setSurvey(\AppBundle\Entity\Survey $survey = null)
    {
        $this->survey = $survey;

        return $this;
    }

    /**
     * Get survey
     *
     * @return \AppBundle\Entity\Survey
     */
    public function getSurvey()
    {
        return $this->survey;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\Users $user
     *
     * @return Reports
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
     * Set channel
     *
     * @param \AppBundle\Entity\Channels $channel
     *
     * @return Reports
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
     * Set response
     *
     * @param \AppBundle\Entity\Responses $response
     *
     * @return Reports
     */
    public function setResponse(\AppBundle\Entity\Responses $response = null)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get response
     *
     * @return \AppBundle\Entity\Responses
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set page
     *
     * @param \AppBundle\Entity\Pages $page
     *
     * @return Reports
     */
    public function setPage(\AppBundle\Entity\Pages $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \AppBundle\Entity\Pages
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set tag
     *
     * @param \AppBundle\Entity\Tags $tag
     *
     * @return Reports
     */
    public function setTag(\AppBundle\Entity\Tags $tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \AppBundle\Entity\Tags
     */
    public function getTag()
    {
        return $this->tag;
    }
}
