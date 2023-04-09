<?php

/**
 * EXAMPLE USAGE OF THE CODE
 */

use FTS\Account;
use FTS\Services\AccountManager;
use FTS\Services\TransactionManager;
use FTS\Transactions\Deposit;
use FTS\Transactions\Transfer;
use FTS\Transactions\Withdrawal;

require_once 'vendor/autoload.php';

// Create accounts
$account1 = new Account(1);
$account2 = new Account(2);

// Add accounts to account manager
$accountManager = AccountManager::getInstance();
$accountManager->addAccount($account1);
$accountManager->addAccount($account2);

// Create transactions and perform them on account 1
$transactionManager = TransactionManager::getInstance();
$transaction = new Deposit('Deposit ' . random_int(1, 10), random_float(1000, 9999), new DateTimeImmutable('2023-01-01 00:00:' . random_int(10, 59)));
$transactionManager->performTransaction($transaction, $account1);
$transaction = new Withdrawal('Withdrawal ' . random_int(1, 10), random_float(1000, 9999), new DateTimeImmutable('2023-01-01 00:00:' . random_int(10, 59)));
$transactionManager->performTransaction($transaction, $account1);
$transaction = new Transfer('Transfer ' . random_int(1, 10), random_float(1000, 9999), new DateTimeImmutable('2023-01-01 00:00:' . random_int(10, 59)), $account1->getId(), $account2->getId());
$transactionManager->performTransaction($transaction, $account1);
$transaction = new Withdrawal('Withdrawal ' . random_int(1, 10), random_float(1000, 9999), new DateTimeImmutable('2023-01-01 00:00:' . random_int(10, 59)));
$transactionManager->performTransaction($transaction, $account1);
$transaction = new Withdrawal('Withdrawal ' . random_int(1, 10), random_float(1000, 9999), new DateTimeImmutable('2023-01-01 00:00:' . random_int(10, 59)));
$transactionManager->performTransaction($transaction, $account1);
$transaction = new Deposit('Deposit ' . random_int(1, 10), random_float(1000, 9999), new DateTimeImmutable('2023-01-01 00:00:' . random_int(10, 59)));
$transactionManager->performTransaction($transaction, $account1);
$transaction = new Withdrawal('Withdrawal ' . random_int(1, 10), random_float(1000, 9999), new DateTimeImmutable('2023-01-01 00:00:' . random_int(10, 59)));
$transactionManager->performTransaction($transaction, $account1);
$transaction = new Deposit('Deposit ' . random_int(1, 10), random_float(1000, 9999), new DateTimeImmutable('2023-01-01 00:00:' . random_int(10, 59)));
$transactionManager->performTransaction($transaction, $account1);



$accounts = $accountManager->getAccounts();
foreach ($accounts as $account) {
    echo 'Account with ID: ' . $account->getId() . ' has balance: ' . round($accountManager->getAccountBalance($account), 2) . '<br>';

    /**
     * This is just an example of how to use the AccountManager class
     */
    $transactions = $accountManager->getAccountTransactions($account);
    echo "Account with ID: {$account->getId()} has " . count($transactions) . " transactions: <br>";

    foreach ($transactions as $transaction) {
        echo "Transaction ID: {$transaction->getId()} | " .
            "Transaction type: " . strtoupper($transaction->type()) . " | " .
            "Transaction amount: " . round($transaction->getAmount(), 2) . " | " .
            "Transaction comment: {$transaction->getComment()} | " .
            "Transaction due date: {$transaction->getDueDate()->format('H:i:s')}<br>";
    }
    echo '<br>';

    echo 'getTransactionsSortedByComment:<br>';
    $transactions = $accountManager->getTransactionsSortedByComment($account);
    foreach ($transactions as $transaction) {
        echo "Transaction ID: {$transaction->getId()} | " .
            "Transaction type: " . strtoupper($transaction->type()) . " | " .
            "Transaction amount: " . round($transaction->getAmount(), 2) . " | " .
            "Transaction comment: {$transaction->getComment()} | " .
            "Transaction due date: {$transaction->getDueDate()->format('H:i:s')}<br>";
    }
    echo '<br>';

    echo 'getTransactionsSortedByDate:<br>';
    $transactions = $accountManager->getTransactionsSortedByDate($account);
    foreach ($transactions as $transaction) {
        echo "Transaction ID: {$transaction->getId()} | " .
            "Transaction type: " . strtoupper($transaction->type()) . " | " .
            "Transaction amount: " . round($transaction->getAmount(), 2) . " | " .
            "Transaction comment: {$transaction->getComment()} | " .
            "Transaction due date: {$transaction->getDueDate()->format('H:i:s')}<br>";
    }
    echo '<br><br><br><hr>';
}

exit;
