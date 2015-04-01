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
        var_dump('connectionId:' . $conn->resourceId);
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

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
