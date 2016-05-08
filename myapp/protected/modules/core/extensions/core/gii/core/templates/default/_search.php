<?php
/**
 * Search form generator:
 *
 * @category CoreGiiTemplate
 * @package  core
 * @author   Core Team <team@websum.uz>
 * @license  https://github.com/core/core/blob/master/LICENSE BSD
 * @link     http://websum.uz
 **/
echo <<<EOF
<?php
/**
 * Отображение для _search:
 *
 *   @category CoreView
 *   @package  core
 *   @author   Core Team <team@websum.uz>
 *   @license  https://github.com/core/core/blob/master/LICENSE BSD
 *   @link     http://websum.uz
 **/
\$form = \$this->beginWidget(
    'bootstrap.widgets.TbActiveForm', array(
        'action'      => Yii::app()->createUrl(\$this->route),
        'method'      => 'get',
        'type'        => 'vertical',
        'htmlOptions' => array('class' => 'well'),
    )
);
?>\n
EOF;
?>

<fieldset>
    <div class="row">
        <?php
        foreach ($this->tableSchema->columns as $column) {
            $field = $this->generateInputField($this->modelClass, $column);
            if (strpos($field, 'password') !== false) {
                continue;
            }

            $activeRow = $this->generateActiveGroup($this->modelClass, $column);
            echo <<<EOF
            <div class="col-sm-3">
                <?php echo {$activeRow}; ?>
            </div>\n
EOF;
        }
        ?>
    </div>
</fieldset>

<?php
echo <<<EOF
    <?php
    \$this->widget(
        'bootstrap.widgets.TbButton', array(
            'context'     => 'primary',
            'encodeLabel' => false,
            'buttonType'  => 'submit',
            'label'       => '<i class="fa fa-search">&nbsp;</i> ' . Yii::t('{$this->mid}', 'Искать {$this->vin}'),
        )
    ); ?>\n
EOF;
?>

<?php echo "<?php \$this->endWidget(); ?>"; ?>
