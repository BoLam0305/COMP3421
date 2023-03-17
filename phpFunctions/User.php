<?php


class User
{
    public $id;
    public $userName;
    public $password;
    public $email;
    public $phone;
    public $icon;
    public $type;
    public $status;


    public function setType($userType)
    {
        if ($userType == 'Admin') {
            $this->type = 1;
        } else {
            $this->type = 0;
        }

    }

    public function getType($typeID)
    {
        if ($typeID == 1) {
            return 'Admin';
        } else {
            return 'User';
        }
    }

    public function getStatus($status)
    {
        if ($status == 1) {
            return 'Disable';
        } else {
            return 'Enable';
        }
    }
}

?>