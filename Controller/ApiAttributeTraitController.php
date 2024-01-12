<?php
/**
 * Jingga
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

namespace Modules\Attribute\Controller;

use Modules\Attribute\Models\Attribute;
use Modules\Attribute\Models\AttributeType;
use Modules\Attribute\Models\AttributeValue;
use Modules\Attribute\Models\NullAttributeValue;
use phpOMS\Localization\BaseStringL11n;
use phpOMS\Localization\ISO639x1Enum;
use phpOMS\Message\RequestAbstract;

/**
 * General attribute api functionality.
 *
 * @package Modules\Attribute
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
trait ApiAttributeTraitController
{
    /**
     * Method to create item attribute from request.
     *
     * @param RequestAbstract $request Request
     * @param AttributeType   $type    Attribute type
     *
     * @return Attribute
     *
     * @since 1.0.0
     */
    private function createAttributeFromRequest(RequestAbstract $request, AttributeType $type) : Attribute
    {
        $new       = new Attribute();
        $new->ref  = (int) $request->getData('ref');
        $new->type = $type;

        if ($new->type->custom) {
            if ($request->hasData('value_id')) {
                $new->value = new NullAttributeValue((int) $request->getData('value_id'));
            } else {
                $new->value = new AttributeValue();
                $new->value->setValue($request->getData('value'), $new->type->datatype);
            }
        } else {
            if ($request->hasData('value_id')) {
                if (!$new->type->hasDefaultId((int) $request->getData('value_id'))) {
                    return $new;
                }

                $value = new NullAttributeValue((int) $request->getData('value_id'));
            } else {
                $value = $new->type->getDefaultByValue($request->getData('value'));

                // Couldn't find matching default value
                if ($value->id === 0) {
                    return $new;
                }
            }

            $new->value = $value;
        }

        return $new;
    }

    /**
     * Validate attribute create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateAttributeCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['type'] = !$request->hasData('type'))
            || ($val['value'] = (!$request->hasData('value') && !$request->hasData('value_id')))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Method to create attribute l11n from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return BaseStringL11n
     *
     * @since 1.0.0
     */
    private function createAttributeTypeL11nFromRequest(RequestAbstract $request) : BaseStringL11n
    {
        $attrL11n      = new BaseStringL11n();
        $attrL11n->ref = $request->getDataInt('type') ?? 0;
        $attrL11n->setLanguage(
            $request->getDataString('language') ?? $request->header->l11n->language
        );
        $attrL11n->content = $request->getDataString('title') ?? '';

        return $attrL11n;
    }

    /**
     * Validate attribute l11n create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateAttributeTypeL11nCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = !$request->hasData('title'))
            || ($val['type'] = !$request->hasData('type'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Method to create attribute from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return AttributeType
     *
     * @since 1.0.0
     */
    private function createAttributeTypeFromRequest(RequestAbstract $request) : AttributeType
    {
        $attrType                    = new AttributeType($request->getDataString('name') ?? '');
        $attrType->datatype          = $request->getDataInt('datatype') ?? 0;
        $attrType->custom            = $request->getDataBool('custom') ?? false;
        $attrType->repeatable        = $request->getDataBool('repeatable') ?? false;
        $attrType->isRequired        = $request->getDataBool('is_required') ?? false;
        $attrType->validationPattern = $request->getDataString('validation_pattern') ?? '';
        $attrType->setL11n($request->getDataString('title') ?? '', $request->getDataString('language') ?? ISO639x1Enum::_EN);
        $attrType->setFields($request->getDataInt('fields') ?? 0);

        return $attrType;
    }

    /**
     * Validate attribute create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateAttributeTypeCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = !$request->hasData('title'))
            || ($val['name'] = !$request->hasData('name'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Method to create attribute value from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return AttributeValue
     *
     * @since 1.0.0
     */
    private function createAttributeValueFromRequest(RequestAbstract $request, AttributeType $type) : AttributeValue
    {
        $attrValue            = new AttributeValue();
        $attrValue->isDefault = $request->getDataBool('default') ?? false;
        $attrValue->unit      = $request->getDataString('unit') ?? '';
        $attrValue->setValue($request->getDataString('value'), $type->datatype);

        if ($request->hasData('title')) {
            $attrValue->setL11n($request->getDataString('title') ?? '', $request->getDataString('language') ?? ISO639x1Enum::_EN);
        }

        return $attrValue;
    }

    /**
     * Validate attribute value create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateAttributeValueCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['type'] = !$request->hasData('type'))
            || ($val['value'] = !$request->hasData('value'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Method to create attribute l11n from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return BaseStringL11n
     *
     * @since 1.0.0
     */
    private function createAttributeValueL11nFromRequest(RequestAbstract $request) : BaseStringL11n
    {
        $attrL11n      = new BaseStringL11n();
        $attrL11n->ref = $request->getDataInt('value') ?? 0;
        $attrL11n->setLanguage(
            $request->getDataString('language') ?? $request->header->l11n->language
        );
        $attrL11n->content = $request->getDataString('title') ?? '';

        return $attrL11n;
    }

    /**
     * Validate attribute l11n create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateAttributeValueL11nCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = !$request->hasData('title'))
            || ($val['value'] = !$request->hasData('value'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Method to update Attribute from request.
     *
     * @param RequestAbstract $request Request
     * @param Attribute       $new     Model to modify
     *
     * @return Attribute
     *
     * @since 1.0.0
     */
    public function updateAttributeFromRequest(RequestAbstract $request, Attribute $new) : Attribute
    {
        if ($new->type->custom) {
            if ($request->hasData('value_id')) {
                $new->value = new NullAttributeValue((int) $request->getData('value_id'));
            } else {
                $new->value = new AttributeValue();
                $new->value->setValue($request->getData('value'), $new->type->datatype);
            }
        } else {
            if ($request->hasData('value_id')) {
                if (!$new->type->hasDefaultId((int) $request->getData('value_id'))) {
                    return $new;
                }

                $value = new NullAttributeValue((int) $request->getData('value_id'));
            } else {
                $value = $new->type->getDefaultByValue($request->getData('value'));

                // Couldn't find matching default value
                if ($value->id === 0) {
                    return $new;
                }
            }

            $new->value = $value;
        }

        return $new;
    }

    /**
     * Validate Attribute update request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateAttributeUpdate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))
            || ($val['value'] = (!$request->hasData('value') && !$request->hasData('value_id')))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Validate Attribute delete request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateAttributeDelete(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))) {
            return $val;
        }

        return [];
    }

    /**
     * Method to update AttributeTypeL11n from request.
     *
     * @param RequestAbstract $request Request
     * @param BaseStringL11n  $new     Model to modify
     *
     * @return BaseStringL11n
     *
     * @todo consider to move all these FromRequest functions to the attribute module since they are the same in every module!
     *
     * @since 1.0.0
     */
    public function updateAttributeTypeL11nFromRequest(RequestAbstract $request, BaseStringL11n $new) : BaseStringL11n
    {
        $new->setLanguage(
            $request->getDataString('language') ?? $new->language
        );
        $new->content = $request->getDataString('title') ?? $new->content;

        return $new;
    }

    /**
     * Validate AttributeTypeL11n update request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateAttributeTypeL11nUpdate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))
            || ($val['title'] = !$request->hasData('title'))
            || ($val['language'] = $request->hasData('language') && !ISO639x1Enum::isValidValue($request->getDataString('language')))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Validate AttributeTypeL11n delete request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @todo Implement API validation function
     *
     * @since 1.0.0
     */
    private function validateAttributeTypeL11nDelete(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))) {
            return $val;
        }

        return [];
    }

    /**
     * Method to update AttributeType from request.
     *
     * @param RequestAbstract $request Request
     * @param AttributeType   $new     Model to modify
     *
     * @return AttributeType
     *
     * @todo Implement API update
     *
     * @since 1.0.0
     */
    public function updateAttributeTypeFromRequest(RequestAbstract $request, AttributeType $new) : AttributeType
    {
        $new->datatype          = $request->getDataInt('datatype') ?? $new->datatype;
        $new->custom            = $request->getDataBool('custom') ?? $new->custom;
        $new->isRequired        = $request->getDataBool('is_required') ?? $new->isRequired;
        $new->validationPattern = $request->getDataString('validation_pattern') ?? $new->validationPattern;

        return $new;
    }

    /**
     * Validate AttributeType update request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @todo Implement API validation function
     *
     * @since 1.0.0
     */
    private function validateAttributeTypeUpdate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))) {
            return $val;
        }

        return [];
    }

    /**
     * Validate AttributeType delete request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateAttributeTypeDelete(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))) {
            return $val;
        }

        return [];
    }

    /**
     * Method to update AttributeValue from request.
     *
     * @param RequestAbstract $request Request
     * @param AttributeValue  $new     Model to modify
     *
     * @return AttributeValue
     *
     * @todo Implement API update
     *
     * @since 1.0.0
     */
    public function updateAttributeValueFromRequest(RequestAbstract $request, AttributeValue $new, Attribute $attr) : AttributeValue
    {
        $new->isDefault = $request->getDataBool('default') ?? $new->isDefault;
        $new->setValue($request->getDataString('value'), $attr->type->datatype);

        return $new;
    }

    /**
     * Validate AttributeValue update request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @todo Implement API validation function
     *
     * @since 1.0.0
     */
    private function validateAttributeValueUpdate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))
            || ($val['attribute'] = !$request->hasData('attribute'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Validate AttributeValue delete request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @todo Implement API validation function
     *
     * @since 1.0.0
     */
    private function validateAttributeValueDelete(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))) {
            return $val;
        }

        return [];
    }

    /**
     * Method to update AttributeValueL11n from request.
     *
     * @param RequestAbstract $request Request
     * @param BaseStringL11n  $new     Model to modify
     *
     * @return BaseStringL11n
     *
     * @todo Implement API update
     *
     * @since 1.0.0
     */
    public function updateAttributeValueL11nFromRequest(RequestAbstract $request, BaseStringL11n $new) : BaseStringL11n
    {
        $new->setLanguage(
            $request->getDataString('language') ?? $new->language
        );
        $new->content = $request->getDataString('title') ?? $new->content;

        return $new;
    }

    /**
     * Validate AttributeValueL11n update request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateAttributeValueL11nUpdate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))
            || ($val['title'] = !$request->hasData('title'))
            || ($val['language'] = $request->hasData('language') && !ISO639x1Enum::isValidValue($request->getDataString('language')))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Validate AttributeValueL11n delete request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @todo Implement API validation function
     *
     * @since 1.0.0
     */
    private function validateAttributeValueL11nDelete(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))) {
            return $val;
        }

        return [];
    }
}
