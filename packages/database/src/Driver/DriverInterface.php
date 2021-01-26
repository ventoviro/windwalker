<?php

/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2019 LYRASOFT.
 * @license    MIT
 */

declare(strict_types=1);

namespace Windwalker\Database\Driver;

use Windwalker\Query\Query;

/**
 * Interface DriverInterface
 */
interface DriverInterface
{
    public function isSupported(): bool;

    /**
     * connect
     *
     * @return  ConnectionInterface
     */
    public function getConnection(): ConnectionInterface;

    /**
     * Use a connection then auto release.
     *
     * @param  callable  $callback
     *
     * @return  ConnectionInterface
     */
    public function useConnection(callable $callback): ConnectionInterface;

    /**
     * disconnect
     *
     * @return  int
     */
    public function disconnectAll(): int;

    /**
     * Prepare a statement.
     *
     * @param  string|Query  $query
     * @param  array         $options
     *
     * @return  StatementInterface
     */
    public function prepare(mixed $query, array $options = []): StatementInterface;

    /**
     * Execute a query.
     *
     * @param  string|Query  $query
     * @param  array|null    $params
     *
     * @return StatementInterface
     */
    public function execute(mixed $query, ?array $params = null): StatementInterface;

    /**
     * Method to get last auto-increment ID value.
     *
     * @param  string|null  $sequence
     *
     * @return string|null
     */
    public function lastInsertId(?string $sequence = null): ?string;

    /**
     * Quote and escape a value.
     *
     * @param  string  $value
     *
     * @return  string
     */
    public function quote(string $value): string;

    /**
     * Escape a value.
     *
     * @param  string  $value
     *
     * @return  string
     */
    public function escape(string $value): string;

    public function getVersion(): string;
}
