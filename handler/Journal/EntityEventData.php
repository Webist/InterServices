<?php


namespace Journal;


/**
 * Class EntityEventData
 * @package Journal
 * @Entity()
 * @Table(name="entity_events")
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
     *
     * @Column(type="bigint")
     */
    protected $sequence;

    /**
     * @Column(name="timestamp", type="datetime")
     */
    protected $timestamp;

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
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
     * Get uuid
     *
     * @return guid
     */
    public function getUuid()
    {
        return $this->uuid;
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
     * Get sequence
     *
     * @return integer
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     *
     * @return EntityEventData
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Get version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
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
     * Get object
     *
     * @return \stdClass
     */
    public function getObject()
    {
        return $this->object;
    }

    public function setChangeSet($changeSet)
    {
        $this->changeSet = serialize($changeSet);
    }

    public function getChangeSet()
    {
        return unserialize($this->changeSet);
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

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
