<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attraction
 *
 * @ORM\Table(name="attraction")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AttractionRepository")
 */
class Attraction
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var Category
     *
     * @ORM\Column(name="categoryId", type="integer")
     * @ORM\ManyToOne(targetEntity="Category",inversedBy="attractionList")
     */
    private $category;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float")
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;

    /**
     * @var float|null
     *
     * @ORM\Column(name="minUserSize", type="float", nullable=true)
     */
    private $minUserSize;

    /**
     * @var int|null
     *
     * @ORM\Column(name="minRequiredAge", type="integer", nullable=true)
     */
    private $minRequiredAge;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="meanWaitTime", type="integer", nullable=true)
     */
    private $meanWaitTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="meanDuration", type="integer", nullable=true)
     */
    private $meanDuration;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="opertureTime", type="integer")
     */
    private $opertureTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="closingTime", type="integer")
     */
    private $closingTime;


    
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
     * @return Attraction
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
     * @return Attraction
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
     * Set category
     *
     * @param integer $category
     *
     * @return Attraction
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return integer
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     *
     * @return Attraction
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return Attraction
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set minUserSize
     *
     * @param float $minUserSize
     *
     * @return Attraction
     */
    public function setMinUserSize($minUserSize)
    {
        $this->minUserSize = $minUserSize;

        return $this;
    }

    /**
     * Get minUserSize
     *
     * @return float
     */
    public function getMinUserSize()
    {
        return $this->minUserSize;
    }

    /**
     * Set minRequiredAge
     *
     * @param integer $minRequiredAge
     *
     * @return Attraction
     */
    public function setMinRequiredAge($minRequiredAge)
    {
        $this->minRequiredAge = $minRequiredAge;

        return $this;
    }

    /**
     * Get minRequiredAge
     *
     * @return integer
     */
    public function getMinRequiredAge()
    {
        return $this->minRequiredAge;
    }

    /**
     * Set meanWaitTime
     *
     * @param integer $meanWaitTime
     *
     * @return Attraction
     */
    public function setMeanWaitTime($meanWaitTime)
    {
        $this->meanWaitTime = $meanWaitTime;

        return $this;
    }

    /**
     * Get meanWaitTime
     *
     * @return integer
     */
    public function getMeanWaitTime()
    {
        return $this->meanWaitTime;
    }

    /**
     * Set meanDuration
     *
     * @param integer $meanDuration
     *
     * @return Attraction
     */
    public function setMeanDuration($meanDuration)
    {
        $this->meanDuration = $meanDuration;

        return $this;
    }

    /**
     * Get meanDuration
     *
     * @return integer
     */
    public function getMeanDuration()
    {
        return $this->meanDuration;
    }

    /**
     * Set opertureTime
     *
     * @param integer $opertureTime
     *
     * @return Attraction
     */
    public function setOpertureTime($opertureTime)
    {
        $this->opertureTime = $opertureTime;

        return $this;
    }

    /**
     * Get opertureTime
     *
     * @return integer
     */
    public function getOpertureTime()
    {
        return $this->opertureTime;
    }

    /**
     * Set closingTime
     *
     * @param integer $closingTime
     *
     * @return Attraction
     */
    public function setClosingTime($closingTime)
    {
        $this->closingTime = $closingTime;

        return $this;
    }

    /**
     * Get closingTime
     *
     * @return integer
     */
    public function getClosingTime()
    {
        return $this->closingTime;
    }
}
