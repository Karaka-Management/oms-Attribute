<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Attribute
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Attribute\Theme\Backend\Components;

use Modules\Attribute\Models\AttributeType;
use phpOMS\Localization\L11nManager;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;
use Web\Backend\Views\L11nView;

/**
 * Component view.
 *
 * @package Modules\Attribute
 * @license OMS License 2.2
 * @link    https://jingga.app
 * @since   1.0.0
 * @codeCoverageIgnore
 */
class AttributeTypeView extends View
{
    /**
     * Attributes
     *
     * @var \Modules\Attribute\Models\AttributeType
     * @since 1.0.0
     */
    public AttributeType $attribute;

    /**
     * API Uri for attribute actions
     *
     * @var string
     * @since 1.0.0
     */
    public string $path = '';

    public L11nView $l11nView;

    public array $l11ns = [];

    /**
     * {@inheritdoc}
     */
    public function __construct(L11nManager $l11n, RequestAbstract $request, ResponseAbstract $response)
    {
        parent::__construct($l11n, $request, $response);
        $this->setTemplate('/Modules/Attribute/Theme/Backend/Components/type-view');

        $this->l11nView = new L11nView($l11n, $request, $response);
    }
}
