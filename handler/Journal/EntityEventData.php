<?php


namespace Journal;


/**
 * Class EntityEventData
 * @package Journal
 * @Entity()
 * @Table(name="entity_events")
 * @HasLifecycleCallbacks()
 */
class EntityEventData
{
    /**
     * Unique incremental identifier
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id = null;

    /**
     * Unique identifier, eventSourcedId or aggregateId
     * @var
     * @Column(name="uuid", type="guid")
     */
    protected $uuid;

    /**
     * @Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     *
     * @Column(type="bigint")
     */
    protected $sequence;

    /**
     * Event name
     * @Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     *
     * @Column(name="version", type="string", length=22)
     */
    protected $version;

    /**
     * Payload
     *
     * @Column(type="object")
     */
    protected $object;

    /**
     * @var array
     * @Column(type="string")
     */
    protected $changeSet;

    /**
     * @Column(type="integer", length=65, options={"comment":"LoggedIn userId"}, nullable=true)
     */
    protected $userId;

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
     * Get uuid
     *
     *
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set uuid
     *
     * @param guid $uuid
     *
     * @return EntityEventData
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get sequence
     *
     *
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * Set sequence
     *
     * @param integer $sequence
     *
     * @return EntityEventData
     */
    public function setSequence($sequence)
    {
        $this->sequence = $sequence;

        return $this;
    }

    /**
     * Get timestamp
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
     * Set timestamp
     *
     * @param \DateTime $timestamp
     *
     * @return EntityEventData
     */
    public function setCreatedAt(\DateTime $dateTime)
    {
        $this->createdAt = $dateTime;

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
     * @return EntityEventData
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set version
     *
     * @param string $version
     *
     * @return EntityEventData
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get object
     *
     * @return \stdClass
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Set object
     *
     * @param \stdClass $object
     *
     * @return EntityEventData
     */
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * @return array
     */
    public function getChangeSet()
    {
        return unserialize($this->changeSet);
    }

    /**
     * @param array $changeSet
     * @return $this
     */
    public function setChangeSet(array $changeSet)
    {
        $this->changeSet = serialize($changeSet);
        return $this;
    }

    /**
     * Get userId
     *
     *
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return EntityEventData
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }
}
