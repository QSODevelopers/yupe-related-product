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

<div class="row">
    <div class="col-md-7">
        <?php
            $this->widget('bootstrap.widgets.TbGridView', [
                'dataProvider' => $grid->search(),
                'filter' => $grid,
                'columns'=>[
                    'name',
                    [
                        'name' => 'price',
                        'value' => function ($data) {
                            return (float)$data->price;
                        },
                        'filter' => CHtml::activeTextField($grid, 'price', ['class' => 'form-control']),
                    ],
                    [
                        'name' => 'in_stock',
                        'filter' => Product::model()->getInStockList(),
                        'value'=>'Product::model()->getInStockList()[$data->in_stock]'
                    ],
                    [
                        'name' => 'status',
                        'filter' => Product::model()->getStatusList(),
                        'value'=>'Product::model()->getStatusList()[$data->status]'
                    ]
                ]
            ]);
        ?>
    </div>
    <div class="col-md-5"></div>
</div>