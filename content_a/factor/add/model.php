<?php
namespace content_a\factor\add;


class model extends \content_a\main\model
{
	/**
	 * Gets the post factor product.
	 *
	 * @return     array|boolean  The post factor product.
	 */
	public static function getPostSaleProduct()
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
			\lib\debug::warn(T_("No items have been added for sale"));
			return false;
		}

		$product  = array_values($product);
		$count    = array_values($count);
		$discount = array_values($discount);

		$factor_list = [];

		foreach ($product as $key => $value)
		{
			$factor_list[] =
			[
				'product'  => $value,
				'count'    => array_key_exists($key, $count) ? $count[$key] : null,
				'discount' => array_key_exists($key, $discount) ? $discount[$key] : null,
			];
		}

		return $factor_list;
	}


	/**
	 * Gets the post factor detail.
	 *
	 * @return     array  The post factor detail.
	 */
	public static function getPostSaleDetail()
	{
		$detail             = [];
		$detail['customer'] = \lib\utility::post('customer');
		$detail['type']     = \lib\utility::get('type');
		$detail['desc']     = \lib\utility::post('desc');
		return $detail;
	}


	/**
	 * Posts a factor add.
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public function post_factor_add()
	{


		// ready factor_list
		$factor_list = self::getPostSaleProduct();

		if($factor_list === false)
		{
			return false;
		}

				// ready factor_list
		$detail = self::getPostSaleDetail();

		if($detail === false)
		{
			return false;
		}

		$factor_detail = \lib\app\factor::add($detail, $factor_list);

		$query_data = [];

		if(\lib\debug::$status)
		{
			if(isset($factor_detail['factor_id']))
			{
				// $query_data['print'] = 'auto';
				// $query_data['size']  = 'receipt8';
				$query_data['id']    = $factor_detail['factor_id'];
				$redirect_url        = $this->url('base'). '/a/factor/opr';
			}
			else
			{
				$redirect_url = $this->url('base'). '/a/factor';
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
