<?php

namespace LucasRuroken\Backoffice\Builders;

use Illuminate\Support\Collection;
use LucasRuroken\Backoffice\Builders\Contracts\ActionInterface;

class Action implements ActionInterface
{
    /**
     * @type bool
     */
    private $enabled;

    /**
     * @type void|string
     */
    private $link;

    /**
     * @type string
     */
    private $labeled;

    /**
     * @type string
     */
    private $class;

    /**
     * @type string
     */
    private $dataToggle;

    /**
     * @type string
     */
    private $dataPlacement;

    /**
     * @type string
     */
    private $title;

    /**
     * @type string
     */
    private $asForm;

    /**
     * @type string
     */
    private $method;

    /**
     * @type string
     */
    private $asLink;

    /**
     * @type string
     */
    private $csrfField;

    /**
     * @type Collection
     */
    private $extras;

    public function __construct()
    {
        $this->enabled = true;
        $this->asLink = true;
        $this->asForm = false;
        $this->extras = new Collection();
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return Action
     */
    public function enable()
    {
        $this->enabled = true;

        return $this;
    }

    /**
     * @return Action
     */
    public function disable()
    {
        $this->enabled = false;

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
     * @param string|void $link
     * @return Action
     */
    public function setLink($link)
    {
        if(is_callable($link))
        {
            if(!$link())
            {
                $this->disable();
            }

            $this->link = $link();
        }
        else
        {
            $this->link = $link;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getLabeled()
    {
        return $this->labeled;
    }

    /**
     * @param string $labeled
     * @return Action
     */
    public function setLabeled($labeled)
    {
        $this->labeled = $labeled;

        return $this;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param string $class
     * @return Action
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * @return string
     */
    public function getDataToggle()
    {
        return $this->dataToggle;
    }

    /**
     * @param string $dataToggle
     * @return Action
     */
    public function setDataToggle($dataToggle)
    {
        $this->dataToggle = $dataToggle;

        return $this;
    }

    /**
     * @return string
     */
    public function getDataPlacement()
    {
        return $this->dataPlacement;
    }

    /**
     * @param string $dataPlacement
     * @return Action
     */
    public function setDataPlacement($dataPlacement)
    {
        $this->dataPlacement = $dataPlacement;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Action
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string $method
     * @return Action
     */
    public function asForm($method = 'POST')
    {
        $this->asForm = true;
        $this->asLink = false;
        $this->method = $method;

        return $this;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return Action
     */
    public function asLink()
    {
        $this->asLink = true;
        $this->asForm = false;

        return $this;
    }

    /**
     * @return bool
     */
    public function isForm()
    {
        return $this->asForm;
    }

    /**
     * @return boolean
     */
    public function isLink()
    {
        return $this->asLink;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function add($key, $value)
    {
        if($key == 'class')
        {
            $this->setClass($this->getClass() . ' '. $value);
        }
        else if($key == 'title')
        {
            $this->setTitle($this->getTitle() . ' '. $value);
        }
        else
        {
            $this->extras->put($key, $value);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCsrfField()
    {
        return $this->csrfField;
    }

    /**
     * @param mixed $csrfField
     * @return Action
     */
    public function setCsrfField($csrfField)
    {
        $this->csrfField = $csrfField;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getExtras()
    {
        return $this->extras;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if(!$this->isEnabled())
        {
            return '';
        }

        $attributes = [];

        if($this->getClass())
        {
            $attributes[] = 'class="' . $this->getClass() . '"';
        }

        if($this->getTitle())
        {
            $attributes[] = 'title="' . $this->getTitle() . '"';
        }

        if($this->getDataPlacement())
        {
            $attributes[] = 'data-placement="' . $this->getDataPlacement() . '"';
        }

        if($this->getDataToggle())
        {
            $attributes[] = 'data-toggle="' . $this->getDataToggle() . '"';
        }

        foreach($this->getExtras() AS $key => $value)
        {
            $attributes[] = $key . '="' . $value . '"';
        }

        if($this->isLink())
        {
            $toString = '<a href="' . $this->getLink() . '" '. implode(' ', $attributes) . '>';
            $toString .= $this->getLabeled();
            $toString .= '</a>';
        }
        else
        {
            $toString = '<form action="' . $this->getLink() . '" method="' . $this->getMethod() . '">';

            if($this->getCsrfField())
            {
                $toString .= $this->getCsrfField();
            }

            // If csrfField is not given, It will search
            // in the helpers library if the csrf_field function exists
            if(!$this->getCsrfField() && function_exists('csrf_field'))
            {
                $toString .= csrf_field();
            }

            $toString .= '<button type="submit" '. implode(' ', $attributes) . '>' . $this->getLabeled() . '</button>';
            $toString .= '</form>';
        }

        return $toString;
    }
}