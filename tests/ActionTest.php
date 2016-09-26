<?php

namespace LucasRuroken\Backoffice\Tests;

use LucasRuroken\Backoffice\Builders\ActionBuilder;
use PHPUnit\Framework\TestCase;

class ActionTest extends TestCase
{
    public function test_ifNewActionsAreStored()
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

        $actionFirst = $actionBuilder->getActions()->first();
        $actionLast = $actionBuilder->getActions()->last();

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
        $actionBuilder = new ActionBuilder();
        $actionBuilder->build()
            ->setLink(function(){

                return false;
            });

        $this->assertFalse($actionBuilder->getActions()->first()->isEnabled());
    }

    public function test_callableLinkInTrue()
    {
        $actionBuilder = new ActionBuilder();
        $actionBuilder->build()
            ->setLink(function(){

                return true;
            });

        $this->assertTrue($actionBuilder->getActions()->first()->isEnabled());
    }

    public function test_callableLinkString()
    {
        $actionBuilder = new ActionBuilder();
        $actionBuilder->build()
            ->setLink(function(){

                return '/mi-link';
            });

        $this->assertEquals('/mi-link', $actionBuilder->getActions()->first()->getLink());
    }

    public function test_ifGetClassReturnsNull()
    {
        $actionBuilder = new ActionBuilder();
        $actionBuilder->build();

        $this->assertNull($actionBuilder->getActions()->first()->getClass());
        $this->assertTrue($actionBuilder->getActions()->first()->getClass() ? false : true);
    }

    public function test_outputSimpleLink()
    {
        $actionBuilder = new ActionBuilder();
        $actionBuilder->build()
            ->setLink('/my-profile')
            ->setLabeled('Texter');

        $this->expectOutputString(file_get_contents(__DIR__ . '/html/test_simple_link_returned.html'));
        print($actionBuilder->getActions()->first());
    }

    public function test_outputAdvancedLink()
    {
        $actionBuilder = new ActionBuilder();
        $actionBuilder->build()
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
        print($actionBuilder->getActions()->first());
    }

    public function test_outputAdvancedForm()
    {
        $actionBuilder = new ActionBuilder();
        $actionBuilder->build()
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
        print($actionBuilder->getActions()->first());
    }
}