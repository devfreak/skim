<?php
// src/Acme/TaskBundle/Entity/Task.php
namespace Acme\HelloBundle\Entity;

class Optin
{

    protected $email;

    public function setEMail($value)
    {
        $this->email = $value;
    }

    public function getEMail()
    {
        return $this->email;
    }

}