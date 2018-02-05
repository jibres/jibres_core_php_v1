<?php
namespace content_a\sell\add;


class model extends \content_a\main\model
{
	/**
	 * Gets the post sell product.
	 *
	 * @return     array|boolean  The post sell product.
	 */
	public static function getPostSellProduct()
	{
		if(empty(array_filter(\lib\utility::post())))
		{
			\lib\debug::warn(T_("No items have been added for sale"));
			return false;
		}

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

		$sell_list = [];

		foreach ($product as $key => $value)
		{
			$sell_list[] =
			[
				'product'  => $value,
				'count'    => array_key_exists($key, $count) ? $count[$key] : null,
				'discount' => array_key_exists($key, $discount) ? $discount[$key] : null,
			];
		}

		return $sell_list;
	}


	/**
	 * Gets the post sell detail.
	 *
	 * @return     array  The post sell detail.
	 */
	public static function getPostSellDetail()
	{
		$detail             = [];
		$detail['customer'] = \lib\utility::post('customer');
		$detail['desc']     = \lib\utility::post('desc');
		return $detail;
	}


	/**
	 * Posts a sell add.
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public function post_sell_add()
	{


		// ready sell_list
		$sell_list = self::getPostSellProduct();

		if($sell_list === false)
		{
			return false;
		}

				// ready sell_list
		$detail = self::getPostSellDetail();

		if($detail === false)
		{
			return false;
		}

		$factor_detail = \lib\app\factor::add($detail, $sell_list);

		$query_data = [];

		if(\lib\debug::$status)
		{
			if(isset($factor_detail['factor_id']))
			{
				// $query_data['print'] = 'auto';
				// $query_data['size']  = 'receipt8';
				$query_data['id']    = $factor_detail['factor_id'];
				$redirect_url        = $this->url('base'). '/a/sell/pay';
			}
			else
			{
				$redirect_url = $this->url('base'). '/a/sell';
			}

			if(!empty($query_data))
			{
				$redirect_url .= '?'. http_build_query($query_data);
			}

			$this->redirector($redirect_url);
		}
	}
}
?>
