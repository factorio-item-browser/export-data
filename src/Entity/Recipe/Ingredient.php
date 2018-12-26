<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity\Recipe;

use BluePsyduck\Common\Data\DataBuilder;
use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\EntityInterface;
use FactorioItemBrowser\ExportData\Utils\EntityUtils;

/**
 * The class representing an ingredient of a recipe.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Ingredient implements EntityInterface
{
    /**
     * The type of the ingredient.
     * @var string
     */
    protected $type = '';

    /**
     * The name of the ingredient.
     * @var string
     */
    protected $name = '';

    /**
     * The amount of the ingredient required for the recipe.
     * @var float
     */
    protected $amount = 1.;

    /**
     * The order of the ingredient in the recipe.
     * @var int
     */
    protected $order = 0;

    /**
     * Sets the type of the ingredient.
     * @param string $type
     * @return $this Implementing fluent interface.
     */
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Returns the type of the ingredient.
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets the name of the ingredient.
     * @param string $name
     * @return $this Implementing fluent interface.
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns the name of the ingredient.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the amount of the ingredient required for the recipe.
     * @param float $amount
     * @return $this Implementing fluent interface.
     */
    public function setAmount(float $amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Returns the amount of the ingredient required for the recipe.
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Sets the order of the ingredient in the recipe.
     * @param int $order
     * @return $this Implementing fluent interface.
     */
    public function setOrder(int $order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Returns the order of the ingredient in the recipe.
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * Writes the entity data to an array.
     * @return array
     */
    public function writeData(): array
    {
        $dataBuilder = new DataBuilder();
        $dataBuilder->setString('t', $this->type, '')
                    ->setString('n', $this->name, '')
                    ->setFloat('a', $this->amount, 1.)
                    ->setInteger('o', $this->order, 0);
        return $dataBuilder->getData();
    }

    /**
     * Reads the entity data.
     * @param DataContainer $data
     * @return $this
     */
    public function readData(DataContainer $data)
    {
        $this->type = $data->getString('t', '');
        $this->name = $data->getString('n', '');
        $this->amount = $data->getFloat('a', 1.);
        $this->order = $data->getInteger('o', 0);
        return $this;
    }

    /**
     * Calculates a hash value representing the entity.
     * @return string
     */
    public function calculateHash(): string
    {
        return EntityUtils::calculateHashOfArray([
            $this->type,
            $this->name,
            $this->amount,
            $this->order,
        ]);
    }
}
