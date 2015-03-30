<?php

class AjaxController extends BaseController
{

    public function historyAction()
    {
        $this->view->disable();
        $username = $this->request->getPost('username');
        $userModel = User::findFirst("username = '$username'");
        if ($userModel) {
            $receiverID = $userModel->getId();
            $senderId = $this->userModel->getId();
            $phql = "SELECT * FROM Channel WHERE receiver_id =$receiverID AND sender_id=$senderId
            OR receiver_id = $senderId AND sender_id = $receiverID";
            $res = $this->getDi()->getModelsManager()->createQuery($phql)->execute();

            if ($res->count() == 1) {
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

                echo json_encode($data);
                exit;
            } else {
                $channel = new Channel();
                $channel->setReceiverId($receiverID)
                    ->setSenderId($senderId)->save();
            }
        }
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

    public function updateAction()
    {
        $this->view->disable();
        $username = $this->request->getPost('username', "trim");
        $userModel = User::findFirst("username = '$username'");

        if ($userModel) {
            $receiverID = $userModel->getId();
            $senderId = $this->userModel->getId();
            $phql = "SELECT * FROM Channel WHERE receiver_id =$receiverID AND sender_id=$senderId
            OR receiver_id = $senderId AND sender_id = $receiverID";

            $res = $this->getDi()->getModelsManager()->createQuery($phql)->execute();
            $currentCount = $res[0]->getMessage()->count();

            if ($this->session->get("msg")['count'] < $currentCount) {
                $difference = $currentCount - $this->session->get("msg")['count'];
                $messages = $res[0]->getMessage()->toArray();

                for ($v = count($messages) - $difference; $v < count($messages); $v++) {
                    if ($this->userModel->getUsername() != $messages[$v]['username']) {
                        $data[] = array(
                            'sender' => $messages[$v]['username'],
                            'receiver' => '',
                            'message' => $messages[$v]['message']
                        );
                    }
                }

            }
            if (!empty($data)) {
                $msg = new Phalcon\Session\Bag('msg');
                $msg->count = $currentCount;
            }
            echo json_encode($data);
            exit;
        }
    }

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
}