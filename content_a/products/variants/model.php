<?php
namespace content_a\products\variants;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');

		self::set_variant($id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}



	private static function getPostVariant()
	{
		$args =
		[
			'optionname1'  => \dash\request::post('optionname1'),
			'optionname2'  => \dash\request::post('optionname2'),
			'optionname3'  => \dash\request::post('optionname3'),
			'optionvalue1' => \dash\request::post('optionvalue1'),
			'optionvalue2' => \dash\request::post('optionvalue2'),
			'optionvalue3' => \dash\request::post('optionvalue3'),
		];

		return $args;
	}

	private static function get_variant()
	{
		$post = \dash\request::post();

		$variant  = [];

		$avalible = [];
		$option1  = [];
		$option2  = [];
		$option3  = [];
		$stock    = [];
		$price    = [];
		$buyprice = [];
		$discount = [];
		$barcode  = [];

		foreach ($post as $key => $value)
		{
			if(substr($key, 0, 9) === 'avalible_' && is_numeric(substr($key, 9)))
			{
				$avalible[substr($key, 9)] = $value;
			}
			elseif(substr($key, 0, 8) === 'option1_' && is_numeric(substr($key, 8)))
			{
				$option1[substr($key, 8)] = $value;
			}
			elseif(substr($key, 0, 8) === 'option2_' && is_numeric(substr($key, 8)))
			{
				$option2[substr($key, 8)] = $value;
			}
			elseif(substr($key, 0, 8) === 'option3_' && is_numeric(substr($key, 8)))
			{
				$option3[substr($key, 8)] = $value;
			}
			elseif(substr($key, 0, 6) === 'stock_' && is_numeric(substr($key, 6)))
			{
				$stock[substr($key, 6)] = $value;
			}
			elseif(substr($key, 0, 4) === 'sku_' && is_numeric(substr($key, 4)))
			{
				$sku[substr($key, 4)] = $value;
			}
			elseif(substr($key, 0, 6) === 'price_' && is_numeric(substr($key, 6)))
			{
				$price[substr($key, 6)] = $value;
			}
			elseif(substr($key, 0, 9) === 'buyprice_' && is_numeric(substr($key, 9)))
			{
				$buyprice[substr($key, 9)] = $value;
			}
			elseif(substr($key, 0, 9) === 'discount_' && is_numeric(substr($key, 9)))
			{
				$discount[substr($key, 9)] = $value;
			}
			elseif(substr($key, 0, 8) === 'barcode_' && is_numeric(substr($key, 8)))
			{
				$barcode[substr($key, 8)] = $value;
			}

		}

		$final_list = [];

		foreach ($avalible as $key => $value)
		{

			$final_list[] =
			[
				'option1'  => array_key_exists($key, $option1) ? $option1[$key] : null,
				'option2'  => array_key_exists($key, $option2) ? $option2[$key] : null,
				'option3'  => array_key_exists($key, $option3) ? $option3[$key] : null,
				'stock'    => array_key_exists($key, $stock) ? $stock[$key] : null,
				'price'    => array_key_exists($key, $price) ? $price[$key] : null,
				'buyprice' => array_key_exists($key, $buyprice) ? $buyprice[$key] : null,
				'discount' => array_key_exists($key, $discount) ? $discount[$key] : null,
				'barcode'  => array_key_exists($key, $barcode) ? $barcode[$key] : null,
				// 'sku'      => array_key_exists($key, $sku) ? $sku[$key] : null,
			];

		}

		return $final_list;

	}


	private static function set_variant($_id)
	{

		if(\dash\request::post('submitall') === 'savevariants')
		{
			$variant = self::get_variant();

			if(!$variant)
			{
				\dash\notif::error(T_("Please specify the required products"));
				return false;
			}

			\lib\app\product\variants::set_product($variant, $_id);

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/edit?id='. \dash\request::get('id'));
			}
			return;
		}

		if(\dash\request::post('submitall') === 'makevariants' || \dash\request::post('submitall') === 'makevariantsagain')
		{
			$request         = self::getPostVariant();

			\lib\app\product\variants::set($request, $_id);

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that(). '?id='. \dash\request::get('id'));
			}
			return;
		}
	}
}
?>