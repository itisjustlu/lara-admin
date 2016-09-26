<?php

namespace Tests;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
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

    public function testFillInformation()
    {
        $dataX = new Collection(['name' => 'Dummy Name X', 'title' => 'Dummy Title X']);
        $dataY = new Collection(['name' => 'Dummy Name Y', 'title' => 'Dummy Title Y']);

        $info = new Collection([$dataX, $dataY]);

        $this->listBuilder->fillInformation($info);

        $this->assertEquals('Dummy Name X', $this->listBuilder->getInformation()->first()['name']);
        $this->assertEquals('Dummy Title X', $this->listBuilder->getInformation()->first()['title']);
        $this->assertEquals('Dummy Name Y', $this->listBuilder->getInformation()->last()['name']);
        $this->assertEquals('Dummy Title Y', $this->listBuilder->getInformation()->last()['title']);
    }

    public function testListBuilderToString()
    {
        $dataX = new Collection(['id' => 1, 'name' => 'Dummy Name X', 'title' => 'Dummy Title X']);
        $dataY = new Collection(['id' => 2, 'name' => 'Dummy Name Y', 'title' => 'Dummy Title Y']);

        $info = new Collection([$dataX, $dataY]);

        $this->listBuilder->fillInformation($info);

        $actionBuilder = new ActionBuilder();
        $actionBuilder->build()
            ->setLabeled('Delete')
            ->setClass('id-delete')
            ->setTitle('Delete');

        $this->listBuilder->setActionBuilder($actionBuilder);

        $this->listBuilder->buildColumns(['id', 'name']);
        $this->listBuilder->hideColumns(['id']);

        $this->expectOutputString(View::make());
    }
}