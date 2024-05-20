<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Admin\tests\Models;

use Modules\Attribute\Models\AttributeType;
use Modules\Attribute\Models\AttributeValue;
use Modules\Attribute\Models\AttributeValueType;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\TestDox('Modules\Admin\tests\Models\AttributeTypeTest: Attribute model')]
final class AttributeTypeTest extends \PHPUnit\Framework\TestCase
{
    public function testGetDefaultString() : void
    {
        $type             = new AttributeType();
        $type->defaults[] = new AttributeValue();
        $type->defaults[0]->setValue('abc', AttributeValueType::_STRING);

        self::assertEquals('abc', $type->getDefaultByValue('abc')->getValue());
    }

    public function testGetDefaultInt() : void
    {
        $type           = new AttributeType();
        $type->datatype = AttributeValueType::_INT;

        $type->defaults[] = new AttributeValue();
        $type->defaults[0]->setValue(1, AttributeValueType::_INT);

        self::assertEquals(1, $type->getDefaultByValue(1)->getValue());
    }

    public function testGetDefaultFloatInt() : void
    {
        $type           = new AttributeType();
        $type->datatype = AttributeValueType::_FLOAT_INT;

        $type->defaults[] = new AttributeValue();
        $type->defaults[0]->setValue(1, AttributeValueType::_FLOAT_INT);

        self::assertEquals(1, $type->getDefaultByValue(1)->getValue());
    }

    public function testGetDefaultBool() : void
    {
        $type           = new AttributeType();
        $type->datatype = AttributeValueType::_BOOL;

        $type->defaults[] = new AttributeValue();
        $type->defaults[0]->setValue(false, AttributeValueType::_BOOL);

        self::assertFalse((bool) $type->getDefaultByValue(false)->getValue());
    }

    public function testGetDefaultFloat() : void
    {
        $type           = new AttributeType();
        $type->datatype = AttributeValueType::_FLOAT;

        $type->defaults[] = new AttributeValue();
        $type->defaults[0]->setValue(1.23, AttributeValueType::_FLOAT);

        self::assertEquals(1.23, $type->getDefaultByValue(1.23)->getValue());
    }

    public function testGetDefaultDateTime() : void
    {
        $type           = new AttributeType();
        $type->datatype = AttributeValueType::_DATETIME;

        $type->defaults[] = new AttributeValue();
        $type->defaults[0]->setValue($val = new \DateTime('now'), AttributeValueType::_DATETIME);

        self::assertEquals($val, $type->getDefaultByValue($val->format('Y-m-d H:i:s'))->getValue());
    }

    public function testDefaultId() : void
    {
        $type             = new AttributeType();
        $type->defaults[] = new AttributeValue();

        self::assertTrue($type->hasDefaultId(0));
        self::assertFalse($type->hasDefaultId(9));
    }

    public function testToArray() : void
    {
        $type = new AttributeType();

        self::assertEquals(
            [
                'id'                => 0,
                'name'              => '',
                'validationPattern' => '',
                'custom'            => false,
                'isRequired'        => false,
                'isInternal'        => false,
                'isRepeatable'        => false,
            ],
            $type->toArray()
        );
    }

    public function testJsonSerialize() : void
    {
        $type = new AttributeType();

        self::assertEquals(
            [
                'id'                => 0,
                'name'              => '',
                'validationPattern' => '',
                'custom'            => false,
                'isRequired'        => false,
                'isInternal'        => false,
                'isRepeatable'        => false,
            ],
            $type->jsonSerialize()
        );
    }
}
