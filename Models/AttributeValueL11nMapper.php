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
use phpOMS\Localization\BaseStringL11n;

/**
 * Attribute value l11n mapper class.
 *
 * @package Modules\Attribute\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of BaseStringL11n
 * @extends DataMapperFactory<T>
 */
final class AttributeValueL11nMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'attribute_attr_value_l11n_id'    => ['name' => 'attribute_attr_value_l11n_id',    'type' => 'int',    'internal' => 'id'],
        'attribute_attr_value_l11n_title' => ['name' => 'attribute_attr_value_l11n_title', 'type' => 'string', 'internal' => 'content', 'autocomplete' => true],
        'attribute_attr_value_l11n_value' => ['name' => 'attribute_attr_value_l11n_value',  'type' => 'int',    'internal' => 'ref'],
        'attribute_attr_value_l11n_lang'  => ['name' => 'attribute_attr_value_l11n_lang',  'type' => 'string', 'internal' => 'language'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'attribute_attr_value_l11n';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'attribute_attr_value_l11n_id';

    /**
     * Model to use by the mapper.
     *
     * @var class-string<T>
     * @since 1.0.0
     */
    public const MODEL = BaseStringL11n::class;
}
