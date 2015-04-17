<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	Yii::t('RelatedproductModule.relatedproduct', 'Related products'),
);
?>
<h1><?php echo Yii::t('RelatedproductModule.relatedproduct', 'Related products'); ?></h1>

<div class="col-md-12">
    <?php 
        $this->widget('yupe\widgets\CustomGridView', [
            'actionsButtons'=>false,
            'sortableRows'      => true,
            'sortableAjaxSave'  => true,
            'sortableAttribute' => 'position',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns'=>[
                'name',
                [
                    'name' => 'price',
                    'value' => function ($data) {
                        return (float)$data->price;
                    },
                    'filter' => CHtml::activeTextField($model, 'price', ['class' => 'form-control']),
                ],
                'discount_price',
                [
                    'class' => 'yupe\widgets\EditableStatusColumn',
                    'name' => 'in_stock',
                    'url' => $this->createUrl('/store/productBackend/inline'),
                    'source' => Product::model()->getInStockList(),
                    'options' => [
                        Product::STATUS_IN_STOCK => ['class' => 'label-success'],
                        Product::STATUS_NOT_IN_STOCK => ['class' => 'label-danger']
                    ],
                ],
                [
                'class' => 'yupe\widgets\EditableStatusColumn',
                    'name' => 'status',
                    'url' => $this->createUrl('/store/productBackend/inline'),
                    'source' => Product::model()->getStatusList(),
                    'options' => [
                        Product::STATUS_ACTIVE => ['class' => 'label-success'],
                        Product::STATUS_NOT_ACTIVE => ['class' => 'label-info'],
                        Product::STATUS_ZERO => ['class' => 'label-default'],
                    ],
                ],
                [
                    'class' => 'yupe\widgets\CustomButtonColumn',
                    'viewButtonIcon'=>'fa fa-fw fa-arrows-h',
                    'template'=>'{view}',
                    'viewButtonUrl'=>'Yii::app()->controller->createUrl("relation",array("id"=>$data->primaryKey))'
                ],
            ]
        ]);
     ?>
</div>