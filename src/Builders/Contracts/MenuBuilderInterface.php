<?php

namespace LucasRuroken\LaraAdmin\Builders\Contracts;

use Illuminate\Database\Eloquent\Collection;
use LucasRuroken\LaraAdmin\Builders\Button;

interface MenuBuilderInterface
{
    /**
     * @return Button
     */
    public function build();

    /**
     * @return Collection
     */
    public function getButtons();
}