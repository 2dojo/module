<?php

namespace TwoDojo\Test\Module;

use TwoDojo\Test\Module\Stubs\ModuleStub;
use TwoDojo\Test\Module\Stubs\DisabledModuleStub;

class AbstractModuleTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers \TwoDojo\Module\AbstractModule::isEnabled()
     */
    public function testCanGetIsEnabled()
    {
        $this->assertTrue((new ModuleStub())->isEnabled());
        $this->assertFalse((new DisabledModuleStub())->isEnabled());
    }

    /**
     * @covers \TwoDojo\Module\AbstractModule::getName()
     */
    public function testCanGetName()
    {
        $this->assertEquals('ModuleStub', (new ModuleStub())->getName());
    }

    /**
     * @covers \TwoDojo\Module\AbstractModule::getMajor()
     */
    public function testCanGetMajor()
    {
        $this->assertEquals(1, (new ModuleStub())->getMajor());
    }

    /**
     * @covers \TwoDojo\Module\AbstractModule::getMinor()
     */
    public function testCanGetMinor()
    {
        $this->assertEquals(2, (new ModuleStub())->getMinor());
    }

    /**
     * @covers \TwoDojo\Module\AbstractModule::getPatch()
     */
    public function testCanGetPatch()
    {
        $this->assertEquals(25, (new ModuleStub())->getPatch());
    }

    /**
     * @covers \TwoDojo\Module\AbstractModule::getDescription()
     */
    public function testCanGetDescription()
    {
        $this->assertEquals('Module Stub Description', (new ModuleStub())->getDescription());
    }

    /**
     * @covers \TwoDojo\Module\AbstractModule::getVersion()
     */
    public function testCanGetVersion()
    {
        $module = new ModuleStub();
        $major = $module->getMajor();
        $minor = $module->getMinor();
        $patch = $module->getPatch();
        $expectedVersion = "{$major}.{$minor}.{$patch}";

        $this->assertEquals($expectedVersion, $module->getVersion(false));
        $this->assertEquals('v'.$expectedVersion, $module->getVersion(true));
    }

    /**
     * @covers \TwoDojo\Module\AbstractModule::getAuthors()
     */
    public function testCanGetAuthors()
    {
        $module = new ModuleStub();

        $this->assertCount(1, $module->getAuthors());
        $this->assertEquals('Tester Guy', $module->getAuthors()[0]['name']);
    }

    /**
     * @covers \TwoDojo\Module\AbstractModule::getModulePath()
     */
    public function testCanGetModulePath()
    {
        $module = new ModuleStub();
        $expectedPath = 'module/stub/test/path';
        $module->setModulePath($expectedPath);

        $module2 = new ModuleStub();
        $defaultExpectedPath = dirname((new \ReflectionClass($module2))->getFileName());
        $defaultExpectedPath = realpath($defaultExpectedPath.'/../');

        $this->assertEquals($expectedPath, $module->getModulePath());
        $this->assertEquals($defaultExpectedPath, $module2->getModulePath());
    }

    /**
     * @covers \TwoDojo\Module\AbstractModule::getSnakeCaseName()
     */
    public function testCanGetSnakeCaseName()
    {
        $module = new ModuleStub();

        $this->assertEquals('module_stub', $module->getSnakeCaseName());
    }

    /**
     * @covers \TwoDojo\Module\AbstractModule::getUniqueName()
     */
    public function testCanGetUniqueName()
    {
        $module = new ModuleStub();

        $this->assertEquals('2dojo/module_stub', $module->getUniqueName());
    }

    /**
     * @covers \TwoDojo\Module\AbstractModule::isCoreModule()
     */
    public function testIsCoreModule()
    {
        $module = new ModuleStub();

        $this->assertFalse($module->isCoreModule());
    }

    /**
     * @covers \TwoDojo\Module\AbstractModule::getEventGroup()
     */
    public function testCanGetEventGroup()
    {
        $module = new ModuleStub();

        $this->assertEquals($module->getUniqueName(), $module->getEventGroup());
    }

    /**
     * @covers \TwoDojo\Module\AbstractModule::onEventReceived()
     */
    public function testOnEventReceived()
    {
        $module = new ModuleStub();

        $module->onEventReceived('testEvent');

        $this->assertTrue($module->testEventReceived);
    }
}
