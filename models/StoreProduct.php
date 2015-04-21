<?php
class StoreProduct extends Product
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function behaviors(){
		$eaab = [
			'EAdvancedArBehavior' => [
				'class' => 'application.modules.relatedproduct.behaviors.EAdvancedArBehavior'
			]
		];
		
		$parent = parent::behaviors();
		return CMap::mergeArray($parent, $eaab);
	}

	public function relations()
	{
		return [
			// 'relationsTo'            => [self::HAS_MANY, 'Relatedproduct', 'id_product'],
			'relationsTo'               => [self::HAS_MANY, 'Relatedproduct', 'product_id'],
			'relation'                  => [self::MANY_MANY, 'Product', '{{relatedproduct_relations}}(id_product, product_id)'],
			'category'                  => [self::BELONGS_TO, 'StoreCategory', 'category_id'],
			'producer'                  => [self::BELONGS_TO, 'StoreProducer', 'producer_id'],
			'type'                      => [self::BELONGS_TO, 'StoreType', 'type_id'],
			'storeProductAttributeEavs' => [self::HAS_MANY, 'StoreProductAttributeEav', 'product_id'],
			'storeProductCategories'    => [self::HAS_MANY, 'StoreProductCategory', 'product_id'],
			'storeProductImages'        => [self::HAS_MANY, 'StoreProductImage', 'product_id'],
			'storeProductVariants'      => [self::HAS_MANY, 'StoreProductVariant', 'product_id'],
		];
	}
}
