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

use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 *  mapper class.
 *
 * @package Modules\Attribute\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of AttributeValue
 * @extends DataMapperFactory<T>
 */
final class AttributeValueMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'attribute_attr_value_id'            => ['name' => 'attribute_attr_value_id',       'type' => 'int',      'internal' => 'id'],
        'attribute_attr_value_default'       => ['name' => 'attribute_attr_value_default',  'type' => 'bool',     'internal' => 'isDefault'],
        'attribute_attr_value_valueStr'      => ['name' => 'attribute_attr_value_valueStr', 'type' => 'string',   'internal' => 'valueStr'],
        'attribute_attr_value_valueInt'      => ['name' => 'attribute_attr_value_valueInt', 'type' => 'int',      'internal' => 'valueInt'],
        'attribute_attr_value_valueDec'      => ['name' => 'attribute_attr_value_valueDec', 'type' => 'float',    'internal' => 'valueDec'],
        'attribute_attr_value_valueDat'      => ['name' => 'attribute_attr_value_valueDat', 'type' => 'DateTime', 'internal' => 'valueDat'],
        'attribute_attr_value_unit'          => ['name' => 'attribute_attr_value_unit', 'type' => 'string', 'internal' => 'unit'],
        'attribute_attr_value_deptype'          => ['name' => 'attribute_attr_value_deptype', 'type' => 'int', 'internal' => 'dependingAttributeType'],
        'attribute_attr_value_depvalue'          => ['name' => 'attribute_attr_value_depvalue', 'type' => 'int', 'internal' => 'dependingAttributeValue'],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:class-string, table:string, self?:?string, external?:?string, column?:string}>
     * @since 1.0.0
     */
    public const HAS_MANY = [
        'l11n' => [
            'mapper'   => AttributeValueL11nMapper::class,
            'table'    => 'attribute_attr_value_l11n',
            'self'     => 'attribute_attr_value_l11n_value',
            'external' => null,
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'attribute_attr_value';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'attribute_attr_value_id';
}
