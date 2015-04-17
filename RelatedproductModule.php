<?php
use yupe\components\WebModule;
class RelatedproductModule extends WebModule
{
	const VERSION = '0.1';

	public function getVersion()
	{
		return self::VERSION;
	}

	public function getDependencies()
	{
		return [
			'store',
		];
	}

	// public function getCategory()
	// {
	// 	return Yii::t('RelatedproductModule.relatedproduct', 'Catalog');
	// }

	public function getName()
	{
		return Yii::t('RelatedproductModule.relatedproduct', 'Related products');
	}

	public function getDescription()
	{
		return Yii::t('RelatedproductModule.relatedproduct', 'Related products, that says it all');
	}

	public function getAuthor()
	{
		return Yii::t('RelatedproductModule.relatedproduct', 'UnnamedTeam');
	}

	public function getAuthorEmail()
	{
		return 'max100491@mail.ru';
	}

	public function getIcon()
	{
		return "fa fa-fw fa-th-list";
	}

	public function getAdminPageLink()
	{
		return "/relatedproduct/relatedproductBackend/index";
	}

	public function init()
	{
		$this->setImport(array(
			'relatedproduct.components.*',
		));

		parent::init();
	}
}
