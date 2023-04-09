<?php

declare(strict_types=1);

namespace FTS\Transactions;

class Deposit extends Transaction implements ITransaction
{
    /**
     * @return string
     */
    public function type(): string
    {
        return 'deposit';
    }
}
