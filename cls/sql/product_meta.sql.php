<?php
namespace sql;
class product_meta {
	public $id = array('type' => 'int@10', 'label' => 'product_meta_id');
	public $product_id = array('type' => 'smallint@5', 'label' => 'product_meta_product_id');
	public $productmeta_cat = array('type' => 'varchar@50', 'label' => 'product_meta_productmeta_cat');
	public $productmeta_name = array('type' => 'varchar@100', 'label' => 'product_meta_productmeta_name');
	public $productmeta_value = array('type' => 'varchar@999', 'label' => 'product_meta_productmeta_value');
	public $date_created = array('type' => 'timestamp@!CURRENT_TIMESTAMP', 'label' => 'product_meta_date_created');
	public $date_modified = array('type' => 'timestamp@!0000-00-00 00:00:00', 'label' => 'product_meta_date_modified');

	public function id(){}
	public function product_id(){}
	public function productmeta_cat(){}
	public function productmeta_name(){}
	public function productmeta_value(){}
	public function date_created(){}
	public function date_modified(){}
}
?>