<?php


namespace Billing;

/**
 * @Entity
 * @Table(name="billing_schedules")
 **/
class ScheduleData
{
    /**
     * @Id
     * @Column(name="id", type="guid")
     * @GeneratedValue(strategy="NONE")
     */
    protected $id;

    /**
     * @Column(type="smallint")
     */
    protected $period;

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

    public function setPeriod($period)
    {
        $this->period = $period;
    }

    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Set id
     *
     * @param guid $id
     *
     * @return ScheduleData
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
