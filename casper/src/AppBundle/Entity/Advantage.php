<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Advantage
 *
 * @ORM\Table(name="advantage")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdvantageRepository")
 */
class Advantage
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
     * @var \DateTime
     *
     * @ORM\Column(name="startTime", type="datetime")
     */
    private $startTime;

    /**
     * @var int
     *
     * @ORM\Column(name="stockCount", type="integer")
     */
    private $stockCount;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
    * @ORM\ManyToMany(targetEntity="Attraction")* @ORM\JoinTable(name="linkAdvantageToAttraction",
    *       joinColumns={
    *          @ORM\JoinColumn(name="attractionId", referencedColumnName="id", unique=true)
    *      },
    *      inverseJoinColumns={
    *          @ORM\JoinColumn(name="advantageId", referencedColumnName="id", unique=true)
    *      }
    * )
    */
    private $AttractionList;


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
     * Set startTime.
     *
     * @param \DateTime $startTime
     *
     * @return Advantage
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime.
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set stockCount.
     *
     * @param int $stockCount
     *
     * @return Advantage
     */
    public function setStockCount($stockCount)
    {
        $this->stockCount = $stockCount;

        return $this;
    }

    /**
     * Get stockCount.
     *
     * @return int
     */
    public function getStockCount()
    {
        return $this->stockCount;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Advantage
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
     * @return Advantage
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
     * Constructor
     */
    public function __construct()
    {
        $this->AttractionList = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add attractionList.
     *
     * @param \AppBundle\Entity\Attraction $attractionList
     *
     * @return Advantage
     */
    public function addAttractionList(\AppBundle\Entity\Attraction $attractionList)
    {
        $this->AttractionList[] = $attractionList;

        return $this;
    }

    /**
     * Remove attractionList.
     *
     * @param \AppBundle\Entity\Attraction $attractionList
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAttractionList(\AppBundle\Entity\Attraction $attractionList)
    {
        return $this->AttractionList->removeElement($attractionList);
    }

    /**
     * Get attractionList.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttractionList()
    {
        return $this->AttractionList;
    }
}
