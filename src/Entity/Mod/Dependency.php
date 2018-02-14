<?php

namespace FactorioItemBrowser\ExportData\Entity\Mod;

/**
 * The class representing a mod dependency.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Dependency
{
    /**
     * The name of the required mod.
     * @var string
     */
    protected $requiredModName = '';

    /**
     * The version of the required mod.
     * @var string
     */
    protected $requiredVersion = '';

    /**
     * Whether the required mod is mandatory.
     * @var bool
     */
    protected $isMandatory = false;

    /**
     * Sets the name of the required mod.
     * @param string $requiredModName
     * @return $this Implementing fluent interface.
     */
    public function setRequiredModName(string $requiredModName)
    {
        $this->requiredModName = $requiredModName;
        return $this;
    }

    /**
     * Returns the name of the required mod.
     * @return string
     */
    public function getRequiredModName(): string
    {
        return $this->requiredModName;
    }

    /**
     * Sets the version of the required mod.
     * @param string $requiredVersion
     * @return $this Implementing fluent interface.
     */
    public function setRequiredVersion(string $requiredVersion)
    {
        $this->requiredVersion = $requiredVersion;
        return $this;
    }

    /**
     * Returns the version of the required mod.
     * @return string
     */
    public function getRequiredVersion(): string
    {
        return $this->requiredVersion;
    }

    /**
     * Sets whether the required mod is mandatory.
     * @param bool $isMandatory
     * @return $this Implementing fluent interface.
     */
    public function setIsMandatory(bool $isMandatory)
    {
        $this->isMandatory = $isMandatory;
        return $this;
    }

    /**
     * Return whether the required mod is mandatory.
     * @return bool
     */
    public function getIsMandatory(): bool
    {
        return $this->isMandatory;
    }
}