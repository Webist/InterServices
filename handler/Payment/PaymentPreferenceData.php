<?php


namespace Payment;




/**
 * @Entity
 * @Table(name="payment_preferences")
 * @HasLifecycleCallbacks()
 *
 **/
class PaymentPreferenceData implements \App\Contract\Behave\DataObject
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

    /** @Column(type="string", length=22, nullable=true) */
    protected $method;

    /** @Column(name="auto_pay", type="boolean", nullable=true) */
    protected $autoPay;


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
     * @return PaymentPreferenceData
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
     * @return PaymentPreferenceData
     */
    public function setStatus(string $status)
    {
        $this->status = (string) $status;

        return $this;
    }

    /**
     * Get method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set method
     *
     * @param string $method
     *
     * @return PaymentPreferenceData
     */
    public function setMethod(string $method)
    {
        $this->method = (string) $method;

        return $this;
    }

    /**
     * Get autopay
     *
     * @return string
     */
    public function getAutopay()
    {
        return $this->autoPay;
    }

    /**
     * Set autopay
     *
     * @param string $autoPay
     *
     * @return PaymentPreferenceData
     */
    public function setAutopay(bool $autoPay)
    {
        $this->autoPay = (bool) $autoPay;

        return $this;
    }
}
