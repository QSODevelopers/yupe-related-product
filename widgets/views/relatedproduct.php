<?php if ($this->title): ?>
    <h2><?php echo $this->title; ?></h2>
<?php endif ?>

<?php foreach ($model as $key => $value): ?>
    <?php echo $value->name; ?>
    <?php echo CHtml::image($value->getImageUrl(200, 200)); ?>
<?php endforeach ?>