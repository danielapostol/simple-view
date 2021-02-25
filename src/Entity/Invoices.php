<?php

namespace App\Entity;

use App\Repository\InvoicesRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Validator as svAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=InvoicesRepository::class)
 * @ORM\Table(name="_invoices")
 * @svAssert\ApproveAmount()
 * @svAssert\AdherentNotDebtor()
 */
class Invoices
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $series;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $number;

    /**
     * @ORM\Column(type="datetime")
     */
    private $issueDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dueDate;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $currency;

    /**
     * @ORM\Column(type="float", scale=2)
     * @Assert\Positive()
     */
    private $requestedAmount;

    /**
     * @ORM\Column(type="float", scale=2)
     * * @Assert\PositiveOrZero()
     */
    private $paidAmount;

    /**
     * @ORM\Column(type="float", scale=2)
     */
    private $balance;

    /**
     * @ORM\Column(type="float", scale=2)
     * @Assert\PositiveOrZero()
     */
    private $invoiceAmount;

    /**
     * @ORM\Column(type="float", scale=2)
     * @Assert\PositiveOrZero()
     */
    private $approvedAmount;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AdherentDebtor")
     * @Assert\NotNull()
     */
    private $adherent;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AdherentDebtor")
     * @Assert\NotNull()
     */
    private $debtor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeries(): ?string
    {
        return $this->series;
    }

    public function setSeries(string $series): self
    {
        $this->series = $series;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getIssueDate(): ?\DateTimeInterface
    {
        return $this->issueDate;
    }

    public function setIssueDate(\DateTimeInterface $issueDate): self
    {
        $this->issueDate = $issueDate;

        return $this;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTimeInterface $dueDate): self
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getRequestedAmount(): ?float
    {
        return $this->requestedAmount;
    }

    public function setRequestedAmount(float $requestedAmount): self
    {
        $this->requestedAmount = $requestedAmount;

        return $this;
    }

    public function getPaidAmount(): ?float
    {
        return $this->paidAmount;
    }

    public function setPaidAmount(float $paidAmount): self
    {
        $this->paidAmount = $paidAmount;

        return $this;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    public function setBalance(float $balance): self
    {
        $this->balance = $balance;

        return $this;
    }

    public function getInvoiceAmount(): ?float
    {
        return $this->invoiceAmount;
    }

    public function setInvoiceAmount(float $invoiceAmount): self
    {
        $this->invoiceAmount = $invoiceAmount;

        return $this;
    }

    public function getApprovedAmount(): ?float
    {
        return $this->approvedAmount;
    }

    public function setApprovedAmount(float $approvedAmount): self
    {
        $this->approvedAmount = $approvedAmount;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdherent()
    {
        return $this->adherent;
    }

    /**
     * @param mixed $adherent
     * @return Invoices
     */
    public function setAdherent($adherent)
    {
        $this->adherent = $adherent;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDebtor()
    {
        return $this->debtor;
    }

    /**
     * @param mixed $debtor
     * @return Invoices
     */
    public function setDebtor($debtor)
    {
        $this->debtor = $debtor;
        return $this;
    }


}
