<?php

class m150417_090303_new_table_related_product extends yupe\components\DbMigration
{

	public function safeUp()
	{
		$this->createTable('{{relatedproduct_relations}}', [
			'id'=>'pk',
			'product_id'=>'integer',
			'id_product'=>'integer',
		], $this->getOptions());
		$this->addForeignKey("fk_{{relatedproduct_relations}}_product_id", "{{relatedproduct_relations}}", "product_id", "{{store_product}}", "id", "CASCADE", "CASCADE");
		$this->addForeignKey("fk_{{relatedproduct_relations}}_id_product", "{{relatedproduct_relations}}", "id_product", "{{store_product}}", "id", "CASCADE", "CASCADE");
		$this->createIndex('ui_{{relatedproduct_relations}}_product_id_id_product', '{{relatedproduct_relations}}', 'id_product, product_id', true);
	}

	public function safeDown()
	{
		$this->dropTable('{{relatedproduct_relations}}');
	}
}