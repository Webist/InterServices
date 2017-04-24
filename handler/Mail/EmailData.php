<?php


namespace Mail;

/**
 * @Entity()
 * @Table("emails")
 * @HasLifecycleCallbacks
 */
class EmailData
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var
     * @Column(type="string", length=32, unique=true, nullable=false)
     */
     protected $hash;

    /**
     * @var
     * @Column(type="datetime")
     */
     protected $timestamp;

    /**
     * @var
     * @Column(type="string", length=65)
     */
    private $sender;

    /**
     * @var
     * @Column(type="string", length=65)
     */
    private $receiver;

    /**
     * @var
     * @Column(type="string")
     */
    private $subject;
    
    /**
     * @var
     * @Column(type="text")
     */
    private $message;

    /**
     * @var
     * @Column(type="string")
     */
    private $headers;


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
     * Set hash
     *
     * @param string $hash
     *
     *
     * @return EmailData
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     * @PrePersist()
     *
     * @return string
     */
    public function getHash()
    {
        if($this->hash === null) {
            $this->hash = md5($this->sender . $this->receiver . $this->subject . $this->message);
        }
        return $this->hash;
    }

    /**
     * Set sender
     *
     * @param string $sender
     *
     * @return EmailData
     */
    public function setSender($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set receiver
     *
     * @param string $receiver
     *
     * @return EmailData
     */
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get receiver
     *
     * @return string
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return EmailData
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return EmailData
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set headers
     *
     * @param string $headers
     *
     * @return EmailData
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Get headers
     *
     * @return string
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     *
     *
     * @return EmailData
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     * @PrePersist()
     *
     * @return \DateTime
     */
    public function getTimestamp()
    {
        if($this->timestamp === null){
            $this->timestamp = new \DateTime('now');
        }
        return $this->timestamp;
    }
}
