<?php

namespace LucasRuroken\Backoffice\Builders\Contracts;

use Illuminate\Support\Collection;
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
     * @param Collection $information
     */
    public function fillInformation(Collection $information);

    /**
     * @return string
     */
    public function __toString();
}