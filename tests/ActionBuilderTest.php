<?php

namespace LucasRuroken\Backoffice\Tests;

use Illuminate\Support\Collection;
use LucasRuroken\Backoffice\Builders\Action;
use LucasRuroken\Backoffice\Builders\ActionBuilder;
use PHPUnit\Framework\TestCase;

class ActionBuilderTest extends TestCase
{
    /** @type ActionBuilder */
    private $actionBuilder;

    public function setUp()
    {
        $this->actionBuilder = new ActionBuilder();
    }

    public function test_outputBuildedActions()
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

        $this->expectOutputString(file_get_contents(__DIR__ . '/html/test_link_returned.html') . file_get_contents(__DIR__ . '/html/test_form_returned.html'));
        print($this->actionBuilder);
    }

    public function test_outputWithFalseAction()
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

        $this->actionBuilder->build()
            ->setLink(function()
            {
                return false;
            })
            ->setClass('custom-class-3');

        $this->expectOutputString(file_get_contents(__DIR__ . '/html/test_link_returned.html'));
        print($this->actionBuilder);
    }
}