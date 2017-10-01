<?php

namespace TwoDojo\Test\Module\Stubs;

use TwoDojo\Module\AbstractModule;

class ModuleStub extends AbstractModule
{
    protected $name = 'ModuleStub';

    protected $description = 'Module Stub Description';

    protected $major = 1;

    protected $minor = 2;

    protected $patch = 25;

    public $testEventReceived;

    protected $authors = [
        [
            'name' => 'Tester Guy',
            'email' => 'tester@guy.com'
        ]
    ];

    protected $uniqueName = '2dojo/module_stub';

    public function setModulePath($path)
    {
        $this->modulePath = $path;
    }

    public function onTestEvent()
    {
        $this->testEventReceived = true;
    }
}
