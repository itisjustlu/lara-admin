<?php

$menuBuilder = new \LucasRuroken\LaraAdmin\Builders\MenuBuilder();

$menuBuilder->build()
    ->setName('Home')
    ->setLink('')
    ->setIcon('<i class="fa fa-dashboard"></i>');

$menuBuilder->build()
    ->setName('Articles')
    ->setLink('')
    ->setIcon('<i class="fa fa-files-o"></i>')
    ->setButton
    (
        (new \LucasRuroken\LaraAdmin\Builders\Button())
        ->setName('Published')
            ->setLink('/published')
            ->setIcon('<i class="fa fa-files"></i>')
    );

return ['menu-builder' => $menuBuilder];