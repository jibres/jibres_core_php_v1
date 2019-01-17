<?php
namespace lib\app;


class product
{

	use \lib\app\product\add;
	use \lib\app\product\edit;
	use \lib\app\product\datalist;
	use \lib\app\product\get;
	use \lib\app\product\delete;
	use \lib\app\product\barcode;

	/**
	 * Gets the static list.
	 * cat
	 * company
	 * unit
	 *
	 * @param      string   $_type     The type
	 * @param      boolean  $_implode  The implode
	 *
	 * @return     array    The static list.
	 */
	private static function get_static_list($_type, $_implode = false)
	{
		$cache_key = "product_static_list_". $_type. \lib\store::id();
		if(\dash\session::get($cache_key, 'jibres_store'))
		{
			$static_list = \dash\session::get($cache_key, 'jibres_store');
		}
		else
		{
			$fn = "get_". $_type. "_list";
			$static_list = \lib\db\products::{$fn}(\lib\store::id());
			if(!is_array($static_list))
			{
				$static_list = [];
			}
			\dash\session::set($cache_key, $static_list, 'jibres_store', (60 * 1));
		}

		$static_list = array_filter($static_list);

		if($_implode)
		{
			$static_list = implode(',', $static_list);
		}

		return $static_list;

	}


	public static function company_list($_implode = false)
	{
		return self::get_static_list('company', $_implode);
	}



	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	private static function check($_id, $_option = [])
	{
		$default_option =
		[
			'debug' => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		$title = null;
		if(\dash\app::isset_request('title'))
		{
			$title = \dash\app::request('title');
			if(!$title)
			{
				\dash\notif::error(T_("Product title can not be null"), 'title');
				return false;
			}

			if(mb_strlen($title) >= 500)
			{
				\dash\notif::error(T_("Product title must be less than 500 character"), 'title');
				return false;
			}
		}


		$name = \dash\app::request('name');
		if($name && mb_strlen($name) >= 500)
		{
			\dash\notif::error(T_("Product name must be less than 500 character"), 'name');
			return false;
		}

		$cat = \dash\app::request('cat');
		if($cat && mb_strlen($cat) >= 200)
		{
			\dash\notif::error(T_("Product cat must be less than 200 character"), 'cat');
			return false;
		}

		// $slug = \dash\app::request('slug');
		$slug = \dash\utility\filter::slug($title, null, 'persian');
		$slug = substr($slug, 0, 199);


		$company = \dash\app::request('company');
		if($company && mb_strlen($company) >= 200)
		{
			\dash\notif::error(T_("String of product company is too large"), 'company');
			return false;
		}

		$unit = \dash\app::request('unit');
		if($unit && mb_strlen($unit) >= 100)
		{
			\dash\notif::error(T_("String of product unit is too large"), 'unit');
			return false;
		}

		$barcode = \dash\app::request('barcode');

		$to_barcode = \dash\utility\convert::to_barcode($barcode);
		if($barcode != $to_barcode)
		{
			\dash\notif::warn(T_("Your barcode have wrong character. we change it. please check your product again"), 'barcode');
			$barcode = $to_barcode;
		}

		if($barcode && mb_strlen($barcode) >= 100)
		{
			\dash\notif::error(T_("String of product barcode is too large"), 'barcode');
			return false;
		}

		$barcode2 = \dash\app::request('barcode2');

		$to_barcode2 = \dash\utility\convert::to_barcode($barcode2);
		if($barcode2 != $to_barcode2)
		{
			\dash\app::log('barcode2:is:different:barcode2', \dash\user::id(), \dash\app::log_meta(1, ['barcode2' => $barcode2, 'fixed' => $to_barcode2]));
			\dash\notif::warn(T_("Your barcode2 have wrong character. we change it. please check your product again"), 'barcode2');
			$barcode2 = $to_barcode2;
		}

		if($barcode2 && mb_strlen($barcode2) >= 100)
		{
			\dash\notif::error(T_("String of product barcode2 is too large"), 'barcode2');
			return false;
		}

		if($barcode && $barcode2 && $barcode == $barcode2)
		{
			\dash\notif::error(T_("Duplicate barcode in one product"), 'barcode2');
			return false;
		}

		if($barcode)
		{
			self::check_unique_barcode($barcode, $_id, $_option);
			if(!\dash\engine\process::status())
			{
				return false;
			}
		}

		if($barcode2)
		{
			self::check_unique_barcode($barcode2, $_id, $_option);
			if(!\dash\engine\process::status())
			{
				return false;
			}
		}

		$quickcode = \dash\app::request('quickcode');
		if($quickcode && mb_strlen($quickcode) >= 200)
		{
			\dash\notif::error(T_("String of product code is too large"), 'code');
			return false;
		}

		$buyprice = \dash\app::request('buyprice');
		$buyprice = \dash\utility\convert::to_en_number($buyprice);
		if($buyprice && !is_numeric($buyprice))
		{
			\dash\notif::error(T_("Value of buyprice muset be a number"), 'buyprice');
			return false;
		}

		if(floatval($buyprice) >= 1E+20 || floatval($buyprice) < 0)
		{
			\dash\notif::error(T_("Value of buyprice is out of rage"), 'buyprice');
			return false;
		}

		$price = \dash\app::request('price');
		$price = \dash\utility\convert::to_en_number($price);
		if($price && !is_numeric($price))
		{
			\dash\notif::error(T_("Value of price muset be a number"), 'price');
			return false;
		}

		if(floatval($price) >= 1E+20 || floatval($price) < 0)
		{
			\dash\notif::error(T_("Value of price is out of rage"), 'price');
			return false;
		}

		$discount = \dash\app::request('discount');
		$discount = \dash\utility\convert::to_en_number($discount);
		if($discount && !is_numeric($discount))
		{
			\dash\notif::error(T_("Value of discount muset be a number"), 'discount');
			return false;
		}

		if($discount && abs(floatval($discount)) >= 1E+10)
		{
			\dash\notif::error(T_("Value of discount is out of rage"), 'discount');
			return false;
		}

		$discountpercent = null;
		if($discount && $price && intval($price) !== 0)
		{
			$discountpercent = round((floatval($discount) * 100) / floatval($price), 3);
		}

		$initialbalance = \dash\app::request('initialbalance');
		$initialbalance = \dash\utility\convert::to_en_number($initialbalance);
		if($initialbalance && !is_numeric($initialbalance))
		{
			\dash\notif::error(T_("Value of initialbalance muset be a number"), 'initialbalance');
			return false;
		}

		if(floatval($initialbalance) >= 1E+10 || floatval($initialbalance) < 0)
		{
			\dash\notif::error(T_("Value of initialbalance is out of rage"), 'initialbalance');
			return false;
		}

		$minstock = \dash\app::request('minstock');
		$minstock = \dash\utility\convert::to_en_number($minstock);
		if($minstock && !is_numeric($minstock))
		{
			\dash\notif::error(T_("Value of minstock muset be a number"), 'minstock');
			return false;
		}

		if(floatval($minstock) >= 1E+10 || floatval($minstock) < 0)
		{
			\dash\notif::error(T_("Value of minstock is out of rage"), 'minstock');
			return false;
		}

		$maxstock = \dash\app::request('maxstock');
		$maxstock = \dash\utility\convert::to_en_number($maxstock);
		if($maxstock && !is_numeric($maxstock))
		{
			\dash\notif::error(T_("Value of maxstock muset be a number"), 'maxstock');
			return false;
		}

		if(floatval($maxstock) >= 1E+10 || floatval($maxstock) < 0)
		{
			\dash\notif::error(T_("Value of maxstock is out of rage"), 'maxstock');
			return false;
		}

		$status = \dash\app::request('status');

		if($status && !in_array($status, ['unset','available','unavailable','soon','discountinued']))
		{
			\dash\notif::error(T_("Product status is incorrect"), 'status');
			return false;
		}

		$stock = \dash\app::request('stock');
		$stock = \dash\utility\convert::to_en_number($stock);
		if($stock && !is_numeric($stock))
		{
			\dash\notif::error(T_("Value of stock muset be a number"), 'stock');
			return false;
		}

		if(abs(floatval($stock)) >= 1E+20)
		{
			\dash\notif::error(T_("Value of stock is out of rage"), 'stock');
			return false;
		}

		$thumb = \dash\app::request('thumb');
		if($thumb && !is_string($thumb))
		{
			\dash\notif::error(T_("Value of thumb is out of rage"), 'thumb');
			return false;
		}

		$vat = null;
		if(\dash\app::isset_request('vat'))
		{
			$vat = \dash\app::request('vat');
			$vat = $vat ? 1 : 0;
		}

		$service = null;
		if(\dash\app::isset_request('service'))
		{
			$service    = \dash\app::request('service');
			$service    = $service ? 1 : 0;
		}

		$checkstock = null;
		if(\dash\app::isset_request('checkstock'))
		{
			$checkstock = \dash\app::request('checkstock');
			$checkstock = $checkstock ? 1 : 0;
		}

		$saleonline = null;
		if(\dash\app::isset_request('saleonline'))
		{
			$saleonline = \dash\app::request('saleonline');
			$saleonline = $saleonline ? 1 : 0;
		}

		$salestore = null;
		if(\dash\app::isset_request('salestore'))
		{
			$salestore  = \dash\app::request('salestore');
			$salestore  = $salestore ? 1 : 0;
		}

		$carton = \dash\app::request('carton');
		$carton = \dash\utility\convert::to_en_number($carton);
		if($carton && !is_numeric($carton))
		{
			\dash\notif::error(T_("Value of carton muset be a number"), 'carton');
			return false;
		}

		if(floatval($carton) >= 1E+10 || floatval($carton) < 0)
		{
			\dash\notif::error(T_("Value of carton is out of rage"), 'carton');
			return false;
		}

		$desc = \dash\app::request('desc');
		if($desc && mb_strlen($desc) > 1E+4)
		{
			\dash\notif::error(T_("Value of desc is out of rage"), 'desc');
			return false;
		}

		// prosess finalprice
		$finalprice = floatval($price) - floatval($discount);
		if($finalprice < 0)
		{
			\dash\notif::error(T_("Final price is less than 0"), 'price');
			return false;
		}

		if($finalprice < floatval($buyprice))
		{
			\dash\notif::warn(T_("Final price less than buyprice!"));
		}

		$master_args = \dash\app::request();
		// check to add new cat or unit
		if($cat)
		{
			\lib\app\product\cat::$debug = false;
			\lib\app\product\cat::check_add($cat);
		}

		if($unit)
		{
			\lib\app\product\unit::$debug = false;
			\lib\app\product\unit::check_add($unit);
		}

		\dash\app::request_set($master_args);

		$args                    = [];
		$args['title']           = $title;
		$args['cat']             = $cat;
		$args['slug']            = $slug;
		$args['company']         = $company;
		$args['unit']            = $unit;
		$args['barcode']         = $barcode;
		$args['barcode2']        = $barcode2;
		$args['quickcode']       = $quickcode;
		$args['buyprice']        = $buyprice;
		$args['price']           = $price;
		$args['discount']        = $discount;
		$args['discountpercent'] = $discountpercent;
		$args['vat']             = $vat;
		$args['initialbalance']  = $initialbalance;
		$args['minstock']        = $minstock;
		$args['maxstock']        = $maxstock;
		$args['status']          = $status;
		$args['stock']           = $stock;
		$args['thumb']           = $thumb;
		$args['service']         = $service;
		$args['checkstock']      = $checkstock;
		$args['saleonline']      = $saleonline;
		$args['salestore']       = $salestore;
		$args['carton']          = $carton;
		$args['desc']            = $desc;

		return $args;
	}


	/**
	 * ready data of product to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function ready($_data)
	{
		$result = [];

		if(!is_array($_data))
		{
			return null;
		}

		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
				case 'creator':
					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'slug':
					$result[$key] = isset($value) ? (string) $value : null;
					break;

				case 'thumb':
					$result['thumb_raw'] = $value;
					if($value)
					{
						$result[$key] = \lib\filepath::fix($value);
					}
					else
					{
						$result[$key] = \dash\app::static_image_url();
					}
					break;

				case 'gallery':
					$result['gallery'] = $value;
					$result['gallery_array'] = json_decode($value, true);
					break;

				case 'finalprice':
				case 'intrestrate':
				case 'intrestrate_impure':
					$result[$key] = isset($value) ? (float) $value : null;
					break;

				case 'country':
				case 'city':
				case 'province':
				case 'zipcode':
				case 'name':
				case 'title':
				case 'desc':
				case 'alias':
				case 'status':
				default:
					$result[$key] = isset($value) ? (string) $value : null;
					break;
			}
		}
		return $result;
	}
}
?>