<?php

namespace LucasRuroken\LaraAdmin\Builders;

use Illuminate\Support\Collection;
use LucasRuroken\LaraAdmin\Builders\Contracts\ActionBuilderInterface;

class ActionBuilder implements ActionBuilderInterface
{
    /**
     * @type Collection
     */
    private $actions;

    /**
     * @type Collection
     */
    private $model;

    /**
     * ActionBuilder constructor.
     */
    public function __construct()
    {
        $this->actions = new Collection();
        $this->model = new Collection();
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
     * @param Collection $model
     * @return string
     */
    public function render(Collection $model)
    {
        $this->model = $model;

        return $this->__toString();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $toString = '';

        foreach($this->actions AS $action)
        {
            $toString .= $action->render($this->model);
        }

        return $toString;
    }
}