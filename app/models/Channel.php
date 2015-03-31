<?php


class Channel extends BaseModel
{

    private $id;
    private $sender_id;
    private $receiver_id;

    public function initialize()
    {
        $this->hasOne('receiver_id', 'User', 'id', array(
            'alias' => 'receiver',
            'foreignKey' => true
        ));
        $this->hasOne('sender_id', 'User', 'id', array(
            'alias' => 'sender',
            'foreignKey' => true
        ));
        $this->hasMany('id', 'Message', 'channel_id', array(
            'alias' => 'message',
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
    public function getSenderId()
    {
        return $this->sender_id;
    }

    /**
     * @param mixed $sender_id
     */
    public function setSenderId($sender_id)
    {
        $this->sender_id = $sender_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReceiverId()
    {
        return $this->receiver_id;
    }

    /**
     * @param mixed $receiver_id
     */
    public function setReceiverId($receiver_id)
    {
        $this->receiver_id = $receiver_id;
        return $this;
    }
}