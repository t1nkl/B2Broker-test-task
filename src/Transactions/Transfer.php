<?php

declare(strict_types=1);

namespace FTS\Transactions;

use DateTimeImmutable;

class Transfer extends Transaction implements ITransaction
{
    /**
     * @param  string  $comment
     * @param  float  $amount
     * @param  DateTimeImmutable  $dueDate
     * @param  int  $fromAccountId
     * @param  int  $toAccountId
     */
    public function __construct(
        private readonly string $comment,
        private readonly float $amount,
        private readonly DateTimeImmutable $dueDate,
        private readonly int $fromAccountId,
        private readonly int $toAccountId
    ) {
        parent::__construct($comment, $amount, $dueDate);
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return 'transfer';
    }

    /**
     * @return int
     */
    public function getFromAccountId(): int
    {
        return $this->fromAccountId;
    }

    /**
     * @return int
     */
    public function getToAccountId(): int
    {
        return $this->toAccountId;
    }
}
