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

use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * Attribute type mapper class.
 *
 * @package Modules\Attribute\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of AttributeType
 * @extends DataMapperFactory<T>
 */
final class AttributeTypeMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'attribute_attr_type_id'         => ['name' => 'attribute_attr_type_id',       'type' => 'int',    'internal' => 'id'],
        'attribute_attr_type_name'       => ['name' => 'attribute_attr_type_name',     'type' => 'string', 'internal' => 'name', 'autocomplete' => true],
        'attribute_attr_type_datatype'   => ['name' => 'attribute_attr_type_datatype',   'type' => 'int',    'internal' => 'datatype'],
        'attribute_attr_type_fields'     => ['name' => 'attribute_attr_type_fields',   'type' => 'int',    'internal' => 'fields'],
        'attribute_attr_type_custom'     => ['name' => 'attribute_attr_type_custom',   'type' => 'bool',   'internal' => 'custom'],
        'attribute_attr_type_pattern'    => ['name' => 'attribute_attr_type_pattern',  'type' => 'string', 'internal' => 'validationPattern'],
        'attribute_attr_type_required'   => ['name' => 'attribute_attr_type_required', 'type' => 'bool',   'internal' => 'isRequired'],
        'attribute_attr_type_repeatable' => ['name' => 'attribute_attr_type_repeatable', 'type' => 'bool',   'internal' => 'isRepeatable'],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:class-string, table:string, self?:?string, external?:?string, column?:string}>
     * @since 1.0.0
     */
    public const HAS_MANY = [
        'l11n' => [
            'mapper'   => AttributeTypeL11nMapper::class,
            'table'    => 'attribute_attr_type_l11n',
            'self'     => 'attribute_attr_type_l11n_type',
            'column'   => 'content',
            'external' => null,
        ],
        'defaults' => [
            'mapper'   => AttributeValueMapper::class,
            'table'    => 'attribute_attr_default',
            'self'     => 'attribute_attr_default_type',
            'external' => 'attribute_attr_default_value',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'attribute_attr_type';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'attribute_attr_type_id';
}
