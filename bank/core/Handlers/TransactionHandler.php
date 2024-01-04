<?php

namespace Handlers;

use Enums\TransactionType;
use Infra\CustomDate;
use Models\Transaction;
use Services\TransactionService;

final class TransactionHandler
{

    public function __construct(
        private array $data,
        private TransactionService $transactionService,
        private CustomDate $date
    ) {
    }

    public function handler(): void
    {
        $transaction = new Transaction(
            $this->data['userID'],
            $this->data['amount'],
            TransactionType::DEPOSIT,
            $this->date->now()
        );

        $this->transactionService->create($transaction);
    }
}
