<?php

namespace LucasRuroken\Backoffice\Builders\Contracts;

use LucasRuroken\Backoffice\Builders\Button;

interface MenuBuilderInterface
{
    /**
     * @return Button
     */
    public function build();
}