<h1><?php echo $this->pageTitle ?></h1>
<div class="row">
    <div class="col-md-2">
        <?php echo CHtml::image($model->getImageUrl(250, 250)) ?>
    </div>
    <div class="col-md-10 well">
        <?php foreach ($model as $key => $value) {
            if (isset($value) && $value!='' && $value!='0')
                echo '<p><strong>'.$model->getAttributeLabel($key).'</strong>: '.$value.'</p>';
        } ?>
    </div>
</div>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm'); ?>
<?php print_r($model->errors); ?>
<?php echo $form->hiddenField($model, 'id') ?>
<div class="row">
    <div class="col-md-7">
        <?php
            $this->widget('bootstrap.widgets.TbGridView', [
                'dataProvider' => $grid->search(),
                'filter' => $grid,
                'columns'=>[
                    [
                        'class'=>'CCheckBoxColumn',
                        'id'=>'StoreProduct[ids]',
                        'selectableRows' => 2,
                        'name'=>'id',
                        'value'=>'$data->id',
                        'checked'=>function($data){
                            if (empty($data->relationsTo))
                                return false;
                            return true;
                        },
                        'checkBoxHtmlOptions' => array('class' => 'classname'),
                    ],
                    'name'=>[
                        'class'=>'bootstrap.widgets.TbImageColumn',
                        'placeKittenSize'=>'g/48/48'
                    ],
                    [
                        'name' => 'price',
                        'value' => function ($data) {
                            return $data->price;
                        },
                        'filter' => CHtml::activeTextField($grid, 'price', ['class' => 'form-control']),
                    ],
                    [
                        'name' => 'in_stock',
                        'filter' => StoreProduct::model()->getInStockList(),
                        'value'=>'StoreProduct::model()->getInStockList()[$data->in_stock]'
                    ],
                    [
                        'name' => 'status',
                        'filter' => StoreProduct::model()->getStatusList(),
                        'value'=>'StoreProduct::model()->getStatusList()[$data->status]'
                    ]
                ]
            ]);
        ?>
    </div>
    <div class="col-md-5"></div>
</div>
<?php $this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => Yii::t('RelatedproductModule', 'Save'),
    ]
); ?>

<?php $this->endWidget(); ?>