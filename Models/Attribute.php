<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   Modules\Attribute\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Attribute\Models;

/**
 * Attribute class.
 *
 * @package Modules\Attribute\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
class Attribute implements \JsonSerializable
{
    /**
     * Id.
     *
     * @var int
     * @since 1.0.0
     */
    public int $id = 0;

    /**
     *  this attribute belongs to
     *
     * @var int
     * @since 1.0.0
     */
    public int $ref = 0;

    /**
     * Attribute type the attribute belongs to
     *
     * @var AttributeType
     * @since 1.0.0
     */
    public AttributeType $type;

    /**
     * Attribute value the attribute belongs to
     *
     * @var AttributeValue
     * @since 1.0.0
     */
    public AttributeValue $value;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->type  = new NullAttributeType();
        $this->value = new NullAttributeValue();
    }

    /**
     * Deep clone the attribute element
     *
     * @return self
     *
     * @since 1.0.0
     */
    public function deepClone() : self
    {
        $clone        = clone $this;
        $clone->value = clone $this->value;

        return $clone;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'    => $this->id,
            'ref'   => $this->ref,
            'type'  => $this->type,
            'value' => $this->value,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() : mixed
    {
        return $this->toArray();
    }
}
