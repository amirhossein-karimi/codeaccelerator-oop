<?php

namespace Handlers;

use Enums\TransactionType;
use Models\Transaction;
use Repositories\TransactionRepository;


final class DepositHandler
{

    public function __construct(
        private array $data,
        private TransactionRepository $transactionRepository
    ) {
    }

    public function handler(): void
    {
        $transaction = new Transaction(
            $this->data['userID'],
            $this->data['amount'],
            TransactionType::DEPOSIT,
            $this->data['currentDate']
        );
        $this->transactionRepository->save($transaction);
    }
}
