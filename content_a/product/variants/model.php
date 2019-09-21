<?php
namespace content_a\product\variants;


class model
{
	private static function getPost()
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
			elseif(substr($key, 0, 8) === 'barcode_' && is_numeric(substr($key, 8)))
			{
				$barcode[substr($key, 8)] = $value;
			}

		}

		$final_list = [];

		foreach ($avalible as $key => $value)
		{
			if(isset($stock[$key]) && $stock[$key])
			{
				$final_list[] =
				[
					'option1' => array_key_exists($key, $option1) ? $option1[$key] : null,
					'option2' => array_key_exists($key, $option2) ? $option2[$key] : null,
					'option3' => array_key_exists($key, $option3) ? $option3[$key] : null,
					'stock'   => array_key_exists($key, $stock) ? $stock[$key] : null,
					'price'   => array_key_exists($key, $price) ? $price[$key] : null,
					'barcode' => array_key_exists($key, $barcode) ? $barcode[$key] : null,
					'sku'     => array_key_exists($key, $sku) ? $sku[$key] : null,
				];
			}
		}

		return $final_list;

	}


	public static function post()
	{
		if(\dash\request::post('setvariants'))
		{
			$variant = self::get_variant();

			if(!$variant)
			{
				\dash\notif::error(T_("Please set stock and price of product"));
				return false;
			}

			\lib\app\product\variants::set_product($variant, \dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}
		else
		{
			$request         = self::getPost();

			\lib\app\product\variants::set($request, \dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}
	}

}
?>
