<?php

class Message extends BaseModel
{

    private $id;
    private $channel_id;
    private $message;
    private $username;

    public function initialize()
    {
        $this->hasOne('channel_id', 'Channel', 'id', array(
            'alias' => 'channel',
            'foreignKey' => true
        ));
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getChannelId()
    {
        return $this->channel_id;
    }

    /**
     * @param mixed $channel_id
     */
    public function setChannelId($channel_id)
    {
        $this->channel_id = $channel_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->username;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($username)
    {
        $this->username = $username;
        return $this;
    }
}