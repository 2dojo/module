<?php

namespace TwoDojo\Test\Module\Stubs;

use TwoDojo\Module\AbstractModule;

class DisabledModuleStub extends AbstractModule
{
    protected $name = 'DisabledModuleStub';

    public function isEnabled(): bool
    {
        return false;
    }
}
