<?php foreach ($model as $key => $value): ?>
    <?php echo $value->name; ?>
    <?php echo CHtml::image($value->getImageUrl(200, 200)); ?>
<?php endforeach ?>