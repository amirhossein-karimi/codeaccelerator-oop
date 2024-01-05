<?php


namespace Repositories;

use Infra\Repository;
use Models\User;

final class UserRepository extends Repository
{

    public function save(User $user): int
    {
        $stmt = $this->conn->prepare("INSERT INTO users (name,family,status) VALUES (?,?,?)");
        $stmt->bind_param('ssi', $name, $family, $status);
        $name = $user->getName();
        $family = $user->getFamily();
        $status = $user->getStatus();
        $stmt->execute();
        return $stmt->insert_id;
    }


    public function findByID($userID): array
    {

        $SQL = "SELECT users.*,transactions.type,transactions.amount,transactions.created_at FROM users LEFT JOIN transactions ON transactions.user_id = users.id WHERE users.id = ?";

        $stmt = $this->conn->prepare($SQL);
        $stmt->bind_param('i', $userID);
        $stmt->execute();
        $user = $stmt->get_result();
        $row = [];

        while ($data = $user->fetch_assoc()) {
            if (!isset($row['user'])) {
                $row['user'] = [
                    'id' => $data['id'],
                    'name' => $data['name'],
                    'family' => $data['family'],
                    'status' => $data['status']
                ];
            }
            $row['transactions'][] = [
                'amount' => $data['amount'],
                'type' => $data['type'],
                'created_at' => $data['created_at']
            ];
        }
        return $row;
    }

    public function update(int $userID, User $user): void
    {
        $stmt = $this->conn->prepare("UPDATE users SET name =?,family=?,status=? WHERE id = ?");
        $stmt->bind_param("ssii" , $name,$family,$status,$userID);
        $name = $user->getName();
        $family = $user->getFamily();
        $status = $user->getStatus();
        $stmt->execute();

    }
}
