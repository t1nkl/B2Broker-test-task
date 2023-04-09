<?php

declare(strict_types=1);

namespace FTS\Traits;

use FTS\Transactions\ITransaction;

trait TransactionsTrait
{
    /**
     * @param  ITransaction[]  $transactions
     * @return ITransaction[]
     */
    public function sortTransactionsByComment(array $transactions): array
    {
        $data = $transactions;
        usort($data, static function ($a, $b): int {
            return strcmp($a->getComment(), $b->getComment());
        });

        return $data;
    }

    /**
     * @param  ITransaction[]  $transactions
     * @return ITransaction[]
     */
    public function sortTransactionsByDate(array $transactions): array
    {
        $data = $transactions;
        usort($data, static function ($a, $b): int {
            return $a->getDueDate() <=> $b->getDueDate();
        });

        return $data;
    }

}
