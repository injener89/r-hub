<?php $this->beginContent($this->core->getBackendLayoutAlias("main")); ?>
<div class="row">
    <div class="<?php echo $this->hideSidebar ? 'col-sm-12' : 'col-sm-12 col-md-12 col-lg-12'; ?>">
        <?php
        if (count($this->breadcrumbs)) {
            $this->widget(
                'bootstrap.widgets.TbBreadcrumbs',
                [
                    'homeLink' => CHtml::link(Yii::t('CoreModule.core', 'Home'), ['/core/backend/index']),
                    'links'    => $this->breadcrumbs,
                ]
            );
        }
        ?>
        <!-- breadcrumbs -->
        <?php $this->widget('bootstrap.widgets.TbAlert'); ?>
        <div id="content">
            <?php echo $content; ?>
        </div>
        <!-- content -->
    </div>
    
</div>
<?php $this->endContent(); ?>
