<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Setup\Model\Declaration\Schema\Dto\Columns;

use Magento\Setup\Model\Declaration\Schema\Dto\Column;
use Magento\Setup\Model\Declaration\Schema\Dto\ElementDiffAwareInterface;
use Magento\Setup\Model\Declaration\Schema\Dto\Table;

/**
 * Timestamp column
 * Declared in SQL, like Timestamp
 * Has 2 additional params: default and on_update
 */
class Timestamp extends Column implements
    ElementDiffAwareInterface,
    ColumnDefaultAwareInterface
{
    /**
     * @var string
     */
    private $default;

    /**
     * @var null|string
     */
    private $onUpdate;

    /**
     * @param string $name
     * @param string $type
     * @param Table $table
     * @param $default
     * @param string|null $onUpdate
     */
    public function __construct(
        string $name,
        string $type,
        Table $table,
        string $default,
        string $onUpdate = null
    ) {
        parent::__construct($name, $type, $table);
        $this->default = $default;
        $this->onUpdate = $onUpdate;
    }

    /**
     * Return default value
     * Note: default value should be float
     *
     * @return int | null
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Retrieve on_update param
     *
     * @return string
     */
    public function getOnUpdate()
    {
        return $this->onUpdate;
    }

    /**
     * @inheritdoc
     */
    public function getDiffSensitiveParams()
    {
        return [
            'type' => $this->getType(),
            'default' => $this->getDefault(),
            'onUpdate' => $this->getOnUpdate()
        ];
    }
}
