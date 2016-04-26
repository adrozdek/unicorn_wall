<?php

namespace App\Repositories;

use App\Core\DbConnector;

class UserRepository
{
    public function findById($id)
    {
        $con = DbConnector::getConnection();
        $stmt = $con->prepare("SELECT id, firstName, lastName, email, password, city, birthdate, unicorns, active FROM Users WHERE id = ?");
        $stmt->execute([$id]);
        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetchObject('App\Models\User');
            return $user;
        } else {
            return false;
        }
    }

    public function findByEmail($email)
    {
        $con = DbConnector::getConnection();
        $stmt = $con->prepare("SELECT id, firstName, lastName, email, password, city, birthdate, unicorns, active FROM Users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetchObject('App\Models\User');
            var_dump($user);
            return $user;
        } else {
            return false;
        }
    }
}
