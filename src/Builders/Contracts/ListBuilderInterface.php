<?php

namespace LucasRuroken\Backoffice\Builders\Contracts;

use Illuminate\Database\Eloquent\Collection AS EloquentCollection;
use LucasRuroken\Backoffice\Builders\ActionBuilder;

interface ListBuilderInterface
{
    /**
     * @param array $columns
     */
    public function buildColumns(array $columns);

    /**
     * @param array $hiddenColumns
     */
    public function hideColumns(array $hiddenColumns);

    /**
     * @param ActionBuilder $actionBuilder
     */
    public function setActionBuilder(ActionBuilder $actionBuilder);

    /**
     * @param EloquentCollection $information
     */
    public function fillInformation(EloquentCollection $information);

    /**
     * @return string
     */
    public function __toString();
}