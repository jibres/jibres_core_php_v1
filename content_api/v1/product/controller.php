<?php
namespace content_api\v1\product;

class controller extends \addons\content_api\home\controller
{

	/**
	 * product
	 */
	public function ready()
	{
		// get product list
		$this->get('productList')->ALL('v1/product/list');
		$this->get('productList')->ALL('v1/productlist');
		// get 1 product detail
		$this->get('one_product')->ALL('v1/product');
		// add new product
		$this->post('product')->ALL('v1/product');
		// update old product
		$this->patch('product')->ALL('v1/product');
	}
}
?>