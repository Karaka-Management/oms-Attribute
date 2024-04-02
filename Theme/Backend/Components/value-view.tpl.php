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
                    <label for="iLocalization"><?= $this->getHtml('Localization', 'Attribute', 'Backend'); ?></label>
                    <input id="iLocalization" type="text" name="content" value="<?= $this->printHtml($this->attribute->getL11n()); ?>"<?= $isNew ? '' : ' disabled'; ?>>
                </div>

                <div class="form-group">
                    <label for="iValue"><?= $this->getHtml('Value', 'Attribute', 'Backend'); ?></label>
                    <?php if ($this->type->datatype === AttributeValueType::_INT || $this->type->datatype === AttributeValueType::_FLOAT_INT) : ?>
                        <input id="iValue" type="number" name="value" value="<?= $this->attribute->valueInt; ?>">
                    <?php elseif ($this->type->datatype === AttributeValueType::_FLOAT) : ?>
                        <input id="iValue" type="number" name="value" step="any" value="<?= $this->attribute->valueDec; ?>">
                    <?php elseif ($this->type->datatype === AttributeValueType::_STRING) : ?>
                        <input id="iValue" type="text" name="value" value="<?= $this->printHtml($this->attribute->valueStr); ?>">
                    <?php elseif ($this->type->datatype === AttributeValueType::_DATETIME) : ?>
                        <input id="iValue" type="text" name="value" value="<?= $this->attribute->valueDat->format('Y-m-d\TH:i'); ?>">
                    <?php elseif ($this->type->datatype === AttributeValueType::_BOOL) : ?>
                        <label class="checkbox" for="iValue">
                            <input type="checkbox" id="iValue" name="value" value="1"<?= $this->attribute->valueInt > 0 ? ' checked' : ''; ?>>
                            <span class="checkmark"></span>
                        </label>
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

<?php if (!$isNew) : ?>
<div class="row">
    <?= $this->l11nView->render(
        $this->l11ns,
        [],
        '{/api}' . $this->path . '/attribute/value/l11n?csrf={$CSRF}'
    );
    ?>
</div>
<?php endif; ?>