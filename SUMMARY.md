# Financial Transactions System

This project implements a financial transactions system using SOLID and GRASP principles and design patterns.



### Architecture

Used logic with base class and interface to implement the transaction system.
Tested and can be easily refactored to covariant and contravariant without interface.



### Design Patterns Used

- Singleton Pattern: Used from `src/Traits/SingletonTrait.php` in the `FTS\Services\AccountManager` and `FTS\Services\TransactionManager` classes to ensure that only one instance of each class is created.

- Factory Pattern: Used in the `src/Transactions/Transaction.php` class to create different types of transactions (Deposit, Withdrawal, Transfer).

- Strategy Pattern: Used in the `src/Services/TransactionManager` and in `src/Services/AccountManager` class to define different sorting strategies (by comment, by date) for the transaction list.

- Composite Pattern: Used in the `src/Services/TransactionManager` class to perform a transfer transaction involving two accounts.
