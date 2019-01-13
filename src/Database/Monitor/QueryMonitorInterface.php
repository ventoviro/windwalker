<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2019 ${ORGANIZATION}.
 * @license    __LICENSE__
 */

namespace Windwalker\Database\Monitor;


/**
 * Interface QueryMonitorInterface
 *
 * @since  3.5
 */
interface QueryMonitorInterface
{
    /**
     * Start a query monitor.
     *
     * @param string $query The SQL to be executed.
     *
     * @return  void
     *
     * @since  3.5
     */
    public function start(string $query): void;

    /**
     * Stop query monitor.
     *
     * @return  void
     *
     * @since  3.5
     */
    public function stop(): void;
}
