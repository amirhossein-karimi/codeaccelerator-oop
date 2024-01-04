<?php

namespace Models;

use Enums\TransactionType;
use Exception;
use Values\Amount;

final class Transaction
{

    public function __construct(
        private int $userID,
        private Amount $amount,
        private TransactionType $transactionType,
        private string $created_at
    ) {
        if ($userID <= 0) {
            throw new Exception('User id is not valid');
        }
    }
    public function getUserID(): int
    {
        return $this->userID;
    }

    public function getAmount(): Amount
    {
        return $this->amount;
    }
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function getTransactionType(): int
    {
        return $this->transactionType->value;
    }
}
