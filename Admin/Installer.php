<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   Modules\Attribute\Admin
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Attribute\Admin;

use phpOMS\Module\InstallerAbstract;

/**
 * Installer class.
 *
 * @package Modules\Attribute\Admin
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
final class Installer extends InstallerAbstract
{
    /**
     * Path of the file
     *
     * @var string
     * @since 1.0.0
     */
    public const PATH = __DIR__;
}