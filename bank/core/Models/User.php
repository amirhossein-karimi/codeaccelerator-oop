<?php

namespace Models;

use Enums\TransactionType;
use Enums\UserStatus;
use Exception;

final class User
{

    const DAILY_ACCOUNT_WITHDRAWAL_LIMIT = 1000;

    public function __construct(
        private string $name,
        private string $family,
        private UserStatus $status,
        private array $transactions
    ) {
    }

    public static function createFromArray(array $userData): User
    {

        if (!isset($userData['user'])) {
            throw new Exception('User not exist');
        }

        return new User(
            $userData['user']['name'],
            $userData['user']['family'],
            UserStatus::from($userData['user']['status']),
            $userData['transactions']
        );
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function getFamily(): string
    {
        return $this->family;
    }

    public function getStatus(): string
    {
        return $this->status->value;
    }

    public function getTransactions(): array
    {
        return $this->transactions;
    }

    public function deactivation(): void
    {

        if ($this->status === UserStatus::DEACTIVE) {
            throw new Exception('User already is deactive');
        }
        $this->status = UserStatus::DEACTIVE;
    }

    public function activation(): void
    {

        if ($this->status === UserStatus::ACTIVE) {
            throw new Exception('User already is active');
        }
        $this->status = UserStatus::ACTIVE;
    }

    public function deposit(float $amount, string $created_at): void
    {
        if ($this->status === UserStatus::DEACTIVE) {
            throw new Exception('This user is deactive and cannot deposit');
        }

        array_push($this->transactions, [
            'type' => TransactionType::DEPOSIT->value,
            'amount' => $amount,
            'created_at' => $created_at
        ]);
    }

    public function withDrawal(float $amount, string $created_at): void
    {

        if ($this->status === UserStatus::DEACTIVE) {
            throw new Exception('This user is deactive and cannot withdrawal');
        }

        if ($this->canUserWithDrawalToDay($created_at) === FALSE) {
            throw new Exception('Your daily withdrawal limit has been reached');
        }

        $sumOfDeposit = $this->calculateSumOfDeposits();
        $sumOfWithDrawal = $this->calculateSumOfWithDrawal();

        $currentAmount = $sumOfDeposit - $sumOfWithDrawal;

        if ($currentAmount <= 100 || $currentAmount <= $amount) {
            throw new Exception('Your account balance is insufficient for withdrawal');
        }

        array_push($this->transactions, [
            'type' => TransactionType::WITHDRAWAL->value,
            'amount' => $amount,
            'created_at' => $created_at
        ]);
    }

    private function calculateSumOfDeposits(): float
    {
        $deposits = array_filter($this->transactions, function ($tranaction) {

            if ($tranaction['type'] === TransactionType::DEPOSIT->value) {
                return $tranaction;
            }
        });

        $sumOfDeposit = array_sum(array_column($deposits, 'amount'));
        return $sumOfDeposit;
    }

    private function calculateSumOfWithDrawal(): float
    {
        $withDrawals = array_filter($this->transactions, function ($tranaction) {

            if ($tranaction['type'] === TransactionType::WITHDRAWAL->value) {
                return $tranaction;
            }
        });

        $sumOfWithDrawal = array_sum(array_column($withDrawals, 'amount'));
        return $sumOfWithDrawal;
    }

    private function canUserWithDrawalToDay(string $date): bool
    {

        $dateRangeForReview = date("Y-m-d H:i:s", strtotime('-24 hours', strtotime($date)));

        $withDrawalsListInDateRange = array_filter($this->transactions, function ($transaction) use ($dateRangeForReview) {
            if ($transaction['created_at'] >= $dateRangeForReview && $transaction['type'] === TransactionType::WITHDRAWAL->value) {
                return $transaction;
            }
        });

        $sumOfWithDrawalOfDay = array_sum(array_column($withDrawalsListInDateRange, 'amount'));

        return self::DAILY_ACCOUNT_WITHDRAWAL_LIMIT > $sumOfWithDrawalOfDay;
    }
}
