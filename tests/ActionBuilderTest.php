<?php

namespace LucasRuroken\Backoffice\Tests;

use Illuminate\Support\Collection;
use LucasRuroken\Backoffice\Builders\Action;
use LucasRuroken\Backoffice\Builders\ActionBuilder;
use PHPUnit\Framework\TestCase;

class ActionBuilderTest extends TestCase
{
    public function testInstanceOfNewAction()
    {
        $actionBuilder = new ActionBuilder();
        $actionBuilder->build();

        $this->assertInstanceOf(Collection::class, $actionBuilder->getActions());
        $this->assertInstanceOf(Action::class, $actionBuilder->getActions()->first());
    }

    public function testBuildedActions()
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

        $this->expectOutputString(file_get_contents(__DIR__ . '/html/test_link_returned.html') . file_get_contents(__DIR__ . '/html/test_form_returned.html'));
        print($actionBuilder);
    }

    public function testActionWithFalseLink()
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

        $actionBuilder->build()
            ->setLink(function()
            {
                return false;
            })
            ->setClass('custom-class-2');

        $this->expectOutputString(file_get_contents(__DIR__ . '/html/test_link_returned.html'));
        print($actionBuilder);
    }
}