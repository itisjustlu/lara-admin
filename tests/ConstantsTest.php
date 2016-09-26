<?php

namespace LucasRuroken\Backoffice\Tests;

use LucasRuroken\Backoffice\Constants\ViewConstants;
use PHPUnit\Framework\TestCase;

class ConstantsTest extends TestCase
{
    public function testViews()
    {
        $this->assertEquals('backoffice', ViewConstants::BACKOFFICE);
        $this->assertEquals('backoffice::lists', ViewConstants::BACKOFFICE_LIST);
    }
}