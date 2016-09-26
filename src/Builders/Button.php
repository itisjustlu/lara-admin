<?php

namespace LucasRuroken\Backoffice\Builders;

use Illuminate\Support\Collection;
use LucasRuroken\Backoffice\Builders\Contracts\ButtonInterface;

class Button implements ButtonInterface
{
    /**
     * @type string
     */
    private $name;

    /**
     * @type string
     */
    private $icon;

    /**
     * @type string
     */
    private $link;

    /**
     * @type Collection
     */
    private $buttons;

    public function __construct()
    {
        $this->buttons = new Collection();
    }

    /**
     * @param string $name
     * @return Button
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $icon
     * @return Button
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param mixed $link
     * @return Button
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param Button $button
     * @return Button
     */
    public function setButton(Button $button)
    {
        $this->buttons->push($button);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     * @return bool
     */
    public function hasButtons()
    {
        return !$this->getButtons()->isEmpty();
    }
}