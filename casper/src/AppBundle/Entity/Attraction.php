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
     * @ORM\Column(name="shortDescription", type="string", length=255)
     */
    private $shortDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="imageUrl", type="string", length=255)
     */
    private $imageURL;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Category",inversedBy="attractionList")
     * @ORM\JoinColumn(name="categoryId", referencedColumnName="id")
     */
    private $category;

    /**
     * @var Audience
     *
     * @ORM\ManyToOne(targetEntity="Audience",inversedBy="attractionList")
     * @ORM\JoinColumn(name="audienceId", referencedColumnName="id")
     */
    private $audience;

    /**
     * @var float
     *
     * @ORM\Column(name="percentageX", type="float")
     */
    private $percentageX;

    /**
     * @var float
     *
     * @ORM\Column(name="percentageY", type="float")
     */
    private $percentageY;

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
     * @ORM\Column(name="meanWaitTime", type="time", nullable=true)
     */
    private $meanWaitTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="meanDuration", type="time", nullable=true)
     */
    private $meanDuration;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="opertureTime", type="time")
     */
    private $opertureTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="closingTime", type="time")
     */
    private $closingTime;

    /**
     * @var Integer
     *
     * @ORM\Column(name="priceAdult", type="integer")
     */
    private $priceAdult;

    /**
     * @var Integer
     *
     * @ORM\Column(name="priceChild", type="integer")
     */
    private $priceChild;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
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
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set shortDescription.
     *
     * @param string $shortDescription
     *
     * @return Attraction
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription.
     *
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set description.
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
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set imageURL.
     *
     * @param string $imageURL
     *
     * @return Attraction
     */
    public function setImageURL($imageURL)
    {
        $this->imageURL = $imageURL;

        return $this;
    }

    /**
     * Get imageURL.
     *
     * @return string
     */
    public function getImageURL()
    {
        return $this->imageURL;
    }

    /**
     * Set percentageX.
     *
     * @param float $percentageX
     *
     * @return Attraction
     */
    public function setPercentageX($percentageX)
    {
        $this->percentageX = $percentageX;

        return $this;
    }

    /**
     * Get percentageX.
     *
     * @return float
     */
    public function getPercentageX()
    {
        return $this->percentageX;
    }

    /**
     * Set percentageY.
     *
     * @param float $percentageY
     *
     * @return Attraction
     */
    public function setPercentageY($percentageY)
    {
        $this->percentageY = $percentageY;

        return $this;
    }

    /**
     * Get percentageY.
     *
     * @return float
     */
    public function getPercentageY()
    {
        return $this->percentageY;
    }

    /**
     * Set minUserSize.
     *
     * @param float|null $minUserSize
     *
     * @return Attraction
     */
    public function setMinUserSize($minUserSize = null)
    {
        $this->minUserSize = $minUserSize;

        return $this;
    }

    /**
     * Get minUserSize.
     *
     * @return float|null
     */
    public function getMinUserSize()
    {
        return $this->minUserSize;
    }

    /**
     * Set minRequiredAge.
     *
     * @param int|null $minRequiredAge
     *
     * @return Attraction
     */
    public function setMinRequiredAge($minRequiredAge = null)
    {
        $this->minRequiredAge = $minRequiredAge;

        return $this;
    }

    /**
     * Get minRequiredAge.
     *
     * @return int|null
     */
    public function getMinRequiredAge()
    {
        return $this->minRequiredAge;
    }

    /**
     * Set meanWaitTime.
     *
     * @param \DateTime|null $meanWaitTime
     *
     * @return Attraction
     */
    public function setMeanWaitTime($meanWaitTime = null)
    {
        $this->meanWaitTime = $meanWaitTime;

        return $this;
    }

    /**
     * Get meanWaitTime.
     *
     * @return \DateTime|null
     */
    public function getMeanWaitTime()
    {
        return $this->meanWaitTime;
    }

    /**
     * Set meanDuration.
     *
     * @param \DateTime|null $meanDuration
     *
     * @return Attraction
     */
    public function setMeanDuration($meanDuration = null)
    {
        $this->meanDuration = $meanDuration;

        return $this;
    }

    /**
     * Get meanDuration.
     *
     * @return \DateTime|null
     */
    public function getMeanDuration()
    {
        return $this->meanDuration;
    }

    /**
     * Set opertureTime.
     *
     * @param \DateTime $opertureTime
     *
     * @return Attraction
     */
    public function setOpertureTime($opertureTime)
    {
        $this->opertureTime = $opertureTime;

        return $this;
    }

    /**
     * Get opertureTime.
     *
     * @return \DateTime
     */
    public function getOpertureTime()
    {
        return $this->opertureTime;
    }

    /**
     * Set closingTime.
     *
     * @param \DateTime $closingTime
     *
     * @return Attraction
     */
    public function setClosingTime($closingTime)
    {
        $this->closingTime = $closingTime;

        return $this;
    }

    /**
     * Get closingTime.
     *
     * @return \DateTime
     */
    public function getClosingTime()
    {
        return $this->closingTime;
    }

    /**
     * Set priceAdult.
     *
     * @param int $priceAdult
     *
     * @return Attraction
     */
    public function setPriceAdult($priceAdult)
    {
        $this->priceAdult = $priceAdult;

        return $this;
    }

    /**
     * Get priceAdult.
     *
     * @return int
     */
    public function getPriceAdult()
    {
        return $this->priceAdult;
    }

    /**
     * Set priceChild.
     *
     * @param int $priceChild
     *
     * @return Attraction
     */
    public function setPriceChild($priceChild)
    {
        $this->priceChild = $priceChild;

        return $this;
    }

    /**
     * Get priceChild.
     *
     * @return int
     */
    public function getPriceChild()
    {
        return $this->priceChild;
    }

    /**
     * Set category.
     *
     * @param \AppBundle\Entity\Category|null $category
     *
     * @return Attraction
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category.
     *
     * @return \AppBundle\Entity\Category|null
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set audience.
     *
     * @param \AppBundle\Entity\Audience|null $audience
     *
     * @return Attraction
     */
    public function setAudience(\AppBundle\Entity\Audience $audience = null)
    {
        $this->audience = $audience;

        return $this;
    }

    /**
     * Get audience.
     *
     * @return \AppBundle\Entity\Audience|null
     */
    public function getAudience()
    {
        return $this->audience;
    }
}
