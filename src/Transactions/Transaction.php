<?php

declare(strict_types=1);

namespace FTS\Transactions;

use DateTimeImmutable;

class Transaction
{
    private string $id;

    /**
     * @param  string  $comment
     * @param  float  $amount
     * @param  DateTimeImmutable  $dueDate
     */
    public function __construct(
        private readonly string $comment,
        private readonly float $amount,
        private readonly DateTimeImmutable $dueDate
    ) {
        $this->id = uuid4();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDueDate(): DateTimeImmutable
    {
        return $this->dueDate;
    }
}
