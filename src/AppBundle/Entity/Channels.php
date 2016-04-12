<?php
/**
 * Created by PhpStorm.
 * User: raul4916
 * Date: 3/25/16
 * Time: 3:54 PM
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Query\QueryException;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Users;
use AppBundle\Entity\Categories;

/**
 * @ORM\Entity
 * @ORM\Table(name="channels")
 */
class Channels{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type = "bigint")
     */
    protected $id;

    /**
     * @ORM\Column(type = "string")
     */
    protected $name;

    /**
     * @ORM\ManyToMany(targetEntity = "Categories", inversedBy = "channels");
     */
    protected $categories;

    /**
     * @ORM\Column(type = "string")
     */
    protected $description;

    /**
     * @ORM\Column(type = "string")
     */
    protected $website;

    /**
     * @ORM\ManyToMany(targetEntity = "Channels", mappedBy = "channels")
     */
    protected $channels;

    /**
     * @ORM\OneToMany(targetEntity = "Users", mappedBy = "channels")
     */
    protected $members;

    /**
     * @ORM\OneToMany(targetEntity = "Users", mappedBy = "channels")
     */
    protected $subscribers;

    /**
     * @ORM\OneToMany(targetEntity = "Pages", mappedBy = "channel")
     */
    protected $pages;

    /**
     * @ORM\OneToMany(targetEntity = "Surveys", mappedBy = "channel")
     */
    protected $surveys;

    /**
     * @ORM\ManyToMany(targetEntity = "Tags", mappedBy = "channels")
     */
    protected $tags;
    /**
     * @ORM\OneToMany(targetEntity = "Reports", mappedBy = "channel")
     */
    protected $reports;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->channels = new \Doctrine\Common\Collections\ArrayCollection();
        $this->members = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subscribers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->surveys = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Channels
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
     * @return Channels
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
     * Set website
     *
     * @param string $website
     *
     * @return Channels
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set categories
     *
     * @param \AppBundle\Entity\Categories $categories
     *
     * @return Channels
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
     * Add channel
     *
     * @param \AppBundle\Entity\Channels $channel
     *
     * @return Channels
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
     * Add member
     *
     * @param \AppBundle\Entity\Users $member
     *
     * @return Channels
     */
    public function addMember(\AppBundle\Entity\Users $member)
    {
        $this->members[] = $member;

        return $this;
    }

    /**
     * Remove member
     *
     * @param \AppBundle\Entity\Users $member
     */
    public function removeMember(\AppBundle\Entity\Users $member)
    {
        $this->members->removeElement($member);
    }

    /**
     * Get members
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Add follower
     *
     * @param \AppBundle\Entity\Users $follower
     *
     * @return Channels
     */
    public function addFollower(\AppBundle\Entity\Users $follower)
    {
        $this->subscribers[] = $follower;

        return $this;
    }

    /**
     * Remove follower
     *
     * @param \AppBundle\Entity\Users $follower
     */
    public function removeFollower(\AppBundle\Entity\Users $follower)
    {
        $this->subscribers->removeElement($follower);
    }

    /**
     * Get followers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubscribers()
    {
        return $this->subscribers;
    }

    /**
     * Add page
     *
     * @param \AppBundle\Entity\Pages $page
     *
     * @return Channels
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
     * Add survey
     *
     * @param \AppBundle\Entity\Surveys $survey
     *
     * @return Channels
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
     * Get survey
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSurveys()
    {
        return $this->surveys;
    }

    /**
     * Add subscriber
     *
     * @param \AppBundle\Entity\Users $subscriber
     *
     * @return Channels
     */
    public function addSubscriber(\AppBundle\Entity\Users $subscriber)
    {
        $this->subscribers[] = $subscriber;

        return $this;
    }

    /**
     * Remove subscriber
     *
     * @param \AppBundle\Entity\Users $subscriber
     */
    public function removeSubscriber(\AppBundle\Entity\Users $subscriber)
    {
        $this->subscribers->removeElement($subscriber);
    }

    /**
     * Add category
     *
     * @param \AppBundle\Entity\Categories $category
     *
     * @return Channels
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
     * Add tag
     *
     * @param \AppBundle\Entity\Tags $tag
     *
     * @return Channels
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
     * @return Channels
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
