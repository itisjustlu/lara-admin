<?php

namespace LucasRuroken\Backoffice\Builders\Contracts;

use Illuminate\Database\Eloquent\Collection;
use LucasRuroken\Backoffice\Builders\Button;

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