<?php

namespace LucasRuroken\LaraAdmin\Builders;

use Illuminate\Support\Collection;
use LucasRuroken\LaraAdmin\Builders\Contracts\MenuBuilderInterface;

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

    /**
     * @return Collection
     */
    public function getButtons()
    {
        return $this->buttons;
    }
}