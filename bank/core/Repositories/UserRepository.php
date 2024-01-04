<?php

namespace Repositories;

use Infra\Repository;
use Models\User;

final class UserRepository extends Repository
{

    public function save(User $user): int
    {
        $stmt =  $this->conn->prepare("INSERT INTO users (name,family,status) VALUE (?,?,?)");
        $stmt->bind_param('ssi', $name, $family, $status);
        $name = $user->getName();
        $family = $user->getFamily();
        $status = $user->getStatus();
        $stmt->execute();
        return $stmt->insert_id;
    }
}
