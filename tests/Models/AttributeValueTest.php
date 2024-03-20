<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Admin\tests\Models;

use Modules\Attribute\Models\AttributeValue;
use Modules\Attribute\Models\AttributeValueType;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\TestDox('Modules\Admin\tests\Models\AttributeValueTest: Attribute model')]
final class AttributeValueTest extends \PHPUnit\Framework\TestCase
{
    public function testGetDefaultString() : void
    {
        $value = new AttributeValue();
        $value->setValue('abc', AttributeValueType::_STRING);

        self::assertEquals('abc', $value->getValue());
    }

    public function testGetDefaultInt() : void
    {
        $value = new AttributeValue();
        $value->setValue(1, AttributeValueType::_INT);

        self::assertEquals(1, $value->getValue());
    }

    public function testGetDefaultFloatInt() : void
    {
        $value = new AttributeValue();
        $value->setValue(1, AttributeValueType::_FLOAT_INT);

        self::assertEquals(1, $value->getValue());
    }

    public function testGetDefaultBool() : void
    {
        $value = new AttributeValue();
        $value->setValue(false, AttributeValueType::_BOOL);

        self::assertFalse($value->getValue());
    }

    public function testGetDefaultFloat() : void
    {
        $value = new AttributeValue();
        $value->setValue(1.23, AttributeValueType::_FLOAT);

        self::assertEquals(1.23, $value->getValue());
    }

    public function testGetDefaultDateTime() : void
    {
        $value = new AttributeValue();
        $value->setValue($val = new \DateTime('now'), AttributeValueType::_DATETIME);

        self::assertEquals($val, $value->getValue());
    }

    public function testToArray() : void
    {
        $value = new AttributeValue();
        self::assertEquals(
            [
                'id'                => 0,
                'valueInt' => null,
                'valueStr' => null,
                'valueDec' => null,
                'valueDat' => null,
                'isDefault' => false,
            ],
            $value->toArray()
        );
    }

    public function testJsonSerialize() : void
    {
        $value = new AttributeValue();
        self::assertEquals(
            [
                'id'                => 0,
                'valueInt' => null,
                'valueStr' => null,
                'valueDec' => null,
                'valueDat' => null,
                'isDefault' => false,
            ],
            $value->jsonSerialize()
        );
    }
}
