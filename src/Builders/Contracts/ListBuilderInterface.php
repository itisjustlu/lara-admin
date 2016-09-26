<?php

namespace LucasRuroken\Backoffice\Builders\Contracts;

use Illuminate\Support\Collection;
use LucasRuroken\Backoffice\Builders\ActionBuilder;

interface ListBuilderInterface
{
    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

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
     * @param array $columns
     */
    public function buildColumnTitles(array $columns);

    /**
     * @return Collection
     */
    public function getColumnTitles();

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
     * @return Collection
     */
    public function getInformation();

    /**
     * @return array
     */
    public function render();
}