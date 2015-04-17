<?php

/**
 * This is the model class for table "{{store_product}}".
 *
 * The followings are the available columns in table '{{store_product}}':
 * @property integer $id
 * @property integer $type_id
 * @property integer $producer_id
 * @property integer $category_id
 * @property string $sku
 * @property string $name
 * @property string $alias
 * @property string $price
 * @property string $discount_price
 * @property string $discount
 * @property string $description
 * @property string $short_description
 * @property string $data
 * @property integer $is_special
 * @property string $length
 * @property string $width
 * @property string $height
 * @property string $weight
 * @property integer $quantity
 * @property integer $in_stock
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $image
 * @property string $average_price
 * @property string $purchase_price
 * @property string $recommended_price
 * @property integer $position
 * @property integer $id_1c
 *
 * The followings are the available model relations:
 * @property RelatedproductRelations[] $relatedproductRelations
 * @property RelatedproductRelations[] $relatedproductRelations1
 * @property StoreCategory $category
 * @property StoreProducer $producer
 * @property StoreType $type
 * @property StoreProductAttributeEav[] $storeProductAttributeEavs
 * @property StoreProductCategory[] $storeProductCategories
 * @property StoreProductImage[] $storeProductImages
 * @property StoreProductVariant[] $storeProductVariants
 */
