<?php

namespace LucasRuroken\LaraAdmin\Tests;

use Illuminate\Support\Collection;
use LucasRuroken\LaraAdmin\Builders\ColumnBulker;
use PHPUnit\Framework\TestCase;

class ColumnBulkerTest extends TestCase
{
    public function test_bulkedColumns()
    {
        $bulker = new ColumnBulker();
        $bulker
            ->set('name', function(Collection $row){
                return 'Name '. $row['name'];
            })
            ->set('title', function(Collection $row){
                return 'Title '. $row['title'];
            });

        $this->assertEquals('Name Lucas', $bulker->bulk('name', new Collection(['name' => 'Lucas']), 'Default name'));
        $this->assertEquals('Title Custom', $bulker->bulk('title', new Collection(['title' => 'Custom']), 'Default title'));
        $this->assertEquals('Default body', $bulker->bulk('body', new Collection(['x' => 'Custom']), 'Default body'));
    }
}