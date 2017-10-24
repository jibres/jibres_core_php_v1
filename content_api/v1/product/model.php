<?php
namespace content_api\v1\product;
use \lib\debug;
use \lib\utility;
use \lib\db\logs;
class model extends \addons\content_api\v1\home\model
{
	use tools\add;
	use tools\get;
	use tools\delete;
	use tools\close;


	/**
	 * Posts a product.
	 * insert new product
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public function post_product()
	{
		return $this->add_product();
	}


	/**
	 * patch the ream
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public function patch_product()
	{
		return $this->add_product(['method' => 'patch']);
	}


	/**
	 * Gets one product.
	 *
	 * @return     <type>  One product.
	 */
	public function get_one_product()
	{
		return $this->get_product();
	}


	/**
	 * Gets the product list.
	 *
	 * @return     <type>  The product list.
	 */
	public function get_productList()
	{
		return $this->get_list_product();
	}
}
?>