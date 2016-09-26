<?php

namespace LucasRuroken\Backoffice\Tests;

use LucasRuroken\Backoffice\Builders\Button;
use LucasRuroken\Backoffice\Builders\MenuBuilder;
use PHPUnit\Framework\TestCase;

class MenuBuilderTest extends TestCase
{
    /** @type MenuBuilder */
    private $menuBuilder;

    public function setUp()
    {
        $this->menuBuilder = new MenuBuilder();
    }

    public function test_newMenu()
    {
        /** @type MenuBuilder */
        $this->menuBuilder
            ->build()
            ->setLink('/linked')
            ->setName('Named')
            ->setIcon('<i class="fa fa-icon"></i>')
            ->setButton
            (
                (new Button())
                    ->setName('Sub')
                    ->setLink('/sub-linked')
                    ->setIcon(null)

            )
            ->setButton
            (
                (new Button())
                    ->setName('Sub 2')
                    ->setLink('/sub-linked-2')
                    ->setIcon('<i></i>')

            );

        $this->menuBuilder
            ->build()
            ->setLink('/linked-2')
            ->setName('Named')
            ->setIcon('<i class="fa fa-icon"></i>');

        $this->assertTrue($this->menuBuilder->getButtons()->first()->hasButtons());
        $this->assertFalse($this->menuBuilder->getButtons()->last()->hasButtons());

        $this->assertEquals('/linked', $this->menuBuilder->getButtons()->first()->getLink());
        $this->assertEquals('/linked-2', $this->menuBuilder->getButtons()->last()->getLink());

        $this->assertEquals('/sub-linked', $this->menuBuilder->getButtons()->first()->getButtons()->first()->getLink());
        $this->assertEquals('/sub-linked-2', $this->menuBuilder->getButtons()->first()->getButtons()->last()->getLink());
    }
}