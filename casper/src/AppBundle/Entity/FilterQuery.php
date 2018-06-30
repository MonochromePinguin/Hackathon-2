<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
    public $audiences;

    /**
     * @var array|null
     */
    public $categories;

    /**
     * @var int|null
     *
     * @Assert\Type("integer")
     * @Assert\Range(min=0)
     */
    public $minUserSize;

    /**
     * @var int|null
     *
     * @Assert\Type("integer")
     * @Assert\Range(min=0)
     */
    public $minRequiredAge;

    /**
     * @var \DateTime|null
     *
     * @Assert\Type("DateTime")
     */
    public $meanWaitTime;

    /**
     * @var \DateTime|null
     *
     * @Assert\Type("DateTime")
     */
    public $meanDuration;

    /**
     * @var \DateTime|null
     *
     * @Assert\Type("DateTime")
     */
    public $opertureTime;

    /**
     * @var \DateTime|null
     *
     * @Assert\Type("DateTime")
     */
    public $closingTime;

    /**
     * @var int|null
     *
     * @Assert\Type("integer")
     * @Assert\Range(min=0)
     */
    public $priceAdult;

    /**
     * @var int|null
     *
     * @Assert\Type("integer")
     * @Assert\Range(min=0)
     */
    public $priceChild;
}
