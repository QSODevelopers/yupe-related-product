<h1><?php echo $this->pageTitle ?></h1>
<div class="col-md-2">
    <?php echo CHtml::image($model->getImageUrl(250, 250)) ?>
</div>
<div class="col-md-10 well">
    <?php foreach ($model as $key => $value) {
        if (isset($value) && $value!='' && $value!='0')
            echo '<p><strong>'.$model->getAttributeLabel($key).'</strong>: '.$value.'</p>';
    } ?>
</div>
<div class="col-md-7">
    
</div>