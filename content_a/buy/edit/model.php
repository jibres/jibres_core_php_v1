<?php
namespace content_a\buy\edit;


class model extends \content_a\main\model
{
	/**
	 * Gets the post buy product.
	 *
	 * @return     array|boolean  The post buy product.
	 */
	public static function getPostBuyProduct()
	{
		$product  = \lib\utility::post('products');
		$count    = \lib\utility::post('count');
		$discount = \lib\utility::post('discount');

		if(!is_array($product) || !is_array($count) || !is_array($discount))
		{
			\lib\debug::error(T_("What are you doing?"));
			return false;
		}

		$product  = array_values($product);
		$count    = array_values($count);
		$discount = array_values($discount);

		$buy_list = [];

		foreach ($product as $key => $value)
		{
			$buy_list[] =
			[
				'product'  => $value,
				'count'    => array_key_exists($key, $count) ? $count[$key] : null,
				'discount' => array_key_exists($key, $discount) ? $discount[$key] : null,
			];
		}

		return $buy_list;
	}


	/**
	 * Gets the post buy detail.
	 *
	 * @return     array  The post buy detail.
	 */
	public static function getPostBuyDetail()
	{
		$detail             = [];
		$detail['customer'] = \lib\utility::post('customer');
		$detail['desc']     = \lib\utility::post('desc');
		return $detail;
	}


	/**
	 * Posts a buy edit.
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public function post_buy_edit()
	{
		// ready buy_list
		$buy_list = self::getPostBuyProduct();

		if($buy_list === false)
		{
			return false;
		}

		// ready buy_list
		$detail = self::getPostBuyDetail();

		if($detail === false)
		{
			return false;
		}

		\lib\app\factor::edit(\lib\utility::get('id'), $detail, $buy_list);

		if(\lib\debug::$status)
		{
			$this->redirector($this->url('base'). '/a/buy');
		}
	}
}
?>
