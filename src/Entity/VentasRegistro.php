<?php

namespace App\Entity;

use App\Repository\VentasRegistroRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VentasRegistroRepository::class)
 */
class VentasRegistro
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $ClientName;

    /**
     * @ORM\Column(type="date")
     */
    private $DateAdd;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $FriendName;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $DeliveryAddress;

    /**
     * @ORM\Column(type="date")
     */
    private $DeliveryDate;

    /**
     * @ORM\Column(type="float")
     */
    private $Ammount;

    /**
     * @ORM\Column(type="string", length=11)
     */
    private $PhoneNumber;

    /**
     * @ORM\Column(type="integer")
     */
    private $Status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClientName(): ?string
    {
        return $this->ClientName;
    }

    public function setClientName(string $ClientName): self
    {
        $this->ClientName = $ClientName;

        return $this;
    }

    public function getDateAdd(): ?\DateTimeInterface
    {
        return $this->DateAdd;
    }

    public function setDateAdd($DateAdd): self
    {
        $this->DateAdd = $DateAdd;

        return $this;
    }

    public function getFriendName(): ?string
    {
        return $this->FriendName;
    }

    public function setFriendName(?string $FriendName): self
    {
        $this->FriendName = $FriendName;

        return $this;
    }

    public function getDeliveryAddress(): ?string
    {
        return $this->DeliveryAddress;
    }

    public function setDeliveryAddress(?string $DeliveryAddress): self
    {
        $this->DeliveryAddress = $DeliveryAddress;

        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->DeliveryDate;
    }

    public function setDeliveryDate($DeliveryDate): self
    {
        $this->DeliveryDate = $DeliveryDate;

        return $this;
    }

    public function getAmmount(): ?float
    {
        return $this->Ammount;
    }

    public function setAmmount(float $Ammount): self
    {
        $this->Ammount = $Ammount;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->PhoneNumber;
    }

    public function setPhoneNumber(?string $PhoneNumber): self
    {
        $this->PhoneNumber = $PhoneNumber;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->Status;
    }

    public function setStatus(int $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'clientName' => $this->getClientName(),
            'dateAdd' => $this->getDateAdd(),
            'friendName' => $this->getFriendName(),
            'deliveryAddress' => $this->getDeliveryAddress(),
            'deliveryDate' => $this->getDeliveryDate() ,
            'ammount' => $this->getAmmount(),
            'phoneNumber' => $this->getPhoneNumber(),
            'status' => $this->getStatus()
        ];
    }
}
