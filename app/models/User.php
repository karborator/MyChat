<?php
use Phalcon\Mvc\Model\Relation;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class User extends BaseModel
{

    private $id;
    private $email;
    private $username;
    private $password;

    public function initialize()
    {
        $this->hasOne('id', 'Session', 'user_id', array(
            'alias' => 'session',
            'foreignKey' => Relation::ACTION_CASCADE
        ));
    }

    public function validation()
    {

        $this->validate(new PresenceOf(
            array(
                "field" => "email",
                "message" => "Email is required "
            )
        ));

        $this->validate(new PresenceOf(
            array(
                "field" => "username",
                "message" => "Username is required"
            )
        ));

        $this->validate(new PresenceOf(
            array(
                "field" => "password",
                "message" => "Password is required"
            )
        ));

        $this->validate(new EmailValidator(
            array(
                "field" => "email",
                "message" => "Email address is not correct"
            )
        ));

        $this->validate(new Uniqueness(
            array(
                "field" => "email",
                "message" => "Email is already taken"
            )
        ));

        $this->validate(new Uniqueness(
            array(
                "field" => "username",
                "message" => "Username is already taken"
            )
        ));

        return $this->validationHasFailed() != true;
    }

    public function auth($email, $password)
    {
        $userModel = User::findFirst("email = '$email'");
        if ($userModel) {
            if ($this->getDi()->getSecurity()->checkHash($password, $userModel->getPassword())) {
                $this->getDi()->getFlashSession()->success('Welcome ' . $userModel->getUsername() . '!');
                $this->setSession($userModel);
                return $userModel;
            }
        }
        $this->getDi()->getFlashSession()->error('Wrong credentials!');
        return false;
    }

    /**
     * @param User $userModel
     */
    public function setSession(User $userModel)
    {
        $userId = $userModel->getId();
        $sessionModel = Session::findFirst("user_id = '$userId'");
        if (empty($sessionModel)) {
            $sessionModel = new Session();
        }
        $sessionModel->setUserId($userModel->getId())
            ->setSession($this->getDi()->getSecurity()->hash($userModel->getPassword() . $userModel->getEmail()))
            ->setActive(1)->save();

        $this->getDi()->getSession()->set('auth', $sessionModel->getSession());
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        if (!empty($password)) {
            $this->password = $this->getDi()->getSecurity()->hash($password);
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
}