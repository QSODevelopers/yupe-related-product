<?php
class StoreProduct extends Product
{
	public $ids;
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function rules()
	{
		$newRules = [
			['ids', 'required']
		];
		$parentRules = parent::rules();
		return CMap::mergeArray($parentRules, $newRules);
	}
	public function relations()
	{
		return [
			// 'relationsTo'            => [self::HAS_MANY, 'Relatedproduct', 'id_product'],
			'relationsTo'               => [self::HAS_MANY, 'Relatedproduct', 'id_product'],
			'relation'                  => [self::MANY_MANY, 'Product', '{{relatedproduct_relations}}(id_product, product_id)'],
			'relationTo'                => [self::MANY_MANY, 'Product', '{{relatedproduct_relations}}(product_id, id_product)'],
			'category'                  => [self::BELONGS_TO, 'StoreCategory', 'category_id'],
			'producer'                  => [self::BELONGS_TO, 'StoreProducer', 'producer_id'],
			'type'                      => [self::BELONGS_TO, 'StoreType', 'type_id'],
			'storeProductAttributeEavs' => [self::HAS_MANY, 'StoreProductAttributeEav', 'product_id'],
			'storeProductCategories'    => [self::HAS_MANY, 'StoreProductCategory', 'product_id'],
			'storeProductImages'        => [self::HAS_MANY, 'StoreProductImage', 'product_id'],
			'storeProductVariants'      => [self::HAS_MANY, 'StoreProductVariant', 'product_id'],
		];
	}

	public function updateRel()
	{

		$transaction = Yii::app()->getDb()->beginTransaction();
		try
		{
			$arrayId = [];
			foreach ($this->ids as $key => $val) {
				$model = Relatedproduct::model()->findByAttributes(['id_product'=>$this->id, 'product_id'=>$val]);
				$model = $model ? : new Relatedproduct;

				$model->id_product = $this->id;
				$model->product_id = $val;
				if ($model->save())
					$arrayId[] = $model->primaryKey;

			}


			$criteria = new CDbCriteria();
            $criteria->addCondition('id_product = :id_product');
            $criteria->params = [':id_product' => $this->id];
            $criteria->addNotInCondition('id', $arrayId);
            Relatedproduct::model()->deleteAll($criteria);

			$transaction->commit();

			parent::beforeSave();
			return true;
		}
		catch(Exception $e)
		{
			$transaction->rollback();
			return false;
		}
	}

	public function getRelatedProducts()
	{
		$criteria = new CDbCriteria;
		$criteria->with = 'relationTo';
		$criteria->together = true;
		$criteria->compare('relationTo.id', $this->id);
		return new CActiveDataProvider($this, [
			'criteria'=>$criteria
		]);
	}
}
