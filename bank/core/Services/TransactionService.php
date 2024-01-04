<?php

namespace Services;

use Models\Transaction;
use Repositories\TransactionRepository;

final class TransactionService
{

    public function __construct(private TransactionRepository $transactionRepository)
    {
    }


    public function create(Transaction $transaction): void
    {
        $this->transactionRepository->save($transaction);
    }
}
