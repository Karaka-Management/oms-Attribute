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

use phpOMS\Localization\ISO639Enum;
use phpOMS\Localization\NullLocalization;
use phpOMS\Uri\UriFactory;

$attribute = $this->attributes;
$languages = ISO639Enum::getConstants();
$types     = $this->attributeTypes;
$units     = $this->units;

/** @var \phpOMS\Localization\Localization $l11n */
$l11n = $this->data['defaultlocalization'] ?? new NullLocalization();
?>

<div class="col-xs-12 col-md-6">
    <section class="portlet">
        <form id="attributeForm" action="<?= UriFactory::build($this->apiUri); ?>" method="post"
            data-ui-container="#attributeTable tbody"
            data-add-form="attributeForm"
            data-add-tpl="#attributeTable tbody .oms-add-tpl-attribute">
            <div class="portlet-head"><?= $this->getHtml('Attribute', 'Attribute', 'Backend'); ?></div>
            <div class="portlet-body">
                <input type="hidden" id="iAttributeRef" name="ref" value="<?= $this->refId ?>" disabled>

                <div class="form-group">
                    <label for="iAttributeId"><?= $this->getHtml('ID', '0', '0'); ?></label>
                    <input type="text" id="iAttributeId" name="id" data-tpl-text="/id" data-tpl-value="/id" disabled>
                </div>

                <div class="form-group">
                    <label for="iAttributesType"><?= $this->getHtml('Type', 'Attribute', 'Backend'); ?></label>
                    <select id="iAttributesType" name="type" data-tpl-text="/type" data-tpl-value="/type">
                        <?php
                        foreach ($types as $type) : ?>
                            <option value="<?= $type->id; ?>"><?= $this->printHtml($type->getL11n()); ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- @todo implement
                <div class="form-group">
                    <label for="iAttributesUnit"><?= $this->getHtml('Unit', 'Attribute', 'Backend'); ?></label>
                    <select id="iAttributesUnit" name="unit" data-tpl-text="/unit" data-tpl-value="/unit">
                        <option value="">
                        <?php
                        foreach ($units as $unit) : ?>
                            <option value="<?= $unit->id; ?>"><?= $this->printHtml($unit->name); ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                -->

                <div class="form-group">
                    <label for="iAttributeValue"><?= $this->getHtml('Value', 'Attribute', 'Backend'); ?></label>
                    <pre class="textarea contenteditable" id="iAttributeValue" data-name="value" data-tpl-value="/value" contenteditable></pre>
                </div>
            </div>
            <div class="portlet-foot">
                <input id="bAttributeAdd" formmethod="put" type="submit" class="add-form" value="<?= $this->getHtml('Add', '0', '0'); ?>">
                <input id="bAttributeSave" formmethod="post" type="submit" class="save-form hidden button save" value="<?= $this->getHtml('Update', '0', '0'); ?>">
                <input id="bAttributeCancel" type="submit" class="cancel-form hidden button close" value="<?= $this->getHtml('Cancel', '0', '0'); ?>">
            </div>
        </form>
    </section>
</div>

<div class="col-xs-12 col-md-6">
    <section class="portlet">
        <div class="portlet-head"><?= $this->getHtml('Attributes', 'Attribute', 'Backend'); ?><i class="g-icon download btn end-xs">download</i></div>
        <div class="slider">
        <table id="attributeTable" class="default"
            data-tag="form"
            data-ui-element="tr"
            data-add-tpl=".oms-add-tpl-attribute"
            data-update-form="attributeForm">
            <thead>
                <tr>
                    <td>
                    <td><?= $this->getHtml('ID', '0', '0'); ?>
                    <td><?= $this->getHtml('Name', 'Attribute', 'Backend'); ?><i class="sort-asc g-icon">expand_less</i><i class="sort-desc g-icon">expand_more</i>
                    <td class="wf-100"><?= $this->getHtml('Value', 'Attribute', 'Backend'); ?><i class="sort-asc g-icon">expand_less</i><i class="sort-desc g-icon">expand_more</i>
                    <td><?= $this->getHtml('Unit', 'Attribute', 'Backend'); ?><i class="sort-asc g-icon">expand_less</i><i class="sort-desc g-icon">expand_more</i>
            <tbody>
                <template class="oms-add-tpl-attribute">
                    <tr class="animated medium-duration greenCircleFade" data-id="" draggable="false">
                        <td>
                            <i class="g-icon btn update-form">settings</i>
                            <input id="attributeTable-remove-0" type="checkbox" class="hidden">
                            <label for="attributeTable-remove-0" class="checked-visibility-alt"><i class="g-icon btn form-action">close</i></label>
                            <span class="checked-visibility">
                                <label for="attributeTable-remove-0" class="link default"><?= $this->getHtml('Cancel', '0', '0'); ?></label>
                                <label for="attributeTable-remove-0" class="remove-form link cancel"><?= $this->getHtml('Delete', '0', '0'); ?></label>
                            </span>
                        <td data-tpl-text="/id" data-tpl-value="/id"></td>
                        <td data-tpl-text="/type" data-tpl-value="/type" data-value=""></td>
                        <td data-tpl-text="/value" data-tpl-value="/value"></td>
                        <td data-tpl-text="/unit" data-tpl-value="/unit"></td>
                    </tr>
                </template>
                <?php $c = 0;
                foreach ($attribute as $key => $value) : ++$c; ?>
                    <tr data-id="<?= $value->id; ?>">
                        <td>
                            <i class="g-icon btn update-form">settings</i>
                            <?php if (!$value->type->isRequired) : ?>
                            <input id="attributeTable-remove-<?= $value->id; ?>" type="checkbox" class="hidden">
                            <label for="attributeTable-remove-<?= $value->id; ?>" class="checked-visibility-alt"><i class="g-icon btn form-action">close</i></label>
                            <span class="checked-visibility">
                                <label for="attributeTable-remove-<?= $value->id; ?>" class="link default"><?= $this->getHtml('Cancel', '0', '0'); ?></label>
                                <label for="attributeTable-remove-<?= $value->id; ?>" class="remove-form link cancel"><?= $this->getHtml('Delete', '0', '0'); ?></label>
                            </span>
                            <?php endif; ?>
                        <td data-tpl-text="/id" data-tpl-value="/id"><?= $value->id; ?>
                        <td data-tpl-text="/type" data-tpl-value="/type" data-value="<?= $value->type->id; ?>"><?= $this->printHtml($value->type->getL11n()); ?>
                        <td data-tpl-text="/value" data-tpl-value="/value"><?= $value->value->getValue() instanceof \DateTime ? $value->value->getValue()->format('Y-m-d') : $this->printHtml((string) $value->value->getValue()); ?>
                        <td data-tpl-text="/unit" data-tpl-value="/unit" data-value="<?= $value->value->unit; ?>"><?= $this->printHtml($value->value->unit); ?>
                <?php endforeach; ?>
                <?php if ($c === 0) : ?>
                <tr>
                    <td colspan="5" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                <?php endif; ?>
        </table>
        </div>
    </section>
</div>
