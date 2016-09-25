<?php

namespace LucasRuroken\Backoffice\Builders\Contracts;

interface ListBuilderInterface
{
    public function buildColumns();

    public function hideColumns();

    public function setActions();

    public function fillInformation();
}