<?php

namespace LucasRuroken\Backoffice\Builders\Contracts;

use Illuminate\Support\Collection;
use LucasRuroken\Backoffice\Builders\Button;

interface ButtonInterface
{
    /**
     * @param string $name
     * @return Button
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $icon
     * @return Button
     */
    public function setIcon($icon);

    /**
     * @return string
     */
    public function getIcon();

    /**
     * @param mixed $link
     * @return Button
     */
    public function setLink($link);

    /**
     * @return mixed
     */
    public function getLink();

    /**
     * @param Button $button
     * @return Button
     */
    public function setButton(Button $button);

    /**
     * @return Collection
     */
    public function getButtons();
}