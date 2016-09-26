<?php

namespace LucasRuroken\Backoffice\Builders\Contracts;

use Illuminate\Support\Collection;

interface ColumnBulkerInterface
{
    /**
     * @param string $columnName
     * @param void|string $callback
     */
    public function set($columnName, $callback);

    /**
     * @param string $columnName
     * @param Collection $row
     * @return string
     */
    public function bulk($columnName, Collection $row);
}