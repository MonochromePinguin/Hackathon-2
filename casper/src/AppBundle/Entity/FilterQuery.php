<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FilterQuery
 * this class is used only as a form data container – no persistence
 *
 * @ORM\Entity()
 */
class FilterQuery
{
    /**
     * @var array|null
     */
    private $audiences;

    /**
     * @var array|null
     */
    private $categories;

    /**
     * @var int|null
     *
     * @Assert\Type("integer")
     * @Assert\Range(min=0)
     */
    private $minUserSize;

    /**
     * @var int|null
     *
     * @Assert\Type("integer")
     * @Assert\Range(min=0)
     */
    private $minRequiredAge;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="meanWaitTime", type="time", nullable=true)
     *
     * @Assert\Type("DateTime")
     */
    private $meanWaitTime;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="meanDuration", type="time", nullable=true)
     *
     * @Assert\Type("DateTime")
     */
    private $meanDuration;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="opertureTime", type="time")
     *
     * @Assert\Type("DateTime")
     */
    private $opertureTime;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="closingTime", type="time")
     *
     * @Assert\Type("DateTime")
     */
    private $closingTime;

    /**
     * @var int|null
     *
     * @ORM\Column(name="priceAdult", type="integer")
     *
     * @Assert\Type("integer")
     * @Assert\Range(min=0)
     */
    private $priceAdult;

    /**
     * @var int|null
     *
     * @ORM\Column(name="priceChild", type="integer")
     *
     * @Assert\Type("integer")
     * @Assert\Range(min=0)
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
     * Set audiences.
     *
     * @param array|null $audiences
     *
     * @return FilterQuery
     */
    public function setAudiences($audiences = null)
    {
        $this->audiences = $audiences;

        return $this;
    }

    /**
     * Get audiences.
     *
     * @return array|null
     */
    public function getAudiences()
    {
        return $this->audiences;
    }

    /**
     * Set categories.
     *
     * @param array|null $categories
     *
     * @return FilterQuery
     */
    public function setCategories($categories = null)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Get categories.
     *
     * @return array|null
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set minUserSize.
     *
     * @param int|null $minUserSize
     *
     * @return FilterQuery
     */
    public function setMinUserSize($minUserSize = null)
    {
        $this->minUserSize = $minUserSize;

        return $this;
    }

    /**
     * Get minUserSize.
     *
     * @return int|null
     */
    public function getMinUserSize()
    {
        return $this->minUserSize;
    }

    /**
     * Set minRequiredAge.
     *
     * @param int $minRequiredAge
     *
     * @return FilterQuery
     */
    public function setMinRequiredAge($minRequiredAge)
    {
        $this->minRequiredAge = $minRequiredAge;

        return $this;
    }

    /**
     * Get minRequiredAge.
     *
     * @return int
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
     * @return FilterQuery
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
     * @return FilterQuery
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
     * @return FilterQuery
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
     * @return FilterQuery
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
     * @return FilterQuery
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
     * @return FilterQuery
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
}
