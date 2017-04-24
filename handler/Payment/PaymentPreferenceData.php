<?php


namespace Payment;

/**
 * @Entity
 * @Table(name="payment_preferences")
 *
 **/
class PaymentPreferenceData
{
    /**
     * @Id
     * @Column(name="id", type="guid")
     * @GeneratedValue(strategy="NONE")
     */
    protected $id;

    /** @Column(type="string", length=8) */
    protected $status;

    /** @Column(type="string", length=22) */
    protected $method;

    /** @Column(name="auto_pay", type="boolean") */
    protected $autoPay;

    public function __construct($uuid = null)
    {
        $this->id = $uuid;
    }

    /**
     * Set id
     *
     * @param guid $id
     *
     * @return PaymentPreferenceData
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * @return PaymentPreferenceData
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
     * Get method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
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

    /**
     * Get autopay
     *
     * @return string
     */
    public function getAutopay()
    {
        return $this->autoPay;
    }
}
