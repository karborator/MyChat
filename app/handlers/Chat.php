<?php

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface
{

    protected $connections = [];
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        $this->connections[$conn->resourceId] = $conn;
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $stdObj = json_decode($msg);
        foreach ($this->connections as $receiver) {
            if ($from !== $receiver) {
                $receiver->send(json_encode(array(
                    'receiverName' => $stdObj->receiverName,
                    'senderName' => $stdObj->senderName,
                    'message' => $stdObj->message
                )));
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        unset($this->connections[$conn->resourceId]);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->close();
    }
}
