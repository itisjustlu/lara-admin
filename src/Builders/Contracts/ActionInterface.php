<?php

namespace LucasRuroken\Backoffice\Builders\Contracts;

use Illuminate\Support\Collection;
use LucasRuroken\Backoffice\Builders\Action;

interface ActionInterface
{
    /**
     * @return bool
     */
    public function isEnabled();


    /**
     * @return Action
     */
    public function enable();

    /**
     * @return Action
     */
    public function disable();

    /**
     * @return mixed
     */
    public function getLink();

    /**
     * @param string|void $link
     * @return Action
     */
    public function setLink($link);

    /**
     * @return string
     */
    public function getLabeled();

    /**
     * @param string $labeled
     * @return Action
     */
    public function setLabeled($labeled);

    /**
     * @return string
     */
    public function getClass();

    /**
     * @param string $class
     * @return Action
     */
    public function setClass($class);

    /**
     * @return string
     */
    public function getDataToggle();

    /**
     * @param string $dataToggle
     * @return Action
     */
    public function setDataToggle($dataToggle);

    /**
     * @return string
     */
    public function getDataPlacement();

    /**
     * @param string $dataPlacement
     * @return Action
     */
    public function setDataPlacement($dataPlacement);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $title
     * @return Action
     */
    public function setTitle($title);

    /**
     * @param string $method
     * @return Action
     */
    public function asForm($method = 'POST');

    /**
     * @return string
     */
    public function getMethod();

    /**
     * @return Action
     */
    public function asLink();

    /**
     * @return bool
     */
    public function isForm();

    /**
     * @return boolean
     */
    public function isLink();

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function add($key, $value);

    /**
     * @return mixed
     */
    public function getCsrfField();

    /**
     * @param mixed $csrfField
     * @return Action
     */
    public function setCsrfField($csrfField);

    /**
     * @return Collection
     */
    public function getExtras();

    /**
     * @param Collection $model
     * @return string
     */
    public function render(Collection $model);

    /**
     * @return string
     */
    public function __toString();
}