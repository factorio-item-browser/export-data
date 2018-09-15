<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

/**
 * The interface for entities providing an identifier.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
interface EntityWithIdentifierInterface extends EntityInterface
{
    /**
     * Returns the identifier of the entity.
     * @return string
     */
    public function getIdentifier(): string;
}
