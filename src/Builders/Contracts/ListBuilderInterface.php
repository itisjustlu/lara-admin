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
     * @return Collection
     */
    public function getColumns();

    /**
     * @param array $hiddenColumns
     */
    public function hideColumns(array $hiddenColumns);

    /**
     * @return Collection
     */
    public function getHiddenColumns();

    /**
     * @return Collection
     */
    public function visibleColumns();

    /**
     * @param ActionBuilder $actionBuilder
     */
    public function setActionBuilder(ActionBuilder $actionBuilder);

    /**
     * @return ActionBuilder
     */
    public function getActionBuilder();

    /**
     * @param Collection $information
     */
    public function fillInformation(Collection $information);

    /**
     * @return string
     */
    public function __toString();
}