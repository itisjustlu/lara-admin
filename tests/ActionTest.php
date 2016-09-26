<?php

namespace LucasRuroken\LaraAdmin\Tests;

use LucasRuroken\LaraAdmin\Builders\ActionBuilder;
use PHPUnit\Framework\TestCase;

class ActionTest extends TestCase
{
    /** @type ActionBuilder */
    private $actionBuilder;

    public function setUp()
    {
        $this->actionBuilder = new ActionBuilder();
    }

    public function test_ifNewActionsAreStored()
    {
        $this->actionBuilder
            ->build()
            ->setLink('/mi-link')
            ->setClass('custom-class')
            ->setDataPlacement('top')
            ->setDataToggle('tooltip')
            ->setTitle('Title')
            ->setLabeled('icon-fa')
            ->asForm('PATCH');


        $this->actionBuilder
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

        $actionFirst = $this->actionBuilder->getActions()->first();
        $actionLast = $this->actionBuilder->getActions()->last();

        $this->assertEquals('/mi-link', $actionFirst->getLink());
        $this->assertEquals('custom-class', $actionFirst->getClass());
        $this->assertEquals('top', $actionFirst->getDataPlacement());
        $this->assertEquals('tooltip', $actionFirst->getDataToggle());
        $this->assertEquals('Title', $actionFirst->getTitle());
        $this->assertEquals('icon-fa', $actionFirst->getLabeled());
        $this->assertEquals('PATCH', $actionFirst->getMethod());
        $this->assertTrue($actionFirst->isForm());
        $this->assertFalse($actionFirst->isLink());

        $this->assertEquals('/mi-link-2', $actionLast->getLink());
        $this->assertEquals('custom-class-2 custom-class', $actionLast->getClass());
        $this->assertEquals('bottom', $actionLast->getDataPlacement());
        $this->assertEquals('tooltip', $actionLast->getDataToggle());
        $this->assertEquals('Title 2 Extend Title', $actionLast->getTitle());
        $this->assertEquals('icon-fa-2', $actionLast->getLabeled());
        $this->assertFalse($actionLast->isForm());
        $this->assertTrue($actionLast->isLink());
    }

    public function test_callableLinkInFalse()
    {
        $this->actionBuilder->build()
            ->setLink(function(){

                return false;
            });

        $this->assertFalse($this->actionBuilder->getActions()->first()->isEnabled());
    }

    public function test_callableLinkInTrue()
    {
        $this->actionBuilder->build()
            ->setLink(function(){

                return true;
            });

        $this->assertTrue($this->actionBuilder->getActions()->first()->isEnabled());
    }

    public function test_callableLinkString()
    {
        $this->actionBuilder->build()
            ->setLink(function(){

                return '/mi-link';
            });

        $this->assertEquals('/mi-link', $this->actionBuilder->getActions()->first()->getLink());
    }

    public function test_ifGetClassReturnsNull()
    {
        $this->actionBuilder->build();

        $this->assertNull($this->actionBuilder->getActions()->first()->getClass());
        $this->assertTrue($this->actionBuilder->getActions()->first()->getClass() ? false : true);
    }

    public function test_outputSimpleLink()
    {
        $this->actionBuilder->build()
            ->setLink('/my-profile')
            ->setLabeled('Texter');

        $this->expectOutputString(file_get_contents(__DIR__ . '/html/test_simple_link_returned.html'));
        print($this->actionBuilder->getActions()->first());
    }

    public function test_outputAdvancedLink()
    {
        $this->actionBuilder->build()
            ->setLink('/my-profile')
            ->setClass('custom-class-2')
            ->setDataPlacement('bottom')
            ->setDataToggle('tooltip')
            ->setTitle('Title 2')
            ->setLabeled('icon-fa-2')
            ->add('class', 'custom-class')
            ->add('title', 'Extend Title')
            ->asLink();

        $this->expectOutputString(file_get_contents(__DIR__ . '/html/test_link_returned.html'));
        print($this->actionBuilder->getActions()->first());
    }

    public function test_outputAdvancedForm()
    {
        $this->actionBuilder->build()
            ->setLink('/my-profile')
            ->setClass('custom-class-2')
            ->setDataPlacement('bottom')
            ->setDataToggle('tooltip')
            ->setTitle('Title 2')
            ->setLabeled('icon-fa-2')
            ->add('class', 'custom-class')
            ->add('title', 'Extend Title')
            ->setCsrfField('<input type="hidden" name="_token" value="123" />')
            ->asForm();

        $this->expectOutputString(file_get_contents(__DIR__ . '/html/test_form_returned.html'));
        print($this->actionBuilder->getActions()->first());
    }

    public function testSnake()
    {
        $reflection = 'class';

        $this->assertTrue(method_exists(self::class, 'getClass'));
    }

    public function getClass()
    {

    }
}