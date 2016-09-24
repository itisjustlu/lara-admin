<?php

namespace LucasRuroken\Backoffice\Tests;

use Illuminate\Support\Collection;
use LucasRuroken\Backoffice\Builders\Action;
use LucasRuroken\Backoffice\Builders\ActionBuilder;

class ActionBuilderTest extends \PHPUnit\Framework\TestCase
{
    public function testSetNewAction()
    {
        $actionBuilder = new ActionBuilder();
        $actionBuilder->build();

        $this->assertInstanceOf(Collection::class, $actionBuilder->getActions());
        $this->assertInstanceOf(Action::class, $actionBuilder->getActions()->first());
    }

    public function testNewAction()
    {
        $actionBuilder = new ActionBuilder();
        $actionBuilder
            ->build()
            ->setLink('/mi-link')
            ->setClass('custom-class')
            ->setDataPlacement('top')
            ->setDataToggle('tooltip')
            ->setTitle('Title')
            ->setLabeled('icon-fa')
            ->asForm('PATCH');


        $actionBuilder
            ->build()
            ->setLink('/mi-link-2')
            ->setClass('custom-class-2')
            ->setDataPlacement('bottom')
            ->setDataToggle('tooltip')
            ->setTitle('Title 2')
            ->setLabeled('icon-fa-2')
            ->add('class', 'custom-class')
            ->add('title', 'Extend Title')
            ->asLink();

        $this->assertEquals('/mi-link', $actionBuilder->getActions()->first()->getLink());
        $this->assertEquals('custom-class', $actionBuilder->getActions()->first()->getClass());
        $this->assertEquals('top', $actionBuilder->getActions()->first()->getDataPlacement());
        $this->assertEquals('tooltip', $actionBuilder->getActions()->first()->getDataToggle());
        $this->assertEquals('Title', $actionBuilder->getActions()->first()->getTitle());
        $this->assertEquals('icon-fa', $actionBuilder->getActions()->first()->getLabeled());
        $this->assertEquals('PATCH', $actionBuilder->getActions()->first()->getMethod());
        $this->assertTrue($actionBuilder->getActions()->first()->isForm());
        $this->assertFalse($actionBuilder->getActions()->first()->isLink());

        $this->assertEquals('/mi-link-2', $actionBuilder->getActions()->last()->getLink());
        $this->assertEquals('custom-class-2 custom-class', $actionBuilder->getActions()->last()->getClass());
        $this->assertEquals('bottom', $actionBuilder->getActions()->last()->getDataPlacement());
        $this->assertEquals('tooltip', $actionBuilder->getActions()->last()->getDataToggle());
        $this->assertEquals('Title 2 Extend Title', $actionBuilder->getActions()->last()->getTitle());
        $this->assertEquals('icon-fa-2', $actionBuilder->getActions()->last()->getLabeled());
        $this->assertFalse($actionBuilder->getActions()->last()->isForm());
        $this->assertTrue($actionBuilder->getActions()->last()->isLink());
    }

    public function testCallableLinkFalseReturn()
    {
        $actionBuilder = new ActionBuilder();
        $actionBuilder->build()
            ->setLink(function(){

                return false;
            });

        $this->assertFalse($actionBuilder->getActions()->first()->isEnabled());
    }

    public function testCallableLinkTrueReturn()
    {
        $actionBuilder = new ActionBuilder();
        $actionBuilder->build()
            ->setLink(function(){

                return true;
            });

        $this->assertTrue($actionBuilder->getActions()->first()->isEnabled());
    }

    public function testCallableLinkStringReturn()
    {
        $actionBuilder = new ActionBuilder();
        $actionBuilder->build()
            ->setLink(function(){

                return '/mi-link';
            });

        $this->assertEquals('/mi-link', $actionBuilder->getActions()->first()->getLink());
    }

    public function testNullableGetClass()
    {
        $actionBuilder = new ActionBuilder();
        $actionBuilder->build()
            ->setLink(function(){

                return '/mi-link';
            });

        $this->assertNull($actionBuilder->getActions()->first()->getClass());
        $this->assertTrue($actionBuilder->getActions()->first()->getClass() ? false : true);
    }

    public function testSimpleLinkReturned()
    {
        $actionBuilder = new ActionBuilder();
        $actionBuilder->build()
            ->setLink('/mi-perfil');

//        $this->assertEquals(file_get_contents(__DIR__ . '/html/test_simple_link_returned.html'), $actionBuilder->getActions()->first());
    }
}