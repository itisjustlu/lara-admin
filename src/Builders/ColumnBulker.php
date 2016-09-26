<?php

namespace LucasRuroken\Backoffice\Builders;

use Illuminate\Support\Collection;
use LucasRuroken\Backoffice\Builders\Contracts\ColumnBulkerInterface;

class ColumnBulker implements ColumnBulkerInterface
{
    /**
     * @type Collection
     */
    private $bulkedColumns;

    public function __construct()
    {
        $this->bulkedColumns = new Collection();
    }

    /**
     * @param string $columnName
     * @param void|string $callback
     */
    public function set($columnName, $callback)
    {
        $this->bulkedColumns->put($columnName, $callback);
    }

    /**
     * @param string $columnName
     * @param Collection $row
     * @return string
     */
    public function bulk($columnName, Collection $row)
    {
        $call = $this->bulkedColumns->get($columnName, $columnName);

        if(is_callable($call))
        {
            return call_user_func($call, $row);
        }

        return $call;
    }
}