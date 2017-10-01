<?php

namespace TwoDojo\Module;

use TwoDojo\Module\Contracts\EventListener;

/**
 * Class AbstractModule
 *
 * @method onInitialize()
 * @method onEnabled()
 * @method onDisabled()
 */
abstract class AbstractModule implements EventListener
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $uniqueName;

    /**
     * @var string
     */
    private $snakeCaseName;

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var int
     */
    protected $major = 0;

    /**
     * @var int
     */
    protected $minor = 0;

    /**
     * @var int
     */
    protected $patch = 1;

    /**
     * @var array
     */
    protected $authors = [];

    /**
     * @var string
     */
    protected $modulePath;

    /**
     * @var bool
     */
    protected $isCore = false;

    /**
     * Determine the module is enabled or not
     *
     * @return bool
     */
    public function isEnabled() : bool
    {
        return true;
    }

    public function getSnakeCaseName() : string
    {
        if (empty($this->snakeCaseName)) {
            $this->snakeCaseName = mb_strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $this->name), 'UTF-8');
        }

        return $this->snakeCaseName;
    }

    /**
     * Get the module name
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Get the module description
     *
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Get the module major version
     *
     * @return int
     */
    public function getMajor() : int
    {
        return $this->major;
    }

    /**
     * Get the module minor version
     *
     * @return int
     */
    public function getMinor() : int
    {
        return $this->minor;
    }

    /**
     * Get the module patch version
     *
     * @return int
     */
    public function getPatch() : int
    {
        return $this->patch;
    }

    /**
     * Get the module version string
     *
     * @param boolean $includePrefix Include the version prefix or not.
     * @return string
     */
    public function getVersion($includePrefix = true) : string
    {
        $version = "{$this->getMajor()}.{$this->getMinor()}.{$this->getPatch()}";

        return $includePrefix ? 'v'.$version : $version;
    }

    /**
     * Get the module authors
     *
     * @return array
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Get the module prefix
     *
     * @return string
     */
    public function getUniqueName()
    {
        return $this->uniqueName;
    }

    /**
     * @return string
     */
    public function getModulePath()
    {
        if (empty($this->modulePath)) {
            $this->modulePath = dirname((new \ReflectionClass($this))->getFileName());
            $this->modulePath = realpath($this->modulePath.'/../');
        }

        return $this->modulePath;
    }

    public function isCoreModule()
    {
        return $this->isCore;
    }

    public function onEventReceived(string $event, array $arguments = [])
    {
        $signature = 'on'.ucfirst($event);
        if (method_exists($this, $signature)) {
            $this->{$signature}(...$arguments);
        }
    }

    public function getEventGroup()
    {
        return $this->getUniqueName();
    }
}
