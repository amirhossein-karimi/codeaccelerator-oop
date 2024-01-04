<?php

namespace Repositories;

use Infra\Repository;
use Models\Transaction;


final class TransactionRepository extends Repository
{

    public function save(Transaction $transaction): int
    {
        $stmt =  $this->conn->prepare("INSERT INTO transactions (user_id,type,amount,created_at) VALUE (?,?,?,?)");
        $stmt->bind_param('iiis', $user_id, $type, $amount, $created_at);
        $user_id = $transaction->getUserID();
        $type = $transaction->getTransactionType();
        $amount = $transaction->getAmount()->getAmount();
        $created_at = $transaction->getCreatedAt();
        $stmt->execute();
        return $stmt->insert_id;
    }
}
