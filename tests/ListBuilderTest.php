<?php

namespace Tests;

use Illuminate\Support\Collection;
use LucasRuroken\Backoffice\Builders\ActionBuilder;
use LucasRuroken\Backoffice\Builders\ListBuilder;
use PHPUnit\Framework\TestCase;

class ListBuilderTest extends TestCase
{
    /** @type ActionBuilder */
    private $actionBuilder;
    /** @type ListBuilder */
    private $listBuilder;

    public function setUp()
    {
        $this->actionBuilder = new ActionBuilder();
        $this->listBuilder = new ListBuilder();
    }

    public function testSetActionBuilder()
    {
        $this->listBuilder->setActionBuilder($this->actionBuilder);

        $this->assertEquals($this->actionBuilder, $this->listBuilder->getActionBuilder());
    }

    public function testVisibleColumns()
    {
        $this->listBuilder->buildColumns(['name', 'title', 'created_at', 'updated_at']);
        $this->listBuilder->hideColumns(['title', 'created_at', 'body']);

        $this->assertEquals(
            (new Collection(['name', 'updated_at']))->toArray(),
            (array_values($this->listBuilder->visibleColumns()->toArray())) /** Use array_values to re order the array key */
        );
    }
}