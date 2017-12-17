<?php
namespace content_a\buy\add;


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
		$price    = \lib\utility::post('price');
		$buyprice = \lib\utility::post('buyprice');

		if(!is_array($product) || !is_array($count) || !is_array($discount) || !is_array($price) || !is_array($buyprice))
		{
			\lib\debug::error(T_("What are you doing?"));
			return false;
		}

		$product  = array_values($product);
		$count    = array_values($count);
		$discount = array_values($discount);
		$price    = array_values($price);
		$buyprice = array_values($buyprice);

		$buy_list = [];

		foreach ($product as $key => $value)
		{
			$buy_list[] =
			[
				'product'  => $value,
				'count'    => array_key_exists($key, $count) ? $count[$key] : null,
				'discount' => array_key_exists($key, $discount) ? $discount[$key] : null,
				'price'    => array_key_exists($key, $price) ? $price[$key] : null,
				'buyprice' => array_key_exists($key, $buyprice) ? $buyprice[$key] : null,
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
	 * Posts a buy add.
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public function post_buy_add()
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

		$factor_detail = \lib\app\factor::add($detail, $buy_list, ['type' => 'buy']);

		if(\lib\debug::$status)
		{
			if(isset($factor_detail['factor_id']))
			{
				switch (\lib\utility::post('btn_type'))
				{
					case 'save_next':
						$redirect_url = $this->url('base'). '/a/buy/add';
						break;

					case 'save_print':
						$redirect_url = $this->url('base'). '/a/buy/fishprint?id='. $factor_detail['factor_id'];
						break;

					default:
						$redirect_url = $this->url('base'). '/a/buy';
						break;
				}
			}
			else
			{
				$redirect_url = $this->url('base'). '/a/buy';
			}

			$this->redirector($redirect_url);
		}
	}
}
?>
