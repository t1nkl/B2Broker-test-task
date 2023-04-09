<?php

declare(strict_types=1);

namespace FTS\Services;

use FTS\Account;
use FTS\Traits\SingletonTrait;
use FTS\Traits\TransactionsTrait;
use FTS\Transactions\ITransaction;
use RuntimeException;

class AccountManager
{
    use SingletonTrait;
    use TransactionsTrait;

    /**
     * @var Account[] $accounts
     */
    private array $accounts = [];

    /**
     * @param  Account  $account
     * @return void
     */
    public function addAccount(Account $account): void
    {
        $this->accounts[] = $account;
    }

    /**
     * @param  int  $id
     * @return Account
     */
    public function findAccountById(int $id): Account
    {
        foreach ($this->accounts as $account) {
            if ($account->getId() === $id) {
                return $account;
            }
        }

        throw new RuntimeException('Account with ID ' . $id . ' not found');
    }

    /**
     * @return Account[]
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }

    /**
     * @param  Account  $account
     * @return float
     */
    public function getAccountBalance(Account $account): float
    {
        return $account->getBalance();
    }

    /**
     * @param  Account  $account
     * @param  float  $balance
     * @return void
     */
    public function setAccountBalance(Account $account, float $balance): void
    {
        $account->setBalance($balance);
    }

    /**
     * @param  Account  $account
     * @param  ITransaction  $transaction
     * @return void
     */
    public function addAccountTransaction(Account $account, ITransaction $transaction): void
    {
        $account->addTransaction($transaction);
    }

    /**
     * @param  Account  $account
     * @return ITransaction[]
     */
    public function getAccountTransactions(Account $account): array
    {
        return $account->getTransactions();
    }

    /**
     * @param  Account  $account
     * @return ITransaction[]
     */
    public function getTransactionsSortedByComment(Account $account): array
    {
        return $this->sortTransactionsByComment($this->getAccountTransactions($account));
    }

    /**
     * @param  Account  $account
     * @return ITransaction[]
     */
    public function getTransactionsSortedByDate(Account $account): array
    {
        return $this->sortTransactionsByDate($this->getAccountTransactions($account));
    }
}
