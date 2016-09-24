<?php

namespace LucasRuroken\Backoffice\Builders;

use Illuminate\Support\Collection;
use LucasRuroken\Backoffice\Builders\Contracts\ActionBuilderInterface;

class ActionBuilder implements ActionBuilderInterface
{
    /**
     * @type Collection
     */
    private $actions;

    /**
     * ActionBuilder constructor.
     */
    public function __construct()
    {
        $this->actions = new Collection();
    }

    /**
     * @return Action
     */
    public function build()
    {
        $action = new Action();
        $this->actions->push($action);

        return $action;
    }

    /**
     * @return Collection
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $toString = '';

        foreach($this->actions AS $action)
        {
            $toString .= $action->__toString();
        }

        return $toString;
    }
}