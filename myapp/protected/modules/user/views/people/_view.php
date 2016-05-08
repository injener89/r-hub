<div class="view">

    <b><?php echo $data->getAvatar(); ?></b>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('sid')); ?>:</b>
    <?php echo CHtml::encode($data->sid); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('creation_date')); ?>:</b>
    <?php echo CHtml::encode($data->creation_date); ?>
    <br/>

</div>
