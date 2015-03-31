<?php

class AjaxController extends BaseController
{

    public function historyAction()
    {
        $this->view->disable();
        echo json_encode($this->export('history'));
        exit;
    }

    public function updateAction()
    {
        $this->view->disable();
        echo json_encode($this->export('update'));
        exit;
    }

    public function sendAction()
    {
        $this->view->disable();
        $messageModel = new Message();
        $channelId = $this->getChannel($this->request->getPost('username', 'trim'));
        $messageModel->setChannelId($channelId[0]['id'])
            ->setMessage($this->request->getPost('message', 'string'))
            ->setUserId($this->userModel->getUsername());
        if ($messageModel->save()) {
            echo json_encode(array('sender' => $messageModel->getUserId()));
        } else {
            echo json_encode(array('status' => false));
        }
        exit;
    }

    /**
     * @param $username
     * @return mixed
     */
    private function getChannel($username)
    {
        $userModel = User::findFirst("username = '$username'");
        if ($userModel) {
            $receiverID = $userModel->getId();
            $senderId = $this->userModel->getId();
            $phql = "SELECT * FROM Channel WHERE receiver_id =$receiverID AND sender_id=$senderId
            OR receiver_id = $senderId AND sender_id = $receiverID";
            return $this->getDi()->getModelsManager()->createQuery($phql)->execute()->toArray();
        }
    }

    /**
     * @param $exportAction
     * @return array
     */
    private function export($exportAction)
    {
        $username = $this->request->getPost('username', "trim");
        $userModel = User::findFirst("username = '$username'");
        if ($userModel) {
            $receiverID = $userModel->getId();
            $senderId = $this->userModel->getId();
            $phql = "SELECT * FROM Channel WHERE receiver_id =$receiverID AND sender_id=$senderId
            OR receiver_id = $senderId AND sender_id = $receiverID";

            $res = $this->getDi()->getModelsManager()->createQuery($phql)->execute();
            if ($exportAction == 'history') {
                if ($res->count() != 1) {
                    $channel = new Channel();
                    $channel->setReceiverId($receiverID)
                        ->setSenderId($senderId)->save();
                }
                $data = $this->chatCore('history', $res);
            } else if ($exportAction == 'update') {
                $data = $this->chatCore($exportAction, $res);
            }
        }
        return $data;
    }

    /**
     * Export msg data, different scheme's
     * @param $exportAction
     * @param $res
     * @return array
     */
    private function chatCore($exportAction, $res)
    {
        $messages = $res[0]->getMessage()->toArray();
        if ($exportAction == 'update') {
            $currentCount = $res[0]->getMessage()->count();
            if ($this->session->get("msg")['count'] < $currentCount) {
                $difference = $currentCount - $this->session->get("msg")['count'];
            }

            for ($v = count($messages) - $difference; $v < count($messages); $v++) {
                $data[] = $this->getDataArray('update', $messages, $v);
            }

            if (!empty($data)) {
                $msg = new Phalcon\Session\Bag('msg');
                $msg->count = $currentCount;
                return $data;
            }
        } else if ($exportAction == 'history') {
            $msg = new Phalcon\Session\Bag('msg');
            $msg->count = $res[0]->getMessage()->count();

            for ($v = 0; $v < count($messages); $v++) {
                $data[] = $this->getDataArray('history', $messages, $v);
            }
        }
        return $data;
    }

    private function getDataArray($type, $messages, $v)
    {
        if ($type == 'update') {
            if ($this->userModel->getUsername() != $messages[$v]['username']) {
                return array(
                    'sender' => $messages[$v]['username'],
                    'receiver' => '',
                    'message' => $messages[$v]['message']
                );
            }
        } else if ($type == 'history') {
            if ($this->userModel->getUsername() == $messages[$v]['username']) {
                return array(
                    'sender' => $messages[$v]['username'],
                    'receiver' => '',
                    'message' => $messages[$v]['message']
                );
            } else {
                return array(
                    'sender' => '',//
                    'receiver' => $messages[$v]['username'],
                    'message' => $messages[$v]['message']
                );
            }

        }
    }
}