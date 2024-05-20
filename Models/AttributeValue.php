<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Attribute\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Attribute\Models;

use phpOMS\Localization\BaseStringL11n;
use phpOMS\Localization\ISO639x1Enum;

/**
 *  attribute value class.
 *
 * The relation with the type is defined in the Attribute class.
 *
 * @package Modules\Attribute\Models
 * @license OMS License 2.2
 * @link    https://jingga.app
 * @since   1.0.0
 */
class AttributeValue implements \JsonSerializable
{
    /**
     * Id
     *
     * @var int
     * @since 1.0.0
     */
    public int $id = 0;

    /**
     * Depending attribute type
     *
     * @var null|int
     * @since 1.0.0
     */
    public ?int $dependingAttributeType = null;

    /**
     * Depending attribute value
     *
     * @var null|int
     * @since 1.0.0
     */
    public ?int $dependingAttributeValue = null;

    /**
     * Int value
     *
     * @var null|int
     * @since 1.0.0
     */
    public ?int $valueInt = null;

    /**
     * String value
     *
     * @var null|string
     * @since 1.0.0
     */
    public ?string $valueStr = null;

    /**
     * Decimal value
     *
     * @var null|float
     * @since 1.0.0
     */
    public ?float $valueDec = null;

    /**
     * DateTime value
     *
     * @var null|\DateTimeInterface
     * @since 1.0.0
     */
    public ?\DateTimeInterface $valueDat = null;

    /**
     * Is a default value which can be selected
     *
     * @var bool
     * @since 1.0.0
     */
    public bool $isDefault = false;

    /**
     * Unit of the value
     *
     * @var string
     * @since 1.0.0
     */
    public string $unit = '';

    /**
     * Localization
     *
     * @var string|BaseStringL11n
     */
    public string | BaseStringL11n $l11n = '';

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
            $this->l11n->ref      = $this->id;
            $this->l11n->language = $lang;
        }
    }

    /**
     * Get localization
     *
     * @return null|string
     *
     * @since 1.0.0
     */
    public function getL11n() : ?string
    {
        return $this->l11n instanceof BaseStringL11n ? $this->l11n->content : $this->l11n;
    }

    /**
     * Set value
     *
     * @param mixed $value    Value
     * @param int   $datatype Datatype
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setValue(mixed $value, int $datatype) : void
    {
        if ($datatype === AttributeValueType::_STRING) {
            $this->valueStr = (string) $value;
        } elseif ($datatype === AttributeValueType::_INT
            || $datatype === AttributeValueType::_FLOAT_INT
            || $datatype === AttributeValueType::_BOOL
        ) {
            $this->valueInt = (int) $value;
        } elseif ($datatype === AttributeValueType::_FLOAT) {
            $this->valueDec = (float) $value;
        } elseif ($datatype === AttributeValueType::_DATETIME) {
            $this->valueDat = $value instanceof \DateTime
                ? $value
                : new \DateTime((string) $value);
        }
    }

    /**
     * Get value
     *
     * @return null|int|string|float|\DateTimeInterface
     *
     * @since 1.0.0
     */
    public function getValue() : mixed
    {
        if ($this->valueStr !== null) {
            return $this->valueStr;
        } elseif ($this->valueInt !== null) {
            return $this->valueInt;
        } elseif ($this->valueDec !== null) {
            return $this->valueDec;
        } elseif ($this->valueDat !== null) {
            return $this->valueDat;
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'        => $this->id,
            'valueInt'  => $this->valueInt,
            'valueStr'  => $this->valueStr,
            'valueDec'  => $this->valueDec,
            'valueDat'  => $this->valueDat,
            'isDefault' => $this->isDefault,
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
