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

echo $this->data['nav']->render(); ?>
<div class="row">
    <div class="col-md-6 col-xs-12">
        <section id="task" class="portlet">
            <form id="attributeForm" method="<?= $isNew ? 'PUT' : 'POST'; ?>" action="<?= UriFactory::build('{/api}' . $this->path . '/attribute/value?csrf={$CSRF}'); ?>">
            <div class="portlet-head"><?= $this->getHtml('Attribute', 'Attribute', 'Backend'); ?></div>
            <div class="portlet-body">
                <div class="form-group">
                    <label for="iId"><?= $this->getHtml('ID', '0', '0'); ?></label>
                    <input type="text" value="<?= $this->attribute->id; ?>" disabled>
                </div>

                <div class="form-group">
                    <label for="iName"><?= $this->getHtml('Name', 'Attribute', 'Backend'); ?></label>
                    <input id="iName" type="text" value="<?= $this->printHtml($this->attribute->getL11n()); ?>" disabled>
                </div>

                <div class="form-group">
                    <label for="iValue"><?= $this->getHtml('Value', 'Attribute', 'Backend'); ?></label>
                    <?php if ($this->attribute->valueInt !== null) : ?>
                        <input id="iValue" type="number" name="value" value="<?= $this->attribute->valueInt; ?>">
                    <?php elseif ($this->attribute->valueDec !== null) : ?>
                        <input id="iValue" type="number" name="value" step="any" value="<?= $this->attribute->valueDec; ?>">
                    <?php elseif ($this->attribute->valueStr !== null) : ?>
                        <input id="iValue" type="text" name="value" value="<?= $this->printHtml($this->attribute->valueStr); ?>">
                    <?php elseif ($this->attribute->valueDat !== null) : ?>
                        <input id="iValue" type="text" name="value" value="<?= $this->attribute->valueDat->format('Y-m-d\TH:i'); ?>">
                    <?php endif; ?>
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
        '{/api}' . $this->path . '/attribute/value/l11n?csrf={$CSRF}'
    );
    ?>
</div>