class StoreProduct extends yupe\models\YModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{store_product}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, alias, create_time, update_time, id_1c', 'required'),
			array('type_id, producer_id, category_id, is_special, quantity, in_stock, status, position, id_1c', 'numerical', 'integerOnly'=>true),
			array('sku', 'length', 'max'=>100),
			array('name, meta_title, meta_keywords, meta_description, image', 'length', 'max'=>250),
			array('alias', 'length', 'max'=>150),
			array('price, discount_price, discount, length, width, height, weight, average_price, purchase_price, recommended_price', 'length', 'max'=>19),
			array('description, short_description, data', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type_id, producer_id, category_id, sku, name, alias, price, discount_price, discount, description, short_description, data, is_special, length, width, height, weight, quantity, in_stock, status, create_time, update_time, meta_title, meta_keywords, meta_description, image, average_price, purchase_price, recommended_price, position, id_1c', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'relatedproductRelations' => array(self::HAS_MANY, 'RelatedproductRelations', 'id_product'),
			'relatedproductRelations1' => array(self::HAS_MANY, 'RelatedproductRelations', 'product_id'),
			'category' => array(self::BELONGS_TO, 'StoreCategory', 'category_id'),
			'producer' => array(self::BELONGS_TO, 'StoreProducer', 'producer_id'),
			'type' => array(self::BELONGS_TO, 'StoreType', 'type_id'),
			'storeProductAttributeEavs' => array(self::HAS_MANY, 'StoreProductAttributeEav', 'product_id'),
			'storeProductCategories' => array(self::HAS_MANY, 'StoreProductCategory', 'product_id'),
			'storeProductImages' => array(self::HAS_MANY, 'StoreProductImage', 'product_id'),
			'storeProductVariants' => array(self::HAS_MANY, 'StoreProductVariant', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id'                => Yii::t('Relatedproduct.relatedproduct', 'ID'),
			'category_id'       => Yii::t('Relatedproduct.relatedproduct', 'Category'),
			'type_id'           => Yii::t('Relatedproduct.relatedproduct', 'Type'),
			'name'              => Yii::t('Relatedproduct.relatedproduct', 'Title'),
			'price'             => Yii::t('Relatedproduct.relatedproduct', 'Price'),
			'discount_price'    => Yii::t('Relatedproduct.relatedproduct', 'Discount price'),
			'discount'          => Yii::t('Relatedproduct.relatedproduct', 'Discount, %'),
			'sku'               => Yii::t('Relatedproduct.relatedproduct', 'SKU'),
			'image'             => Yii::t('Relatedproduct.relatedproduct', 'Image'),
			'short_description' => Yii::t('Relatedproduct.relatedproduct', 'Short description'),
			'description'       => Yii::t('Relatedproduct.relatedproduct', 'Description'),
			'alias'             => Yii::t('Relatedproduct.relatedproduct', 'Alias'),
			'data'              => Yii::t('Relatedproduct.relatedproduct', 'Data'),
			'status'            => Yii::t('Relatedproduct.relatedproduct', 'Status'),
			'create_time'       => Yii::t('Relatedproduct.relatedproduct', 'Added'),
			'update_time'       => Yii::t('Relatedproduct.relatedproduct', 'Updated'),
			'user_id'           => Yii::t('Relatedproduct.relatedproduct', 'User'),
			'change_user_id'    => Yii::t('Relatedproduct.relatedproduct', 'Editor'),
			'is_special'        => Yii::t('Relatedproduct.relatedproduct', 'Special'),
			'length'            => Yii::t('Relatedproduct.relatedproduct', 'Length, m.'),
			'height'            => Yii::t('Relatedproduct.relatedproduct', 'Height, m.'),
			'width'             => Yii::t('Relatedproduct.relatedproduct', 'Width, m.'),
			'weight'            => Yii::t('Relatedproduct.relatedproduct', 'Weight, kg.'),
			'quantity'          => Yii::t('Relatedproduct.relatedproduct', 'Quantity'),
			'producer_id'       => Yii::t('Relatedproduct.relatedproduct', 'Producer'),
			'in_stock'          => Yii::t('Relatedproduct.relatedproduct', 'Stock status'),
			'category'          => Yii::t('Relatedproduct.relatedproduct', 'Category'),
			'meta_title'        => Yii::t('Relatedproduct.relatedproduct', 'Meta title'),
			'meta_keywords'     => Yii::t('Relatedproduct.relatedproduct', 'Meta keywords'),
			'meta_description'  => Yii::t('Relatedproduct.relatedproduct', 'Meta description'),
			'purchase_price'    => Yii::t('Relatedproduct.relatedproduct', 'Purchase price'),
			'average_price'     => Yii::t('Relatedproduct.relatedproduct', 'Average price'),
			'recommended_price' => Yii::t('Relatedproduct.relatedproduct', 'Recommended price'),
			'position'          => Yii::t('Relatedproduct.relatedproduct', 'Position')
		];
	}

	/**
	 * @return array customized attribute descriptions (name=>description)
	 */
	public function attributeDescriptions()
	{
		return [
			'id'                => Yii::t('Relatedproduct.relatedproduct', 'ID'),
			'category_id'       => Yii::t('Relatedproduct.relatedproduct', 'Category'),
			'name'              => Yii::t('Relatedproduct.relatedproduct', 'Title'),
			'price'             => Yii::t('Relatedproduct.relatedproduct', 'Price'),
			'sku'               => Yii::t('Relatedproduct.relatedproduct', 'SKU'),
			'image'             => Yii::t('Relatedproduct.relatedproduct', 'Image'),
			'short_description' => Yii::t('Relatedproduct.relatedproduct', 'Short description'),
			'description'       => Yii::t('Relatedproduct.relatedproduct', 'Description'),
			'alias'             => Yii::t('Relatedproduct.relatedproduct', 'Alias'),
			'data'              => Yii::t('Relatedproduct.relatedproduct', 'Data'),
			'status'            => Yii::t('Relatedproduct.relatedproduct', 'Status'),
			'create_time'       => Yii::t('Relatedproduct.relatedproduct', 'Added'),
			'update_time'       => Yii::t('Relatedproduct.relatedproduct', 'Edited'),
			'user_id'           => Yii::t('Relatedproduct.relatedproduct', 'User'),
			'change_user_id'    => Yii::t('Relatedproduct.relatedproduct', 'Editor'),
			'is_special'        => Yii::t('Relatedproduct.relatedproduct', 'Special'),
			'length'            => Yii::t('Relatedproduct.relatedproduct', 'Length, m.'),
			'height'            => Yii::t('Relatedproduct.relatedproduct', 'Height, m.'),
			'width'             => Yii::t('Relatedproduct.relatedproduct', 'Width, m.'),
			'weight'            => Yii::t('Relatedproduct.relatedproduct', 'Weight, kg.'),
			'quantity'          => Yii::t('Relatedproduct.relatedproduct', 'Quantity'),
			'producer_id'       => Yii::t('Relatedproduct.relatedproduct', 'Producer'),
			'purchase_price'    => Yii::t('Relatedproduct.relatedproduct', 'Purchase price'),
			'average_price'     => Yii::t('Relatedproduct.relatedproduct', 'Average price'),
			'recommended_price' => Yii::t('Relatedproduct.relatedproduct', 'Recommended price'),
		];
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('producer_id',$this->producer_id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('sku',$this->sku,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('discount_price',$this->discount_price,true);
		$criteria->compare('discount',$this->discount,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('short_description',$this->short_description,true);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('is_special',$this->is_special);
		$criteria->compare('length',$this->length,true);
		$criteria->compare('width',$this->width,true);
		$criteria->compare('height',$this->height,true);
		$criteria->compare('weight',$this->weight,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('in_stock',$this->in_stock);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('average_price',$this->average_price,true);
		$criteria->compare('purchase_price',$this->purchase_price,true);
		$criteria->compare('recommended_price',$this->recommended_price,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('id_1c',$this->id_1c);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StoreProduct the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
