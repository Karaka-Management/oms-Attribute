<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Attribute\Controller;

use phpOMS\Localization\BaseStringL11n;
use phpOMS\Localization\BaseStringL11nType;
use phpOMS\Localization\NullBaseStringL11nType;
use phpOMS\Message\RequestAbstract;

trait ApiLocalizationTraitController
{
    /**
     * Method to create l11n from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return BaseStringL11n
     *
     * @since 1.0.0
     */
    private function createL11nFromRequest(RequestAbstract $request) : BaseStringL11n
    {
        $l11n       = new BaseStringL11n();
        $l11n->ref  = $request->getDataInt('ref') ?? 0;
        $l11n->type = new NullBaseStringL11nType($request->getDataInt('type') ?? 0);
        $l11n->setLanguage(
            $request->getDataString('language') ?? $request->header->l11n->language
        );
        $l11n->content = $request->getDataString('content') ?? '';

        return $l11n;
    }

    /**
     * Validate l11n create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateL11nCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['ref'] = !$request->hasData('ref'))
            || ($val['type'] = !$request->hasData('type'))
            || ($val['content'] = !$request->hasData('content'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Method to update L11n from request.
     *
     * @param RequestAbstract  $request Request
     * @param BaseStringL11n     $new     Model to modify
     *
     * @return BaseStringL11n
     *
     * @todo: consider to move all these FromRequest functions to the attribute module since they are the same in every module!
     *
     * @since 1.0.0
     */
    public function updateL11nFromRequest(RequestAbstract $request, BaseStringL11n $new) : BaseStringL11n
    {
        $new->setLanguage(
            $request->getDataString('language') ?? $new->language
        );
        $new->content = $request->getDataString('content') ?? $new->content;

        return $new;
    }

    /**
     * Validate L11n update request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @todo: implement
     *
     * @since 1.0.0
     */
    private function validateL11nUpdate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))) {
            return $val;
        }

        return [];
    }

    /**
     * Method to create l11n type from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return BaseStringL11nType
     *
     * @since 1.0.0
     */
    private function createL11nTypeFromRequest(RequestAbstract $request) : BaseStringL11nType
    {
        $l11nType             = new BaseStringL11nType();
        $l11nType->title      = $request->getDataString('title') ?? '';
        $l11nType->isRequired = $request->getDataBool('is_required') ?? false;

        return $l11nType;
    }

    /**
     * Validate l11n type create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateL11nTypeCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = !$request->hasData('title'))) {
            return $val;
        }

        return [];
    }

    /**
     * Method to update l11n type from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return BaseStringL11nType
     *
     * @since 1.0.0
     */
    private function updateL11nTypeFromRequest(RequestAbstract $request, BaseStringL11nType $new) : BaseStringL11nType
    {
        $new->title      = $request->getDataString('title') ?? $new->title;
        $new->isRequired = $request->getDataBool('is_required') ?? $new->isRequired;

        return $new;
    }

    /**
     * Validate l11n type update request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateL11nTypeUpdate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))) {
            return $val;
        }

        return [];
    }
}
