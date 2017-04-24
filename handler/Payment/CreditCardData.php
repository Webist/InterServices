<?php

namespace Payment;

/**
 * @Entity
 * @Table(name="credit_cards")
 *
 * improve this https://github.com/doctrine/doctrine2/issues/1757
 **/
class CreditCardData
{
    /**
     * @Id
     * @Column(name="id", type="guid")
     * @GeneratedValue(strategy="NONE")
     */
    protected $id;

    /** @Column(type="string", length=8) */
    protected $status;

    /** @Column(type="string", length=65) */
    private $name;

    /** @Column(type="string", length=65) */
    private $number;

    /** @Column(type="string", length=4) */
    private $cvc;

    /** @Column(type="string", length=8) */
    private $expiryDate;

    protected $paymentPreference;
    protected $billingSchedule;

    /**
     * @return mixed
     */
    public function getPaymentPreference()
    {
        return $this->paymentPreference;
    }

    /**
     * @param mixed $paymentPreference
     */
    public function setPaymentPreference($paymentPreference)
    {
        $this->paymentPreference = $paymentPreference;
    }

    /**
     * @return mixed
     */
    public function getBillingSchedule()
    {
        return $this->billingSchedule;
    }

    /**
     * @param mixed $billingSchedule
     */
    public function setBillingSchedule($billingSchedule)
    {
        $this->billingSchedule = $billingSchedule;
    }

    public function __construct($uuid = null)
    {
        $this->id = $uuid;
    }

    /**
     * Get id
     *
     * @return guid
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return CreditCardData
     */
    public function setStatus(string $status)
    {
        $this->status = (string) $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CreditCardData
     */
    public function setName(string $name)
    {
        $this->name = (string) $name;

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
     * Set number
     *
     * @param string $number
     *
     * @return CreditCardData
     */
    public function setNumber(string $number)
    {
        $this->number = (string) $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set cvc
     *
     * @param string $cvc
     *
     * @return CreditCardData
     */
    public function setCvc(string $cvc)
    {
        $this->cvc = (string) $cvc;

        return $this;
    }

    /**
     * Get cvc
     *
     * @return string
     */
    public function getCvc()
    {
        return $this->cvc;
    }

    /**
     * Set expiryDate
     *
     * @param string $expiryDate
     *
     * @return CreditCardData
     */
    public function setExpiryDate(string $expiryDate)
    {
        $this->expiryDate = (string) $expiryDate;

        return $this;
    }

    /**
     * Get expiryDate
     *
     * @return string
     */
    public function getExpiryDate()
    {
        return $this->expiryDate;
    }

    /**
     * Set id
     *
     * @param guid $id
     *
     * @return CreditCardData
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
