<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attraction
 *
 * @ORM\Table(name="attraction")
 * @ORM\Entity()
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
     * @ORM\Column(name="categoryId", type="integer")
     * @ORM\ManyToOne(targetEntity="Category",inversedBy="attractionList")
     */
    private $category;

    /**
     * @var Audience
     *
     * @ORM\Column(name="audienceId", type="integer")
     * @ORM\ManyToOne(targetEntity="Audience",inversedBy="attractionList")
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
     * @return string
     */
    public function getShortDescription(): string
    {
        return $this->shortDescription;
    }

    /**
     * @param string $shortDescription
     */
    public function setShortDescription(string $shortDescription)
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * @return string
     */
    public function getImageURL(): string
    {
        return $this->imageURL;
    }

    /**
     * @param string $imageURL
     */
    public function setImageURL(string $imageURL)
    {
        $this->imageURL = $imageURL;
    }

    /**
     * Set latitude.
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
     * @return float
     */
    public function getPercentageX()
    {
        return $this->percentageX;
    }

    /**
     * @param float $percentageX
     */
    public function setPercentageX($percentageX)
    {
        $this->percentageX = $percentageX;
    }

    /**
     * @return float
     */
    public function getPercentageY()
    {
        return $this->percentageY;
    }

    /**
     * @param float $percentageY
     */
    public function setPercentageY($percentageY)
    {
        $this->percentageY = $percentageY;
    }

    /**
     * Get latitude.
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude.
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
     * Get longitude.
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
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
     * Set category.
     *
     * @param int $category
     *
     * @return Attraction
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category.
     *
     * @return int
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return Audience
     */
    public function getAudience()
    {
        return $this->audience;
    }

    /**
     * @param Audience $audience
     */
    public function setAudience($audience)
    {
        $this->audience = $audience;
    }

    /**
     * @return \DateTime|null
     */
    public function getMeanWaitTime(): \DateTime
    {
        return $this->meanWaitTime;
    }

    /**
     * @param \DateTime|null $meanWaitTime
     */
    public function setMeanWaitTime(\DateTime $meanWaitTime)
    {
        $this->meanWaitTime = $meanWaitTime;
    }

    /**
     * @return \DateTime
     */
    public function getMeanDuration(): \DateTime
    {
        return $this->meanDuration;
    }

    /**
     * @param \DateTime $meanDuration
     */
    public function setMeanDuration(\DateTime $meanDuration)
    {
        $this->meanDuration = $meanDuration;
    }

    /**
     * @return \DateTime
     */
    public function getOpertureTime(): \DateTime
    {
        return $this->opertureTime;
    }

    /**
     * @param \DateTime $opertureTime
     */
    public function setOpertureTime(\DateTime $opertureTime)
    {
        $this->opertureTime = $opertureTime;
    }

    /**
     * @return \DateTime
     */
    public function getClosingTime(): \DateTime
    {
        return $this->closingTime;
    }

    /**
     * @param \DateTime $closingTime
     */
    public function setClosingTime(\DateTime $closingTime)
    {
        $this->closingTime = $closingTime;
    }

    /**
     * @return int
     */
    public function getPriceAdult(): int
    {
        return $this->priceAdult;
    }

    /**
     * @param int $priceAdult
     */
    public function setPriceAdult(int $priceAdult)
    {
        $this->priceAdult = $priceAdult;
    }

    /**
     * @return int
     */
    public function getPriceChild(): int
    {
        return $this->priceChild;
    }

    /**
     * @param int $priceChild
     */
    public function setPriceChild(int $priceChild)
    {
        $this->priceChild = $priceChild;
    }
}
