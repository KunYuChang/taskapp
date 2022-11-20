<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
//    public function verifyPassword($password)
//    {
//        return password_verify($password, $this->password_hash);
//    }

    public function activate()
    {
        $this->is_active = true;
        $this->activation_hash = null;
    }
}