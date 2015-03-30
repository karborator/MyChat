<?php

class AjaxController extends BaseController
{

    public function historyAction()
    {
        $this->view->disable();
        echo json_encode($this->chatCore('history'));
        exit;

    }

    public function updateAction()
    {
        $this->view->disable();
        echo json_encode($this->chatCore('update'));
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
    private function chatCore($exportAction)
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
                $data = $this->export('history', $res);
            } else if ($exportAction == 'update') {
                $data = $this->export($exportAction, $res);
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
    private function export($exportAction, $res)
    {
        if ($exportAction == 'update') {
            $currentCount = $res[0]->getMessage()->count();
            if ($this->session->get("msg")['count'] < $currentCount) {
                $difference = $currentCount - $this->session->get("msg")['count'];
                $messages = $res[0]->getMessage()->toArray();
            }
            for ($v = count($messages) - $difference; $v < count($messages); $v++) {
                if ($this->userModel->getUsername() != $messages[$v]['username']) {
                    $data[] = array(
                        'sender' => $messages[$v]['username'],
                        'receiver' => '',
                        'message' => $messages[$v]['message']
                    );
                }
            }
            if (!empty($data)) {
                $msg = new Phalcon\Session\Bag('msg');
                $msg->count = $currentCount;
                return $data;
            }
        } else if ($exportAction == 'history') {
            $msg = new Phalcon\Session\Bag('msg');
            $msg->count = $res[0]->getMessage()->count();

            for ($i = 0; $i < $res->count(); $i++) {
                $messages = $res[$i]->getMessage()->toArray();
                for ($v = 0; $v < count($messages); $v++) {
                    if ($this->userModel->getUsername() == $messages[$v]['username']) {
                        $data[] = array(
                            'sender' => $messages[$v]['username'],
                            'receiver' => '',
                            'message' => $messages[$v]['message']
                        );
                    } else {
                        $data[] = array(
                            'sender' => '',//
                            'receiver' => $messages[$v]['username'],
                            'message' => $messages[$v]['message']
                        );
                    }
                }
            }
        }
        return $data;
    }
}