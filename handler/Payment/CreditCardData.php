<?php

namespace Payment;



/**
 * @Entity
 * @Table(name="credit_cards")
 * @HasLifecycleCallbacks()
 *
 * improve this https://github.com/doctrine/doctrine2/issues/1757
 **/
class CreditCardData implements \Statement\DataObject
{
    /**
     * @Id
     * @Column(name="id", type="guid")
     * @GeneratedValue(strategy="NONE")
     */
    protected $id;

    /**
     * @var
     * @Column(type="datetime", name="created_at")
     */
    protected $createdAt;

    /** @Column(type="string", length=8, nullable=true) */
    protected $status;

    /** @Column(type="string", length=65, nullable=true) */
    private $name;
    /** @Column(type="string", length=65, nullable=true) */
    private $number;
    /** @Column(type="string", length=4, nullable=true) */
    private $cvc;
    /** @Column(type="string", length=8, nullable=true) */
    private $expiryDate;

    /** @var  $paymentPreference PaymentPreferenceData */
    protected $paymentPreference;
    /** @var  $billingSchedule BillingScheduleData */
    protected $billingSchedule;

    /**
     * @return PaymentPreferenceData
     */
    public function getPaymentPreference()
    {
        return $this->paymentPreference;
    }

    /**
     * @param PaymentPreferenceData $paymentPreference
     */
    public function setPaymentPreference(PaymentPreferenceData $paymentPreference)
    {
        $this->paymentPreference = $paymentPreference;
    }

    /**
     * @return BillingScheduleData
     */
    public function getBillingSchedule()
    {
        return $this->billingSchedule;
    }

    /**
     * @param BillingScheduleData $billingSchedule
     */
    public function setBillingSchedule(BillingScheduleData $billingSchedule)
    {
        $this->billingSchedule = $billingSchedule;
    }

    public function __construct($uuid)
    {
        $this->id = $uuid;
    }

    /**
     * Get id
     *
     *
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  $id
     *
     * @return CreditCardData
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @PrePersist()
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        if ($this->createdAt === null) {
            $this->createdAt = new \DateTime('now');
        }
        return $this->createdAt;
    }

    /**
     * @param \DateTime $dateTime
     * @return $this
     */
    public function setCreatedAt(\DateTime $dateTime)
    {
        $this->createdAt = $dateTime;
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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
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
     * Get cvc
     *
     * @return string
     */
    public function getCvc()
    {
        return $this->cvc;
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
     * Get expiryDate
     *
     * @return string
     */
    public function getExpiryDate()
    {
        return $this->expiryDate;
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
}
