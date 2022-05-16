<?php
namespace lib\app\product;


class check
{


	public static function variable($_args, $_id = null, $_option = [])
	{
		$default_option =
		[
			'debug'   => true,
			'isChild' => null,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		$isChild = $_option['isChild'];

		$title = null;

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = \lib\app\product\ganje::fill_args($_args);


		$condition =
		[
			'title'           => 'title',
			'title2'          => 'title',
			'slug'            => 'slug',
			'barcode'         => 'barcode',
			'barcode2'        => 'barcode',
			'stock'           => 'count',
			'minstock'        => 'count',
			'maxstock'        => 'count',
			'weight'          => 'float',
			'status'          => ['enum' => ['deleted', 'archive', 'draft', 'active']],
			'type'            => ['enum' => ['product','file','service']],
			'vat'             => 'bit',
			'saleonline'      => 'bit',
			'carton'          => 'count',
			'desc'            => 'real_html',
			'salestep'        => 'count',
			'minsale'         => 'count',
			'maxsale'         => 'count',
			'oversale'        => 'bit',
			'saletelegram'    => 'bit',
			'saleapp'         => 'bit',
			'trackquantity'   => 'bit',
			'parent'          => 'id',
			'scalecode'       => 'int',
			'sku'             => 'sku',
			'seotitle'        => 'title',
			'seodesc'         => 'desc',
			'sharetext'       => 'desc',
			'length'          => 'int',
			'preparationtime' => 'smallint',
			'width'           => 'int',
			'height'          => 'int',
			'filesize'        => 'int',
			'fileaddress'     => 'external_url',
			'optionname1'     => 'string_100',
			'optionvalue1'    => 'string_100',
			'optionname2'     => 'string_100',
			'optionvalue2'    => 'string_100',
			'optionname3'     => 'string_100',
			'optionvalue3'    => 'string_100',

			'buyprice'        => 'price',
			'price'           => 'price',
			'discount'        => 'price',
			'vat'             => 'bit',
			'category'        => 'tag_string',
			'cat_id'          => 'int',
			'unit'            => 'string_50', // in add manual user send the unit
			'unit_id'         => 'id', // in add by variant we have the unit id
			'gallery_raw'     => 'bit', // just need to check
			'property'        => 'bit', // just need to check

			'ganje_id'        => 'id',
			'ganje_lastfetch' => 'datetime',
			'add_from_ganje'  => 'string',
			'add_from_ganje_type' => ['enum' => ['id', 'barcode']],

		];

		$require = [];

		if(!$isChild)
		{
			$require[] = 'title';
		}

		$meta =
		[
			'field_title' =>
			[

			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(!$data['slug'])
		{
			if($data['title2'])
			{
				$data['slug'] = \dash\validate::slug($data['title2'], false);
			}
			else
			{
				$data['slug'] = \dash\validate::slug($data['title'], false);
			}
		}

		if($data['barcode'] && $data['barcode2'] && $data['barcode'] == $data['barcode2'])
		{
			\dash\notif::error(T_("Both product barcodes are equal. The first and second product barcodes cannot be equal"), ['element' => ['barcode', 'barcode2']]);
			return false;
		}

		if($data['barcode'])
		{
			$check_unique_barcode = self::check_unique_barcode($data['barcode'], $_id);
			if(!$check_unique_barcode || !\dash\engine\process::status())
			{
				return false;
			}
		}

		if($data['barcode2'])
		{
			$check_unique_barcode = self::check_unique_barcode($data['barcode2'], $_id);
			if(!$check_unique_barcode || !\dash\engine\process::status())
			{
				return false;
			}
		}

		if($data['weight'])
		{
			// remove float value of number
			$data['weight'] = floatval($data['weight']);
		}


		if(!$data['type'])
		{
			$data['type'] = 'product';
		}

		$data['vat']           = $data['vat'] 			? 'yes' : 'no';
		$data['saleonline']    = $data['saleonline'] 	? 'yes' : 'no';
		$data['oversale']      = $data['oversale'] 		? 'yes' : 'no';
		$data['saletelegram']  = $data['saletelegram'] 	? 'yes' : 'no';
		$data['saleapp']       = $data['saleapp'] 		? 'yes' : 'no';
		$data['trackquantity'] = $data['trackquantity']	? 'yes' : 'no';

		if($data['parent'])
		{
			$parent_detail = \lib\app\product\get::inline_get($data['parent']);
			if(!$parent_detail || !isset($parent_detail['id']))
			{
				\dash\notif::error(T_("Invalid parent id"));
				return  false;
			}

			$data['parent'] = $parent_detail['id'];
		}


		if($data['sku'])
		{
			$check_unique_sku = \lib\db\products\get::check_unique_sku($data['sku']);
			if(isset($check_unique_sku['id']))
			{
				if(floatval($check_unique_sku['id']) === floatval($_id))
				{
					// nothing
				}
				else
				{
					\dash\notif::error(T_("Duplicate sku code"), 'sku');
					return false;
				}
			}
		}



		/**
		 * ------------------------------------------------------------------------------
		 * ----------------------------- Check price ------------------------------------
		 * ------------------------------------------------------------------------------
		 */

		if(array_key_exists('price', $data) || array_key_exists('buyprice', $data) || array_key_exists('discount', $data))
		{
			$discountpercent = null;
			if(is_numeric($data['discount']) && is_numeric($data['price']) && floatval($data['price']) != 0)
			{
				$discountpercent = round((floatval($data['discount']) * 100) / floatval($data['price']), 2);
			}


			$data['finalprice'] = floatval($data['price']) - floatval($data['discount']);

			if($data['finalprice'] < 0)
			{
				\dash\notif::error(T_("Final price is out of range and less than zero!"), ['element' => ['discount', 'price']]);
				return false;
			}

			$data['vatprice'] = 0;

			if($data['vat'] === 'yes')
			{
				$vatprice_percent = \lib\vat::percent();
				if($vatprice_percent)
				{
					$new_finalprice = $data['finalprice'] + (($data['finalprice'] * $vatprice_percent) / 100);
					$data['vatprice']       = $new_finalprice - $data['finalprice'];
					$data['finalprice']     = $new_finalprice;
				}
			}

			if(isset($data['buyprice']))
			{
				$data['buyprice']        = floatval($data['buyprice']);
			}

			if(isset($data['price']))
			{
				$data['price']           = floatval($data['price']);
			}

			if(isset($data['discount']))
			{
				$data['discount']        = floatval($data['discount']);
			}

			$data['discountpercent'] = floatval($discountpercent);
			$data['finalprice']      = floatval($data['finalprice']);
			$data['vatprice']        = floatval($data['vatprice']);
		}

		if($data['gallery_raw'])
		{
			$new_gallery = [];

			if(is_array($_args['gallery_raw']))
			{
				$temp_gallery_raw_from_api = $_args['gallery_raw'];
			}
			else
			{
				$temp_gallery_raw_from_api = explode(',', $data['gallery_raw']);
			}

			if(is_array($temp_gallery_raw_from_api))
			{
				foreach ($temp_gallery_raw_from_api as $key => $value)
				{
					if($value && is_string($value) && \dash\validate::uploaded_in_allowed_url($value))
					{
						$new_gallery[] = ['path' => $value];
					}
				}
			}

			\dash\temp::set('temp_gallery_raw_from_api', $new_gallery);
		}


		if($data['property'] && is_array($_args['property']))
		{
			\dash\temp::set('temp_property_raw_from_api', $_args['property']);
		}

		unset($data['gallery_raw']);
		unset($data['property']);
		unset($data['add_from_ganje']);
		unset($data['add_from_ganje_type']);

		return $data;
	}





	private static function check_unique_barcode($_barcode, $_id)
	{

		$check_exist  = \lib\db\products\get::barcode($_barcode);

		if(!$check_exist)
		{
			return true;
		}
		else
		{
			if(count($check_exist) === 1)
			{
				if(isset($check_exist[0]['id']))
				{
					if($_id && floatval($_id) === floatval($check_exist[0]['id']))
					{
						// update product by old barcode
						return true;
					}
					else
					{
						$element = [];

						$msg = T_("Duplicate barcode");

						$product_title = '';
						if(isset($check_exist[0]['title']))
						{
							$product_title = $check_exist[0]['title'];
						}

						if(isset($check_exist[0]['barcode']) && $_barcode === $check_exist[0]['barcode'])
						{
							$msg = T_("This barcode used as barcode :title", ['title' => $product_title]);
							$element[] = 'barcode';
						}

						if(isset($check_exist[0]['barcode2']) && $_barcode === $check_exist[0]['barcode2'])
						{
							$msg = T_("This barcode used as barcode2 :title", ['title' => $product_title]);
							$element[] = 'barcode2';
						}

						$product_id = null;
						if(isset($check_exist[0]['id']))
						{
							$product_id = $check_exist[0]['id'];
						}

						if($product_id)
						{
							if(!\dash\url::is_api())
							{
								$link = \dash\url::this(). '/edit?id='. $product_id;
								$msg = "<a href='$link'>". $msg. '</a>';
							}
						}

						// \dash\log::set('app:product:barcode:is:duplicate');

						\dash\notif::error(T_("Duplicate barcode"), ['element' => $element, 'code' => 'business:barcode:duplicate:1']);
						\dash\notif::info($msg);
						return false;
					}
				}
				else
				{
					// \dash\log::set('app:product:barcode:1:record:havenot:id:error');
					\dash\notif::error(T_("Undefined error was happend"));
					return false;
				}
			}
			else
			{
				// \dash\log::set('more:than:2:product:save:by:one:barcode');
				\dash\notif::error(T_("More than 2 products saved by this barcode"));
				return false;
			}
		}
	}
}
?>