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

namespace Modules\Attribute\tests\Models;

use Modules\Attribute\Models\NullAttributeType;

/**
 * @internal
 */
final class NullAttributeTypeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers \Modules\Attribute\Models\NullAttributeType
     * @group module
     */
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\Attribute\Models\AttributeType', new NullAttributeType());
    }

    /**
     * @covers \Modules\Attribute\Models\NullAttributeType
     * @group module
     */
    public function testId() : void
    {
        $null = new NullAttributeType(2);
        self::assertEquals(2, $null->id);
    }

    /**
     * @covers \Modules\Attribute\Models\NullAttributeType
     * @group module
     */
    public function testJsonSerialize() : void
    {
        $null = new NullAttributeType(2);
        self::assertEquals(['id' => 2], $null->jsonSerialize());
    }
}
