<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   Modules\Attribute
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Attribute\Theme\Backend\Components;

use phpOMS\Localization\L11nManager;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Component view.
 *
 * @package Modules\Attribute
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 * @codeCoverageIgnore
 */
class AttributeView extends View
{
    /**
     * Attributes
     *
     * @var \Modules\Attribute\Models\Attribute[]
     * @since 1.0.0
     */
    public array $attributes = [];

    public array $attributeTypes = [];

    public array $units = [];

    public string $apiUri = '';

    /**
     * {@inheritdoc}
     */
    public function __construct(L11nManager $l11n = null, RequestAbstract $request, ResponseAbstract $response)
    {
        parent::__construct($l11n, $request, $response);
        $this->setTemplate('/Modules/Attribute/Theme/Backend/Components/attributes');
    }

    /**
     * {@inheritdoc}
     */
    public function render(mixed ...$data) : string
    {
        /** @var array{0:\Modules\Attribute\Models\Attribute[]} $data */
        $this->attributes = $data[0];
        $this->attributeTypes = $data[1];
        $this->units = $data[2];
        $this->apiUri = $data[3];

        return parent::render();
    }
}