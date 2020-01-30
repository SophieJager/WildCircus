<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PricesRepository")
 */
class Prices
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PricesGroup", inversedBy="prices")
     */
    private $groups;

    /**
     * @ORM\Column(type="integer")
     */
    private $priceWeek;

    /**
     * @ORM\Column(type="integer")
     */
    private $priceWeekEnd;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroups(): ?PricesGroup
    {
        return $this->groups;
    }

    public function setGroups(?PricesGroup $groups): self
    {
        $this->groups = $groups;

        return $this;
    }

    public function getPriceWeek(): ?int
    {
        return $this->priceWeek;
    }

    public function setPriceWeek(int $priceWeek): self
    {
        $this->priceWeek = $priceWeek;

        return $this;
    }

    public function getPriceWeekEnd(): ?int
    {
        return $this->priceWeekEnd;
    }

    public function setPriceWeekEnd(int $priceWeekEnd): self
    {
        $this->priceWeekEnd = $priceWeekEnd;

        return $this;
    }
}
