<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Admin\tests\Models;

use Modules\Attribute\Models\Attribute;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\TestDox('Modules\Admin\tests\Models\AttributeTest: Attribute model')]
final class AttributeTest extends \PHPUnit\Framework\TestCase
{
    public function testDeepClone() : void
    {
        $attr = new Attribute();

        $clone = $attr->deepClone();

        $attr->ref = 1;

        self::assertNotEquals($attr->ref, $clone->ref);
    }

    public function testToArray() : void
    {
        $attr = new Attribute();

        $array = $attr->toArray();

        unset($array['type']);
        unset($array['value']);

        self::assertEquals(
            [
                'id'  => 0,
                'ref' => 0,
            ],
            $array
        );
    }

    public function testJsonSerialize() : void
    {
        $attr = new Attribute();

        $array = $attr->jsonSerialize();

        unset($array['type']);
        unset($array['value']);

        self::assertEquals(
            [
                'id'  => 0,
                'ref' => 0,
            ],
            $array
        );
    }
}
