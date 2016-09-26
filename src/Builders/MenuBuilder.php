<?php

namespace LucasRuroken\Backoffice\Builders;

use Illuminate\Support\Collection;
use LucasRuroken\Backoffice\Builders\Contracts\MenuBuilderInterface;

class MenuBuilder implements MenuBuilderInterface
{
    /**
     * @type Collection
     */
    private $buttons;

    public function __construct()
    {
        $this->buttons = new Collection();
    }

    /**
     * @return Button
     */
    public function build()
    {
        $button = new Button();
        $this->buttons->push($button);

        return $button;
    }
}