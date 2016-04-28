<?php
/**
 * Created by PhpStorm.
 * User: raul
 * Date: 2/25/16
 * Time: 6:34 PM
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Query\QueryException;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Users;
/**
 * @ORM\Entity
 * @ORM\Table(name="projects")
 */
class Projects
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\OneToOne(targetEntity = "Users");
     * @ORM\JoinColumn(name = "username", referencedColumnName = "username")
     */
    protected $user;
    /**
     * @ORM\Column(type="string")
     */
    protected $projectName;
    /**
     * @ORM\Column(type="string")
     */
    protected $url;
    /**
     * @ORM\Column(type="string")
     */
    protected $apiKey;
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
     * Set projectName
     *
     * @param string $projectName
     *
     * @return Projects
     */
    public function setProjectName($projectName)
    {
        $this->projectName = $projectName;

        return $this;
    }
    /**
     * Get projectName
     *
     * @return string
     */
    public function getProjectName()
    {
        return $this->projectName;
    }
    /**
     * Set url
     *
     * @param string $url
     *
     * @return Projects
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }
    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
    /**
     * Set apiKey
     *
     * @param string $apiKey
     *
     * @return Projects
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }
    /**
     * Get apiKey
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }
    /**
     * Set user
     *
     * @param \AppBundle\Entity\Users $user
     *
     * @return Projects
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
}
