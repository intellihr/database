<?php

namespace Bosnadev\Database\Schema;

use Closure;

/**
 * Class Builder
 * @package Bosnadev\Database\Schema
 */
class Builder extends \Illuminate\Database\Schema\PostgresBuilder
{
    /**
     * Create a new command set with a Closure.
     *
     * @param string $table
     * @param Closure $callback
     * @return Blueprint
     */
    protected function createBlueprint($table, Closure $callback = null)
    {
        return new Blueprint($table, $callback);
    }

    /**
     * Determine if the given table exists.
     *
     * @param  string  $table
     * @return bool
     */
    public function hasTable($table)
    {
        $sql = $this->grammar->compileTableExists();

        $table = $this->connection->getTablePrefix().$table;

        $result = $this->connection->selectOne($sql, [$table]);

        return $result->exists !== null;
    }
}
