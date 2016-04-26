<?php

namespace App\Repositories;

use App\Core\DbConnector;

class UserRepository
{
    /**
     * @param $id
     * @return bool|mixed
     */
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

    /**
     * @param $email
     * @return bool|mixed
     */
    public function findByEmail($email)
    {
        $con = DbConnector::getConnection();
        $stmt = $con->prepare("SELECT id, firstName, lastName, email, password, city, birthdate, unicorns, active FROM Users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetchObject('App\Models\User');
            return $user;
        } else {
            return false;
        }
    }
}
