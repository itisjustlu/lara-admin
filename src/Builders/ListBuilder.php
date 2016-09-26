<?php

namespace LucasRuroken\Backoffice\Builders;

use Illuminate\Support\Collection;
use LucasRuroken\Backoffice\Builders\Contracts\ListBuilderInterface;

class ListBuilder implements ListBuilderInterface
{
    /**
     * @type string
     */
    private $name;

    /**
     * @type Collection
     */
    private $columns;

    /**
     * @type Collection
     */
    private $hiddenColumns;

    /**
     * @type Collection
     */
    private $columnTitles;

    /**
     * @type ActionBuilder
     */
    private $actionBuilder;

    /**
     * @type Collection
     */
    private $information;

    /**
     * @type ColumnBulker
     */
    private $columnBulkers;

    public function __construct()
    {
        $this->columns = new Collection();
        $this->hiddenColumns = new Collection();
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param array $columns
     */
    public function buildColumns(array $columns)
    {
        $this->columns = new Collection($columns);
    }

    /**
     * @return Collection
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @param array $hiddenColumns
     */
    public function hideColumns(array $hiddenColumns)
    {
        $this->hiddenColumns = new Collection($hiddenColumns);
    }

    /**
     * @return Collection
     */
    public function getHiddenColumns()
    {
        return $this->hiddenColumns;
    }

    /**
     * @return Collection
     */
    public function visibleColumns()
    {
        return $this->columns->diff($this->hiddenColumns);
    }

    /**
     * @param array $columns
     */
    public function buildColumnTitles(array $columns)
    {
        $this->columnTitles = new Collection($columns);
    }

    /**
     * @return Collection
     */
    public function getColumnTitles()
    {
        return $this->columnTitles;
    }

    /**
     * @param ActionBuilder $actionBuilder
     */
    public function setActionBuilder(ActionBuilder $actionBuilder)
    {
        $this->actionBuilder = $actionBuilder;
    }

    /**
     * @return ActionBuilder
     */
    public function getActionBuilder()
    {
        return $this->actionBuilder;
    }

    /**
     * @param Collection $information
     */
    public function fillInformation(Collection $information)
    {
        $this->information = $information;
    }

    /**
     * @return Collection
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * @param ColumnBulker $columnBulkers
     */
    public function fillBulkers(ColumnBulker $columnBulkers)
    {
        $this->columnBulkers = $columnBulkers;
    }

    /**
     * @return ColumnBulker
     */
    public function getBulkers()
    {
        return $this->columnBulkers;
    }

    /**
     * @return array
     */
    public function render()
    {
        return [
            'actions' => $this->getActionBuilder(),
            'bulker' => $this->getBulkers(),
            'columns' => $this->visibleColumns(),
            'fullColumns' => $this->getColumns(),
            'information' => $this->getInformation(),
            'name' => $this->getName(),
            'titles' => $this->getColumnTitles(),
        ];
    }
}