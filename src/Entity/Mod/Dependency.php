<?php

namespace FactorioItemBrowser\ExportData\Entity\Mod;

use BluePsyduck\Common\Data\DataBuilder;
use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\EntityInterface;

/**
 * The class representing a mod dependency.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Dependency implements EntityInterface
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

    /**
     * Writes the entity data to an array.
     * @return array
     */
    public function writeData(): array
    {
        $dataBuilder = new DataBuilder();
        $dataBuilder->setString('m', $this->requiredModName, '')
                    ->setString('v', $this->requiredVersion, '')
                    ->setInteger('r', $this->isMandatory ? 1 : 0, 0);
        return $dataBuilder->getData();
    }

    /**
     * Reads the entity data.
     * @param DataContainer $data
     * @return $this
     */
    public function readData(DataContainer $data)
    {
        $this->requiredModName = $data->getString('m', '');
        $this->requiredVersion = $data->getString('v', '');
        $this->isMandatory = $data->getInteger('r', 0) === 1;
        return $this;
    }
}
