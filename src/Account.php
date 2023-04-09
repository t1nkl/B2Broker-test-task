<?php

declare(strict_types=1);

namespace FTS;

use FTS\Transactions\ITransaction;

class Account
{
    private int $id;
    private float $balance = 0;

    /**
     * @var ITransaction[] $transactions
     */
    private array $transactions = [];

    /**
     * Account constructor.
     * @param  int  $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @param  float  $balance
     * @return void
     */
    public function setBalance(float $balance): void
    {
        $this->balance = $balance;
    }

    /**
     * @return ITransaction[]
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }

    /**
     * @param  ITransaction  $transaction
     * @return void
     */
    public function addTransaction(ITransaction $transaction): void
    {
        $this->transactions[] = $transaction;
    }
}
