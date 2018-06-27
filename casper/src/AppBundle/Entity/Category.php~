<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\OneToMany(targetEntity="Attraction", mappedBy="category")
     */
    private $attractionList;


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
     * @return Category
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
     * Constructor
     */
    public function __construct()
    {
        $this->attractionList = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add attractionList.
     *
     * @param \AppBundle\Entity\Attraction $attractionList
     *
     * @return Category
     */
    public function addAttractionList(\AppBundle\Entity\Attraction $attractionList)
    {
        $this->attractionList[] = $attractionList;

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
        return $this->attractionList->removeElement($attractionList);
    }

    /**
     * Get attractionList.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttractionList()
    {
        return $this->attractionList;
    }
}
