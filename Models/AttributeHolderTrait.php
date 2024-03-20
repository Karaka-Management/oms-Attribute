<?php
/**
 * Jingga
 *
 * PHP Version 8.2
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
trait AttributeHolderTrait
{
    /**
     * Attributes.
     *
     * @var \Modules\Attribute\Models\Attribute[]
     * @since 1.0.0
     */
    public array $attributes = [];

    /**
     * Add attribute
     *
     * @param Attribute $attribute Attribute
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addAttribute(Attribute $attribute) : void
    {
        $this->attributes[] = $attribute;
    }

    /**
     * Get attributes
     *
     * @return Attribute[]
     *
     * @since 1.0.0
     */
    public function getAttributes() : array
    {
        return $this->attributes;
    }

    /**
     * Has attribute value
     *
     * @param string $attrName  Attribute name
     * @param mixed  $attrValue Attribute value
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function hasAttributeValue(string $attrName, mixed $attrValue) : bool
    {
        foreach ($this->attributes as $attribute) {
            if ($attribute->type->name === $attrName && $attribute->value->getValue() === $attrValue) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if a certain attribute type exists by name
     *
     * @param string $attrName Attribute name to check
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function hasAttributeType(string $attrName) : bool
    {
        foreach ($this->attributes as $attribute) {
            if ($attribute->type->name === $attrName && !empty($attribute->value->getValue())) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get attribute
     *
     * @param string $attrName Attribute name
     *
     * @return Attribute
     *
     * @since 1.0.0
     */
    public function getAttribute(string $attrName) : Attribute
    {
        foreach ($this->attributes as $attribute) {
            if ($attribute->type->name === $attrName) {
                return $attribute;
            }
        }

        return new NullAttribute();
    }
}
