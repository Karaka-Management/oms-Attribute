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
 */
final class AttributeMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'attribute_attr_id'    => ['name' => 'attribute_attr_id',    'type' => 'int', 'internal' => 'id'],
        'attribute_attr_ref'  => ['name' => 'attribute_attr_ref',  'type' => 'int', 'internal' => 'ref'],
        'attribute_attr_type'  => ['name' => 'attribute_attr_type',  'type' => 'int', 'internal' => 'type'],
        'attribute_attr_value' => ['name' => 'attribute_attr_value', 'type' => 'int', 'internal' => 'value'],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array{mapper:class-string, external:string, by?:string, column?:string, conditional?:bool}>
     * @since 1.0.0
     */
    public const OWNS_ONE = [
        'type' => [
            'mapper'   => AttributeTypeMapper::class,
            'external' => 'attribute_attr_type',
        ],
        'value' => [
            'mapper'   => AttributeValueMapper::class,
            'external' => 'attribute_attr_value',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'attribute_attr';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'attribute_attr_id';
}
