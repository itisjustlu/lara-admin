<?php

namespace LucasRuroken\Backoffice\Builders;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection AS EloquentCollection;
use LucasRuroken\Backoffice\Builders\Contracts\ListBuilderInterface;

class ListBuilder implements ListBuilderInterface
{
    /**
     * @type Collection
     */
    private $columns;

    /**
     * @type Collection
     */
    private $hiddenColumns;

    /**
     * @type ActionBuilder
     */
    private $actionBuilder;

    /**
     * @type EloquentCollection
     */
    private $information;

    /**
     * @param array $columns
     */
    public function buildColumns(array $columns)
    {
        $this->columns = new Collection($columns);
    }

    /**
     * @param array $hiddenColumns
     */
    public function hideColumns(array $hiddenColumns)
    {
        $this->hiddenColumns = new Collection($hiddenColumns);
    }

    /**
     * @param ActionBuilder $actionBuilder
     */
    public function setActionBuilder(ActionBuilder $actionBuilder)
    {
        $this->actionBuilder = $actionBuilder;
    }

    /**
     * @param EloquentCollection $information
     */
    public function fillInformation(EloquentCollection $information)
    {
        $this->information = $information;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return PHP_EOL;
    }
}