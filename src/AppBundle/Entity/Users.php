<?php
/**
 * Created by PhpStorm.
 * User: raul
 * Date: 2/11/16
 * Time: 5:04 PM
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Query\QueryException;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class Users {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     * @ORM\Column(type="bigint")
     */
    protected $id;
    /**
     * @ORM\Column(type="string")
     */
    protected $fid; // this will be hash with the user pass
    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $username;
    /**
     * @ORM\Column(type="string", nullable = true)
     */
    protected $authentication= null;

    /**
     * @ORM\Column(type="bigint")
     */
    protected $date_create;
    /**
     * @ORM\Column(type="bigint")
     */
    protected $date_login;
    /**
     * @ORM\Column(type="string")
     */
    protected $email;
    /**
     * @ORM\Column(type="integer")
     */
    protected $email_confirmed;
    /**
     * @ORM\Column(type="string", nullable = true)
     */
    protected $fname= null;
    /**
     * @ORM\Column(type="string", nullable = true)
     */
    protected $lname= null;
    /**
     * @ORM\ManyToOne(targetEntity="Locations", inversedBy="users")
     */
    protected $location= null;
    /**
     * @ORM\Column(type="integer", nullable = true)
     */
    protected $age= null;
    /**
     * @ORM\Column(type="string", nullable = true)
     */
    protected $primary_lang= null;
    /**
     * @ORM\Column(type="string", nullable = true)
     */
    protected $race= null;
    /**
     * @ORM\Column(type="string", nullable = true)
     */
    protected $origin= null;
    /**
     * @ORM\Column(type="integer")
     */
    protected $userStatus= null;
    /**
     * @ORM\Column(type = "integer", nullable = true)
     */
    protected $gender= null;
    /**
     * @ORM\ManyToOne(targetEntity = "Groups", inversedBy = "users")
     */
    protected $userGroup= null;
    /**
     * member of this channel
     * @ORM\OneToMany(targetEntity = "Channels", mappedBy = "users")
     */
    protected $channels= null;
    /**
     * @ORM\OneToMany(targetEntity = "Channels", mappedBy = "subscribers")
     */
    protected $subscribed= null;
    /**
     * @ORM\ManyToMany(targetEntity = "Users",mappedBy="following")
     */
    protected $followers = null;
    /**
     * @ORM\ManyToMany(targetEntity = "Users",inversedBy="followers")
     */
    protected $following= null;
    /**
     * @ORM\OneToMany(targetEntity = "Surveys", mappedBy = "user")
     */
    protected $surveys= null;
    /**
     * @ORM\ManyToMany(targetEntity = "Tags", mappedBy = "users")
     */
    protected $tags= null;
    /**
     * @ORM\OneToMany(targetEntity = "Reports", mappedBy = "user")
     */
    protected $reports;


    /**
     * Constructor
     */
    public function __construct($username,$password, $date_create, $date_login, $email, $email_confirmed, $fname,
                                $lname,$gender, $location, $age, $primary_lang, $race, $origin,$status)
    {
        $this->fid = $password;
        $this->gender = $gender;
        $this->username = $username;
        $this->date_create = $date_create;
        $this->date_login = $date_login;
        $this->email = $email;
        $this->email_confirmed = $email_confirmed;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->location = $location;
        $this->age = $age;
        $this->primary_lang = $primary_lang;
        $this->race = $race;
        $this->origin = $origin;
        $this->userStatus = $status;
        $this->channels = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subscribed = new \Doctrine\Common\Collections\ArrayCollection();
        $this->followers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->following = new \Doctrine\Common\Collections\ArrayCollection();
        $this->surveys = new \Doctrine\Common\Collections\ArrayCollection();
    }



    /**
     * @return mixed
     */
    public function getFid()
    {
        return $this->fid;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        if(preg_match("/^[A-Za-z]([A-Za-z]|\d)*/", $username)) {
            $this->username = $username;
        }
        throw new QueryException("Problem with the username");
    }

    /**
     * @return mixed
     */
    public function getDateCreate()
    {
        return $this->date_create;
    }

    /**
     * @param mixed $date_create
     */
    public function setDateCreate($date_create)
    {
        $this->date_create = $date_create;
    }

    /**
     * @return mixed
     */
    public function getDateLogin()
    {
        return $this->date_login;
    }

    /**
     * @param mixed $date_login
     */
    public function setDateLogin($date_login)
    {
        $this->date_login = $date_login;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        // preg_match for email raul4916@gmail.com is an example.
        if(preg_match("/^[A-Za-z]([A-Za-z]|\d)*@([A-Za-z]|\d)+\.([A-Za-z])+/", $email)) {
            $this->email = $email;
        }
        return new QueryException("Error on the Email");
    }

    /**
     * @return mixed
     */
    public function getEmailConfirmed()
    {
        return $this->email_confirmed;
    }

    /**
     * @param mixed $email_confirmed
     */
    public function setEmailConfirmed($email_confirmed)
    {
        $this->email_confirmed = $email_confirmed;
    }

    /**
     * @return mixed
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * @param mixed $fname
     */
    public function setFname($fname)
    {
        $this->fname = $fname;
    }

    /**
     * @return mixed
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * @param mixed $lname
     */
    public function setLname($lname)
    {
        $this->lname = $lname;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getPrimaryLang()
    {
        return $this->primary_lang;
    }

    /**
     * @param mixed $primary_lang
     */
    public function setPrimaryLang($primary_lang)
    {
        $this->primary_lang = $primary_lang;
    }

    /**
     * @return mixed
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * @param mixed $race
     */
    public function setRace($race)
    {
        $this->race = $race;
    }

    /**
     * @return mixed
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param mixed $origin
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;
    }

    /**
     * @return mixed
     */
    public function getUserStatus()
    {
        return $this->userStatus;
    }

    /**
     * @param mixed $userStatus
     */
    public function setUserStatus($userStatus)
    {
        $this->userStatus = $userStatus;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getUserGroup()
    {
        return $this->user_group;
    }

    /**
     * @param mixed $user_group
     */
    public function setUserGroup($user_group)
    {
        $this->user_group = $user_group;
    }

    /**
     * @return mixed
     */
    public function getAuthentication()
    {
        return $this->authentication;
    }

    /**
     * @param mixed $authentication
     */
    public function setAuthentication($authentication)
    {
        $this->authentication = $authentication;
    }


    /**
     * Set fid
     *
     * @param integer $fid
     *
     * @return Users
     */
    public function setFid($fid)
    {
        $this->fid = $fid;

        return $this;
    }



    /**
     * Add channel
     *
     * @param \AppBundle\Entity\Channels $channel
     *
     * @return Users
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
     * Add subscribed
     *
     * @param \AppBundle\Entity\Channels $subscribed
     *
     * @return Users
     */
    public function addSubscribed(\AppBundle\Entity\Channels $subscribed)
    {
        $this->subscribed[] = $subscribed;

        return $this;
    }

    /**
     * Remove subscribed
     *
     * @param \AppBundle\Entity\Channels $subscribed
     */
    public function removeSubscribed(\AppBundle\Entity\Channels $subscribed)
    {
        $this->subscribed->removeElement($subscribed);
    }

    /**
     * Get subscribed
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubscribed()
    {
        return $this->subscribed;
    }

    /**
     * Add following
     *
     * @param \AppBundle\Entity\Users $following
     *
     * @return Users
     */
    public function addFollowing(\AppBundle\Entity\Users $following)
    {
        $this->following[] = $following;

        return $this;
    }

    /**
     * Remove following
     *
     * @param \AppBundle\Entity\Users $following
     */
    public function removeFollowing(\AppBundle\Entity\Users $following)
    {
        $this->following->removeElement($following);
    }

    /**
     * Get following
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFollowing()
    {
        return $this->following;
    }



    /**
     * Add survey
     *
     * @param \AppBundle\Entity\Surveys $survey
     *
     * @return Users
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
     * Set following
     *
     * @param \AppBundle\Entity\Users $following
     *
     * @return Users
     */
    public function setFollowing(\AppBundle\Entity\Users $following = null)
    {
        $this->following = $following;

        return $this;
    }

    /**
     * Add follower
     *
     * @param \AppBundle\Entity\Users $follower
     *
     * @return Users
     */
    public function addFollower(\AppBundle\Entity\Users $follower)
    {
        $this->followers[] = $follower;

        return $this;
    }

    /**
     * Remove follower
     *
     * @param \AppBundle\Entity\Users $follower
     */
    public function removeFollower(\AppBundle\Entity\Users $follower)
    {
        $this->followers->removeElement($follower);
    }

    /**
     * Get followers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFollowers()
    {
        return $this->followers;
    }

    /**
     * Add tag
     *
     * @param \AppBundle\Entity\Tags $tag
     *
     * @return Users
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
     * @return Users
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
