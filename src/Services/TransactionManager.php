<?php

declare(strict_types=1);

namespace FTS\Services;

use FTS\Account;
use FTS\Traits\SingletonTrait;
use FTS\Traits\TransactionsTrait;
use FTS\Transactions\Deposit;
use FTS\Transactions\ITransaction;
use FTS\Transactions\Transfer;
use FTS\Transactions\Withdrawal;
use RuntimeException;

class TransactionManager
{
    use SingletonTrait;
    use TransactionsTrait;

    /**
     * @var ITransaction[] $transactions
     */
    private array $transactions = [];

    /**
     * @param  ITransaction  $transaction
     * @return void
     */
    public function addTransaction(ITransaction $transaction): void
    {
        $this->transactions[] = $transaction;
    }

    /**
     * @return AccountManager
     */
    public function getAccountManager(): AccountManager
    {
        return AccountManager::getInstance();
    }

    /**
     * @param  ITransaction  $transaction
     * @param  Account  $account
     * @return void
     */
    public function performTransaction(ITransaction $transaction, Account $account): void
    {
        switch (true) {
            case $transaction instanceof Deposit:
                $this->handleDeposit($transaction, $account);
                break;
            case $transaction instanceof Withdrawal:
                $this->handleWithdrawal($transaction, $account);
                break;
            case $transaction instanceof Transfer:
                $this->handleTransfer($transaction);
                break;
            default:
                throw new RuntimeException('Transaction type not supported');
        }
    }

    /**
     * @param  Deposit  $transaction
     * @param  Account  $account
     * @return void
     */
    private function handleDeposit(Deposit $transaction, Account $account): void
    {
        $this->addTransaction($transaction);

        $this->getAccountManager()->setAccountBalance($account, $this->getAccountManager()->getAccountBalance($account) + $transaction->getAmount());
        $this->getAccountManager()->addAccountTransaction($account, $transaction);
    }

    /**
     * @param  Withdrawal  $transaction
     * @param  Account  $account
     * @return void
     */
    private function handleWithdrawal(Withdrawal $transaction, Account $account): void
    {
        $this->addTransaction($transaction);

        $this->getAccountManager()->setAccountBalance($account, $this->getAccountManager()->getAccountBalance($account) - $transaction->getAmount());
        $this->getAccountManager()->addAccountTransaction($account, $transaction);
    }

    /**
     * @param  Transfer  $transaction
     * @return void
     */
    private function handleTransfer(Transfer $transaction): void
    {
        $fromAccount = $this->getAccountManager()->findAccountById($transaction->getFromAccountId());
        $toAccount = $this->getAccountManager()->findAccountById($transaction->getToAccountId());

        $this->addTransaction($transaction);

        $this->getAccountManager()->setAccountBalance(
            $fromAccount,
            $this->getAccountManager()->getAccountBalance($fromAccount) - $transaction->getAmount()
        );
        $this->getAccountManager()->addAccountTransaction($fromAccount, $transaction);

        $this->getAccountManager()->setAccountBalance(
            $toAccount,
            $this->getAccountManager()->getAccountBalance($toAccount) + $transaction->getAmount()
        );
        $this->getAccountManager()->addAccountTransaction($toAccount, $transaction);
    }

    /**
     * @return ITransaction[]
     */
    public function getTransactionsSortedByComment(): array
    {
        return $this->sortTransactionsByComment($this->transactions);
    }

    /**
     * @return ITransaction[]
     */
    public function getTransactionsSortedByDate(): array
    {
        return $this->sortTransactionsByDate($this->transactions);
    }
}
