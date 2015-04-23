<?php
Yii::import('application.modules.relatedproduct.behaviors.EAdvancedArBehavior');
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
		$db = Yii::app()->db;

		$transaction = $db->beginTransaction();
		try
		{
			if (!empty($this->relationsTo)) {
				$ids = [];
				foreach ($this->relationsTo as $key => $value)
					$ids[]=$value->product_id;
			}
			
			if (!empty($this->ids) && !empty($ids)) {
				
				$add = array_diff($this->ids, $ids);
				$dell = array_diff($ids, $this->ids);
				
				foreach ($add as $key => $value) {
					$db->createCommand()->insert('{{relatedproduct_relations}}', [
						'id_product'=>$this->id,
						'product_id'=>$value,
					]);
				}

				foreach ($dell as $key => $value) {
					$db->createCommand()->delete('{{relatedproduct_relations}}', 'id_product=:id_product, product_id=:product_id', [
						':id_product'=>$this->id,
						':product_id'=>$value,
					]);
				}

				$transaction->commit();
			}else
				return false;

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
