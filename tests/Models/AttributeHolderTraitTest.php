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

use Modules\Attribute\Models\Attribute;
use Modules\Attribute\Models\AttributeHolderTrait;
use Modules\Attribute\Models\AttributeType;
use Modules\Attribute\Models\AttributeValue;
use Modules\Attribute\Models\AttributeValueType;
use Modules\Attribute\Models\NullAttribute;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\TestDox('Modules\Admin\tests\Models\AttributeTest: Attribute model')]
final class AttributeHolderTraitTest extends \PHPUnit\Framework\TestCase
{
    private $holder = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        $this->holder = new class() {
            use AttributeHolderTrait;
        };

        $this->holder->attributes[] = new Attribute();

        $this->holder->attributes[0]->type = new AttributeType('testType');

        $this->holder->attributes[0]->value = new AttributeValue();
        $this->holder->attributes[0]->value->setValue('testValue', AttributeValueType::_STRING);
    }

    public function testHasAttributeValue() : void
    {
        self::assertTrue($this->holder->hasAttributeValue('testType', 'testValue'));
        self::assertFalse($this->holder->hasAttributeValue('invalidTestType', 'testValue'));
    }

    public function testHasAttributeType() : void
    {
        self::assertTrue($this->holder->hasAttributeType('testType'));
        self::assertFalse($this->holder->hasAttributeType('invalidTestType'));
    }

    public function testGetAttribute() : void
    {
        self::assertInstanceOf(Attribute::class, $this->holder->getAttribute('testType'));
        self::assertInstanceOf(NullAttribute::class, $this->holder->getAttribute('invalidTestType'));
    }
}
