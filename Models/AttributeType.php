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

use phpOMS\Localization\BaseStringL11n;
use phpOMS\Localization\ISO639x1Enum;

/**
 *  Attribute Type class.
 *
 * @package Modules\Attribute\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
class AttributeType implements \JsonSerializable
{
    /**
     * Id
     *
     * @var int
     * @since 1.0.0
     */
    public int $id = 0;

    /**
     * Name/string identifier by which it can be found/categorized
     *
     * @var string
     * @since 1.0.0
     */
    public string $name = '';

    /**
     * Which field data type is required (string, int, ...) in the value
     *
     * @var int
     * @since 1.0.0
     */
    public int $fields = 0;

    /**
     * Is a custom value allowed (e.g. custom string)
     *
     * @var bool
     * @since 1.0.0
     */
    public bool $custom = false;

    public string $validationPattern = '';

    public bool $isRequired = false;

    public bool $repeatable = false;

    public bool $isInternal = false;

    /**
     * Datatype of the attribute
     *
     * @var int
     * @since 1.0.0
     */
    public int $datatype = AttributeValueType::_STRING;

    /**
     * Localization
     *
     * @var BaseStringL11n
     */
    public string | BaseStringL11n $l11n = '';

    /**
     * Possible default attribute values
     *
     * @var array
     */
    public array $defaults = [];

    // @todo Allow to reference enum instead of default values
    //      Currently we create language and country values which is insane

    /**
     * Default attribute value
     *
     * @var int
     * @since 1.0.0
     */
    public int $default = 0;

    /**
     * Constructor.
     *
     * @param string $name Name/identifier of the attribute type
     *
     * @since 1.0.0
     */
    public function __construct(string $name = '')
    {
        $this->name = $name;
    }

    /**
     * Get the default attribute value by its value
     *
     * @param mixed $value Value to search for
     *
     * @return AttributeValue
     *
     * @since 1.0.0
     */
    public function getDefaultByValue(mixed $value) : AttributeValue
    {
        $mValue = null;
        if ($this->datatype === AttributeValueType::_STRING) {
            $mValue = (string) $value;
        } elseif ($this->datatype === AttributeValueType::_INT
            || $this->datatype === AttributeValueType::_FLOAT_INT
            || $this->datatype === AttributeValueType::_BOOL
        ) {
            $mValue = (int) $value;
        } elseif ($this->datatype === AttributeValueType::_FLOAT) {
            $mValue = (float) $value;
        } elseif ($this->datatype === AttributeValueType::_DATETIME) {
            $mValue = $value instanceof \DateTime
                ? $value
                : new \DateTime((string) $value);
        }

        foreach ($this->defaults as $default) {
            if ($default->getValue() === $mValue) {
                return $default;
            }
        }

        return new NullAttributeValue();
    }

    /**
     * Set l11n
     *
     * @param string|BaseStringL11n $l11n Tag article l11n
     * @param string                $lang Language
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setL11n(string | BaseStringL11n $l11n, string $lang = ISO639x1Enum::_EN) : void
    {
        if ($l11n instanceof BaseStringL11n) {
            $this->l11n = $l11n;
        } elseif (isset($this->l11n) && $this->l11n instanceof BaseStringL11n) {
            $this->l11n->content  = $l11n;
            $this->l11n->language = $lang;
        } else {
            $this->l11n           = new BaseStringL11n();
            $this->l11n->content  = $l11n;
            $this->l11n->language = $lang;
        }
    }

    /**
     * @return string
     *
     * @since 1.0.0
     */
    public function getL11n() : string
    {
        if (!isset($this->l11n)) {
            return '';
        }

        return $this->l11n instanceof BaseStringL11n ? $this->l11n->content : $this->l11n;
    }

    /**
     * Set fields
     *
     * @param int $fields Fields
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setFields(int $fields) : void
    {
        $this->fields = $fields;
    }

    /**
     * Check if an attribute type has a certain default id
     *
     * @param int $id Default object id
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function hasDefaultId(int $id) : bool
    {
        foreach ($this->defaults as $default) {
            if ($default->id === $id) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'validationPattern' => $this->validationPattern,
            'custom'            => $this->custom,
            'isRequired'        => $this->isRequired,
            'isInternal'        => $this->isInternal,
            'repeatable'        => $this->repeatable,
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
