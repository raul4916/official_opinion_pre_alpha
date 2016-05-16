<?php
/**
 * Created by PhpStorm.
 * User: raul
 * Date: 2/11/16
 * Time: 5:26 PM
 */


namespace AppBundle\Entity;

use AppBundle\Tools\Tools;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="locations")
 */
class Locations{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     */
    protected $id;
    /**
     * @ORM\Column(type = "string", nullable = true, unique = true)
     */
    protected $country=null;
    /**
     * @ORM\Column(type = "string", nullable = true, unique = true)
     */
    protected $city=null;
    /**
     * @ORM\Column(type = "string", nullable = true, unique = true)
     */
    protected $state=null;
    /**
     * @ORM\OneToMany(targetEntity="Users", mappedBy="location")
     */
    protected $users= null;
    /**
     * Location constructor.
     * @param $country
     * @param $city
     * @param $state
     */
    public function __construct($country = null,$state = null,$city = null)
    {
        $this->country = $country;
        $this->city = $city;
        $this->state = $state;
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->id = Tools::str_to_int($country.$state.$city);
    }

    /**
     * @return mixed
     */

    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
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
     * Add user
     *
     * @param \AppBundle\Entity\Users $user
     *
     * @return Locations
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
     * Set id
     *
     * @param integer $id
     *
     * @return Locations
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
