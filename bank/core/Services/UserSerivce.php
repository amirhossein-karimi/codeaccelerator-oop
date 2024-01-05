<?php

namespace Services;

use Infra\Event;
use Models\User;
use Repositories\UserRepository;
use Values\Amount;

final class UserSerivce
{

    public function __construct(
        private UserRepository $userRepository,
        private Event $event
    ) {
    }

    public function register(User $user): void
    {
        $this->userRepository->save($user);
    }


    public function deactivation(int $userID): void
    {

        $user = $this->findUser($userID);
        $user->deactivation();
        $this->userRepository->update($userID, $user);
    }

    public function activation(int $userID): void
    {

        $user = $this->findUser($userID);
        $user->activation();
        $this->userRepository->update($userID, $user);
    }

    public function withDrawal(int $userID, Amount $amount, string $currentDate): void
    {
        $user = $this->findUser($userID);
        $user->withDrawal($amount->getAmount(), $currentDate);

        /**
         * @ notice two approach for this problem 
         * 
         * 1- transactioanl system
         * 2- event driven system
         */

        $this->event->dispath('WithDrawal', [
            'userID' => $userID,
            'amount' => $amount,
            'currentDate' => $currentDate
        ]);
    }

    public function deposit(int $userID, Amount $amount, string $currentDate): void
    {
        $user = $this->findUser($userID);
        $user->deposit($amount->getAmount(), $currentDate);

        /**
         * @ notice two approach for this problem 
         * 
         * 1- transactioanl system
         * 2- event driven system
         */

        $this->event->dispath('Deposit', [
            'userID' => $userID,
            'amount' => $amount,
            'currentDate' => $currentDate
        ]);
    }

    public function accountTransfer(int $senderID, int $receiverID,  Amount $amount, string $currentDate): void
    {

        $user = $this->findUser($senderID);
        $user->withDrawal($amount->getAmount(), $currentDate);

        $this->event->dispath('WithDrawal', [
            'userID' => $senderID,
            'amount' => $amount,
            'currentDate' => $currentDate
        ]);

        $user = $this->findUser($receiverID);
        $user->deposit($amount->getAmount(), $currentDate);

        $this->event->dispath('Deposit', [
            'userID' => $receiverID,
            'amount' => $amount,
            'currentDate' => $currentDate
        ]);
    }


    public function getListOfTransactions(int $userID): array
    {
        $user = $this->findUser($userID);
        return $user->getTransactions();
    }

    private function findUser(int $userID): User
    {

        $userData = $this->userRepository->findByID($userID);
        $user = User::createFromArray($userData);
        return $user;
    }
}
