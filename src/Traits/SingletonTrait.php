<?php

namespace FTS\Traits;

trait SingletonTrait
{
    // @phpstan-ignore-next-line
    private static $instance = null;

    /**
     * @return static
     */
    public static function getInstance(): static
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __destruct()
    {
        self::$instance = null;
    }
}
