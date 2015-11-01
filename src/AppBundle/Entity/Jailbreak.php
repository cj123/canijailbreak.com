<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jailbreak
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\JailbreakRepository")
 */
class Jailbreak
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="jailbroken", type="boolean")
     */
    private $jailbroken;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=30)
     */
    private $version;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=1000)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="startiOS", type="string", length=30)
     */
    private $startiOS;

    /**
     * @var string
     *
     * @ORM\Column(name="endiOS", type="string", length=30, nullable=true)
     */
    private $endiOS;

    /**
     * @var string
     *
     * @ORM\Column(name="caveats", type="string", length=1000, nullable=true)
     */
    private $caveats;

    /**
     * @var boolean
     *
     * @ORM\Column(name="windows", type="boolean")
     */
    private $windows;

    /**
     * @var boolean
     *
     * @ORM\Column(name="osx", type="boolean")
     */
    private $osx;

    /**
     * @var boolean
     *
     * @ORM\Column(name="linux", type="boolean")
     */
    private $linux;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mobilesafari", type="boolean")
     */
    private $mobilesafari;

    public function __construct()
    {
        $this->windows = false;
        $this->osx = false;
        $this->linux = false;
        $this->mobilesafari = false;
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
     * Set jailbroken
     *
     * @param boolean $jailbroken
     *
     * @return Jailbreak
     */
    public function setJailbroken($jailbroken)
    {
        $this->jailbroken = $jailbroken;

        return $this;
    }

    /**
     * Get jailbroken
     *
     * @return boolean
     */
    public function getJailbroken()
    {
        return $this->jailbroken;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Jailbreak
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
     * Set version
     *
     * @param string $version
     *
     * @return Jailbreak
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Jailbreak
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
     * Set startiOS
     *
     * @param string $startiOS
     *
     * @return Jailbreak
     */
    public function setStartiOS($startiOS)
    {
        $this->startiOS = $startiOS;

        return $this;
    }

    /**
     * Get startiOS
     *
     * @return string
     */
    public function getStartiOS()
    {
        return $this->startiOS;
    }

    /**
     * Set endiOS
     *
     * @param string $endiOS
     *
     * @return Jailbreak
     */
    public function setEndiOS($endiOS)
    {
        $this->endiOS = $endiOS;

        return $this;
    }

    /**
     * Get endiOS
     *
     * @return string
     */
    public function getEndiOS()
    {
        return $this->endiOS;
    }

    /**
     * Set caveats
     *
     * @param string $caveats
     *
     * @return Jailbreak
     */
    public function setCaveats($caveats)
    {
        $this->caveats = $caveats;

        return $this;
    }

    /**
     * Get caveats
     *
     * @return string
     */
    public function getCaveats()
    {
        return $this->caveats;
    }

    /**
     * Set windows
     *
     * @param boolean $windows
     *
     * @return Jailbreak
     */
    public function setWindows($windows)
    {
        $this->windows = $windows;

        return $this;
    }

    /**
     * Get windows
     *
     * @return boolean
     */
    public function getWindows()
    {
        return $this->windows;
    }

    /**
     * Set osx
     *
     * @param boolean $osx
     *
     * @return Jailbreak
     */
    public function setOsx($osx)
    {
        $this->osx = $osx;

        return $this;
    }

    /**
     * Get osx
     *
     * @return boolean
     */
    public function getOsx()
    {
        return $this->osx;
    }

    /**
     * Set linux
     *
     * @param boolean $linux
     *
     * @return Jailbreak
     */
    public function setLinux($linux)
    {
        $this->linux = $linux;

        return $this;
    }

    /**
     * Get linux
     *
     * @return boolean
     */
    public function getLinux()
    {
        return $this->linux;
    }

    /**
     * Set mobilesafari
     *
     * @param boolean $mobilesafari
     *
     * @return Jailbreak
     */
    public function setMobilesafari($mobilesafari)
    {
        $this->mobilesafari = $mobilesafari;

        return $this;
    }

    /**
     * Get mobilesafari
     *
     * @return boolean
     */
    public function getMobilesafari()
    {
        return $this->mobilesafari;
    }

    /**
     * @return array
     */
    public function getIconNames()
    {
        $names = [];

        if ($this->linux) {
            $names["Linux"] = "linux";
        }

        if ($this->windows) {
            $names["Windows"] = "windows";
        }

        if ($this->osx) {
            $names["OS X"] = "apple";
        }

        if ($this->mobilesafari) {
            $names["Mobile Safari"] = "mobile";
        }

        if (count($names) === 0) {
            $names["Unknown"] = "question";
        }

        return $names;
    }
}
