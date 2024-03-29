<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Tasks
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

use Modules\Attribute\Models\AttributeValueType;
use phpOMS\Uri\UriFactory;

$types = AttributeValueType::getConstants();

$isNew = $this->attribute->id === 0;
$path = $this->path;

echo $this->data['nav']->render(); ?>

<div class="tabview tab-2">
    <div class="box">
        <ul class="tab-links">
            <li><label for="c-tab-1"><?= $this->getHtml('Type', 'Attribute', 'Backend'); ?></label>
            <li><label for="c-tab-2"><?= $this->getHtml('Defaults', 'Attribute', 'Backend'); ?></label>
        </ul>
    </div>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-2"<?= $this->request->uri->fragment === 'c-tab-1' ? ' checked' : ''; ?>>
        <div class="tab">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <section id="task" class="portlet">
                        <form id="attributeForm" method="<?= $isNew ? 'PUT' : 'POST'; ?>" action="<?= UriFactory::build('{/api}' . $path . '/attribute/type?csrf={$CSRF}'); ?>">
                        <div class="portlet-head"><?= $this->getHtml('Attribute', 'Attribute', 'Backend'); ?></div>
                        <div class="portlet-body">
                            <div class="form-group">
                                <label for="iId"><?= $this->getHtml('ID', '0', '0'); ?></label>
                                <input type="text" value="<?= $this->attribute->id; ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label for="iName"><?= $this->getHtml('Name', 'Attribute', 'Backend'); ?></label>
                                <input id="iNAme" type="text" value="<?= $this->printHtml($this->attribute->name); ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label for="iType"><?= $this->getHtml('Datatype', 'Attribute', 'Backend'); ?></label>
                                <select id="iType" name="type" disabled>
                                    <?php foreach ($types as $key => $type) : ?>
                                        <option value="<?= $type; ?>"<?= $type === $this->attribute->datatype ? ' selected' : ''; ?>><?= $this->getHtml($key, 'Attribute', 'Backend'); ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="iPattern"><?= $this->getHtml('Pattern', 'Attribute', 'Backend'); ?></label>
                                <input id="iPattern" type="text" value="<?= $this->printHtml($this->attribute->validationPattern); ?>">
                            </div>

                            <div class="form-group">
                                <label class="checkbox" for="iRequired">
                                    <input id="iRequired" type="checkbox" name="required" value="1"<?= $this->attribute->isRequired ? ' checked' : ''; ?>>
                                    <span class="checkmark"></span>
                                    <?= $this->getHtml('IsRequired', 'Attribute', 'Backend'); ?>
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="checkbox" for="iCustom">
                                    <input id="iCustom" type="checkbox" name="custom" value="1" <?= $this->attribute->custom ? ' checked' : ''; ?>>
                                    <span class="checkmark"></span>
                                    <?= $this->getHtml('CustomValue', 'Attribute', 'Backend'); ?>
                                </label>
                            </div>
                        </div>
                        <div class="portlet-foot">
                            <?php if ($isNew) : ?>
                                <input id="iCreateSubmit" type="Submit" value="<?= $this->getHtml('Create', '0', '0'); ?>">
                            <?php else : ?>
                                <input id="iSaveSubmit" type="Submit" value="<?= $this->getHtml('Save', '0', '0'); ?>">
                            <?php endif; ?>
                        </div>
                        </form>
                    </section>
                </div>
            </div>

            <div class="row">
                <?= $this->l11nView->render(
                    $this->l11ns,
                    [],
                    '{/api}' . $path . '/attribute/type/l11n?csrf={$CSRF}'
                );
                ?>
            </div>
        </div>

        <input type="radio" id="c-tab-2" name="tabular-2"<?= $this->request->uri->fragment === 'c-tab-2' ? ' checked' : ''; ?>>
        <div class="tab">
            <div class="row">
                <div class="col-xs-12">
                    <section class="portlet">
                        <div class="portlet-head"><?= $this->getHtml('Defaults'); ?><i class="g-icon download btn end-xs">download</i></div>
                        <div class="slider">
                        <table id="iAttributeValueList" class="default sticky">
                            <thead>
                            <tr>
                                <td><?= $this->getHtml('ID', '0', '0'); ?>
                                    <label for="iAttributeValueList-sort-1">
                                        <input type="radio" name="iAttributeValueList-sort" id="iAttributeValueList-sort-1">
                                        <i class="sort-asc g-icon">expand_less</i>
                                    </label>
                                    <label for="iAttributeValueList-sort-2">
                                        <input type="radio" name="iAttributeValueList-sort" id="iAttributeValueList-sort-2">
                                        <i class="sort-desc g-icon">expand_more</i>
                                    </label>
                                    <label>
                                        <i class="filter g-icon">filter_alt</i>
                                    </label>
                                <td><?= $this->getHtml('Name'); ?>
                                    <label for="iAttributeValueList-sort-2">
                                        <input type="radio" name="iAttributeValueList-sort" id="iAttributeValueList-sort-2">
                                        <i class="sort-asc g-icon">expand_less</i>
                                    </label>
                                    <label for="iAttributeValueList-sort-3">
                                        <input type="radio" name="iAttributeValueList-sort" id="iAttributeValueList-sort-3">
                                        <i class="sort-desc g-icon">expand_more</i>
                                    </label>
                                    <label>
                                        <i class="filter g-icon">filter_alt</i>
                                    </label>
                                <td class="wf-100"><?= $this->getHtml('Value'); ?>
                                    <label for="iAttributeValueList-sort-2">
                                        <input type="radio" name="iAttributeValueList-sort" id="iAttributeValueList-sort-2">
                                        <i class="sort-asc g-icon">expand_less</i>
                                    </label>
                                    <label for="iAttributeValueList-sort-3">
                                        <input type="radio" name="iAttributeValueList-sort" id="iAttributeValueList-sort-3">
                                        <i class="sort-desc g-icon">expand_more</i>
                                    </label>
                                    <label>
                                        <i class="filter g-icon">filter_alt</i>
                                    </label>
                                <tbody>
                            <?php
                            $count = 0;
                            foreach ($this->attribute->defaults as $key => $value) : ++$count;
                                $url = UriFactory::build('{/base}/' . $path . '/attribute/value/view?{?}&id=' . $value->id);
                            ?>
                            <tr data-href="<?= $url; ?>">
                                <td><a href="<?= $url; ?>"><?= $value->id; ?></a>
                                <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getL11n()); ?></a>
                                <td><a href="<?= $url; ?>"><?= $this->printHtml((string) $value->getValue()); ?></a>
                            <?php endforeach; ?>
                            <?php if ($count === 0) : ?>
                                <tr><td colspan="3" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                            <?php endif; ?>
                        </table>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>