<?php

declare(strict_types=1);

namespace FTS\Transactions;

use DateTimeImmutable;

interface ITransaction {
    /**
     * @return string
     */
    public function type(): string;

    /**
     * @return string
     */
    public function getComment(): string;

    /**
     * @return float
     */
    public function getAmount(): float;

    /**
     * @return DateTimeImmutable
     */
    public function getDueDate(): DateTimeImmutable;
}
