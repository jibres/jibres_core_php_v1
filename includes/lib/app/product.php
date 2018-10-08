<?php
namespace lib\app;


class product
{

	use \lib\app\product\add;
	use \lib\app\product\edit;
	use \lib\app\product\datalist;
	use \lib\app\product\get;
	use \lib\app\product\buyprice;
	use \lib\app\product\import;
	use \lib\app\product\export;
	use \lib\app\product\delete;
	use \lib\app\product\barcode;
	use \lib\app\product\dashboard;

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


	public static function cat_list($_implode = false)
	{
		return self::get_static_list('cat', $_implode);
	}


	public static function company_list($_implode = false)
	{
		return self::get_static_list('company', $_implode);
	}


	public static function unit_list($_implode = false)
	{
		return self::get_static_list('unit', $_implode);
	}


	public static function save_offline_store_cat_field()
	{
		$cat_list_count = \lib\db\products::field_group_count('cat', \lib\store::id());

		if(!is_array($cat_list_count))
		{
			$cat_list_count = [];
		}

		$json = \lib\store::detail('cat');
		if(!is_array($json))
		{
			$json = [];
		}

		$new  = array_merge($cat_list_count, $json);
		$temp = [];
		foreach ($new as $key => $value)
		{
			$temp[$key] = ['title' => $key];
		}

		if(!empty($temp))
		{
			$temp = json_encode($temp, JSON_UNESCAPED_UNICODE);
			\lib\db\stores::update(['cat' => $temp], \lib\store::id());
			\lib\store::refresh();
		}
	}

	public static function add_new_cat($_new_cat)
	{
		if(!$_new_cat && $_new_cat !== '0')
		{
			\dash\notif::error(T_("Plese fill the category name"), 'cat');
			return false;
		}

		$json = \lib\store::detail('cat');
		if(is_string($json))
		{
			$json = json_decode($json, true);
		}

		if(!is_array($json))
		{
			$json = [];
		}

		if(isset($json[$_new_cat]))
		{
			\dash\notif::error(T_("Duplicate category founded"), 'cat');
			return false;
		}

		$json[$_new_cat] = ['title' => $_new_cat];

		$json = json_encode($json, JSON_UNESCAPED_UNICODE);
		\lib\db\stores::update(['cat' => $json], \lib\store::id());

		\dash\notif::ok(T_("Category successfully added"));
		\lib\store::refresh();

		return true;

	}

	public static function remove_old_cat($_old_cat)
	{
		$json = \lib\store::detail('cat');
		if(is_string($json))
		{
			$json = json_decode($json, true);
		}

		if(!is_array($json))
		{
			$json = [];
		}

		if(!isset($json[$_old_cat]))
		{
			\dash\notif::error(T_("Category not found in your store!"), 'cat');
			return false;
		}

		unset($json[$_old_cat]);

		$json = json_encode($json, JSON_UNESCAPED_UNICODE);
		\lib\db\stores::update(['cat' => $json], \lib\store::id());

		\dash\notif::warn(T_("Category successfully removed"));
		\lib\store::refresh();

		return true;

	}


	public static function update_cat($_old_cat, $_new_cat)
	{

		if($_old_cat == $_new_cat)
		{
			\dash\notif::info(T_("No change"));
			return true;
		}

		if(!$_new_cat)
		{
			\dash\notif::error(T_("Please fill the category"));
			return true;
		}

		$json = \lib\store::detail('cat');
		if(is_string($json))
		{
			$json = json_decode($json, true);
		}

		if(!is_array($json))
		{
			$json = [];
		}

		if(!isset($json[$_old_cat]))
		{
			\dash\notif::error(T_("Category not found in your store!"), 'cat');
			return false;
		}

		if(!isset($json[$_old_cat]))
		{
			\dash\notif::error(T_("Category not found in your store!"), 'cat');
			return false;
		}

		unset($json[$_old_cat]);

		$json[$_new_cat] = ['title' => $_new_cat];

		$json = json_encode($json, JSON_UNESCAPED_UNICODE);
		\lib\db\stores::update(['cat' => $json], \lib\store::id());

		// update products
		$count = \lib\db\products::get_count(['store_id' => \lib\store::id(), 'cat' => $_old_cat]);
		if($count)
		{
			\lib\db\products::update_where(['store_id' => \lib\store::id(), 'cat' => $_new_cat], ['cat' => $_old_cat]);
		}

		\dash\notif::ok(T_("All product by category :old updated to :new", ['old' => $_old_cat, 'new' => $_new_cat]));

		\lib\store::refresh();

		return true;

	}


	public static function cat_list_count()
	{
		$cat_list_count = \lib\db\products::field_group_count('cat', \lib\store::id());

		$json = \lib\store::detail('cat');
		if(is_string($json))
		{
			$json = json_decode($json, true);
		}

		if(!is_array($json))
		{
			$json = [];
		}

		$result = [];

		foreach ($cat_list_count as $key => $value)
		{
			if(isset($json[$key]))
			{
				$result[$key] = array_merge($json[$key], ['count' => $value]);
			}
			else
			{
				$result[$key] = array_merge(['title' => $key], ['count' => $value]);
			}
		}

		foreach ($json as $key => $value)
		{
			if(!isset($result[$key]))
			{
				$result[$key] = $value;
			}
		}
		krsort($result);
		return $result;
	}


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	private static function check($_option = [])
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

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => \dash\app::request(),
			]
		];

		$title = null;
		if(\dash\app::isset_request('title'))
		{
			$title = \dash\app::request('title');
			$title = trim($title);
			if(!$title)
			{
				// \dash\app::log('api:product:title:not:set', \dash\user::id(), $log_meta);
				if($_option['debug']) \dash\notif::error(T_("Product title can not be null"), 'title');
				return false;
			}

			if(mb_strlen($title) >= 500)
			{
				// \dash\app::log('api:product:title:max:lenght', \dash\user::id(), $log_meta);
				if($_option['debug']) \dash\notif::error(T_("Product title must be less than 500 character"), 'title');
				return false;
			}
		}


		$name = \dash\app::request('name');
		$name = trim($name);
		if($name && mb_strlen($name) >= 500)
		{
			// \dash\app::log('api:product:name:max:lenght', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Product name must be less than 500 character"), 'name');
			return false;
		}

		$cat = \dash\app::request('cat');
		$cat = trim($cat);
		if($cat && mb_strlen($cat) >= 200)
		{
			// \dash\app::log('api:product:cat:max:lenght', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Product cat must be less than 200 character"), 'cat');
			return false;
		}


		// $slug = \dash\app::request('slug');
		$slug = \dash\utility\filter::slug($title, null, 'persian');
		$slug = substr($slug, 0, 199);


		$company = \dash\app::request('company');
		$company = trim($company);
		if($company && mb_strlen($company) >= 200)
		{
			// \dash\app::log('api:product:company:max:lenght', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("String of product company is too large"), 'company');
			return false;
		}

		// the short code
		// $shotcode = null;
		// $shortcode = \dash\utility\convert::to_en_number($shortcode);
		// if(!is_numeric($shortcode))
		// {
		// 	// \dash\app::log('api:product:company:not:numberic', \dash\user::id(), $log_meta);
		// 	if($_option['debug']) \dash\notif::error(T_("Shortcode must be a number"), 'shortcode');
		// 	return false;
		// }

		// if(floatval($shortcode) > 1E+10 || floatval($shortcode) < 0)
		// {
		// 	// \dash\app::log('api:product:shortcode:max:lenght', \dash\user::id(), $log_meta);
		// 	if($_option['debug']) \dash\notif::error(T_("Value of shortcode is out of rage"), 'shortcode');
		// 	return false;
		// }

		$unit = \dash\app::request('unit');
		$unit = trim($unit);
		if($unit && mb_strlen($unit) >= 100)
		{
			// \dash\app::log('api:product:unit:max:lenght', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("String of product unit is too large"), 'unit');
			return false;
		}

		$barcode = \dash\app::request('barcode');
		$barcode = trim($barcode);

		$to_barcode = \dash\utility\convert::to_barcode($barcode);
		if($barcode != $to_barcode)
		{
			// \dash\app::log('barcode:is:different:barcode2', \dash\user::id(), // \dash\app::log_meta(1, ['barcode' => $barcode, 'fixed' => $to_barcode]));
			\dash\notif::warn(T_("Your barcode have wrong character. we change it. please check your product again"), 'barcode');
			$barcode = $to_barcode;
		}

		if($barcode && mb_strlen($barcode) >= 100)
		{
			// \dash\app::log('api:product:barcode:max:lenght', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("String of product barcode is too large"), 'barcode');
			return false;
		}

		$barcode2 = \dash\app::request('barcode2');
		$barcode2 = trim($barcode2);

		$to_barcode2 = \dash\utility\convert::to_barcode($barcode2);
		if($barcode2 != $to_barcode2)
		{
			\dash\app::log('barcode2:is:different:barcode2', \dash\user::id(), \dash\app::log_meta(1, ['barcode2' => $barcode2, 'fixed' => $to_barcode2]));
			\dash\notif::warn(T_("Your barcode2 have wrong character. we change it. please check your product again"), 'barcode2');
			$barcode2 = $to_barcode2;
		}

		if($barcode2 && mb_strlen($barcode2) >= 100)
		{
			// \dash\app::log('api:product:barcode2:max:lenght', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("String of product barcode2 is too large"), 'barcode2');
			return false;
		}

		if($barcode && $barcode2 && $barcode == $barcode2)
		{
			// \dash\app::log('app:product:barcode:in:one:product:add', \dash\user::id(), $log_meta);
			\dash\notif::error(T_("Duplicate barcode in one product"), 'barcode2');
			return false;
		}

		if($barcode)
		{
			self::check_unique_barcode($barcode, $_option);
			if(!\dash\engine\process::status())
			{
				return false;
			}
		}

		if($barcode2)
		{
			self::check_unique_barcode($barcode2, $_option);
			if(!\dash\engine\process::status())
			{
				return false;
			}
		}

		$code = \dash\app::request('code');
		$code = trim($code);
		if($code && mb_strlen($code) >= 200)
		{
			// \dash\app::log('api:product:code:max:lenght', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("String of product code is too large"), 'code');
			return false;
		}

		$buyprice = \dash\app::request('buyprice');
		$buyprice = \dash\utility\convert::to_en_number($buyprice);
		if($buyprice && !is_numeric($buyprice))
		{
			// \dash\app::log('api:product:buyprice:is:nan', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Value of buyprice muset be a number"), 'buyprice');
			return false;
		}

		if(floatval($buyprice) >= 1E+20 || floatval($buyprice) < 0)
		{
			// \dash\app::log('api:product:buyprice:max:lenght', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Value of buyprice is out of rage"), 'buyprice');
			return false;
		}

		$price = \dash\app::request('price');
		$price = \dash\utility\convert::to_en_number($price);
		if($price && !is_numeric($price))
		{
			// \dash\app::log('api:product:price:is:nan', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Value of price muset be a number"), 'price');
			return false;
		}

		if(floatval($price) >= 1E+20 || floatval($price) < 0)
		{
			// \dash\app::log('api:product:price:max:lenght', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Value of price is out of rage"), 'price');
			return false;
		}

		$discount = \dash\app::request('discount');
		$discount = \dash\utility\convert::to_en_number($discount);
		if($discount && !is_numeric($discount))
		{
			// \dash\app::log('api:product:discount:is:nan', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Value of discount muset be a number"), 'discount');
			return false;
		}

		if($discount && abs(floatval($discount)) >= 1E+10)
		{
			// \dash\app::log('api:product:discount:max:lenght', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Value of discount is out of rage"), 'discount');
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
			// \dash\app::log('api:product:initialbalance:is:nan', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Value of initialbalance muset be a number"), 'initialbalance');
			return false;
		}

		if(floatval($initialbalance) >= 1E+10 || floatval($initialbalance) < 0)
		{
			// \dash\app::log('api:product:initialbalance:max:lenght', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Value of initialbalance is out of rage"), 'initialbalance');
			return false;
		}

		$minstock = \dash\app::request('minstock');
		$minstock = \dash\utility\convert::to_en_number($minstock);
		if($minstock && !is_numeric($minstock))
		{
			// \dash\app::log('api:product:minstock:is:nan', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Value of minstock muset be a number"), 'minstock');
			return false;
		}

		if(floatval($minstock) >= 1E+10 || floatval($minstock) < 0)
		{
			// \dash\app::log('api:product:minstock:max:lenght', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Value of minstock is out of rage"), 'minstock');
			return false;
		}

		$maxstock = \dash\app::request('maxstock');
		$maxstock = \dash\utility\convert::to_en_number($maxstock);
		if($maxstock && !is_numeric($maxstock))
		{
			// \dash\app::log('api:product:maxstock:is:nan', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Value of maxstock muset be a number"), 'maxstock');
			return false;
		}

		if(floatval($maxstock) >= 1E+10 || floatval($maxstock) < 0)
		{
			// \dash\app::log('api:product:maxstock:max:lenght', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Value of maxstock is out of rage"), 'maxstock');
			return false;
		}

		$status = \dash\app::request('status');
		$status  = trim(mb_strtolower($status));

		if($status && !in_array($status, ['unset','available','unavailable','soon','discountinued']))
		{
			// \dash\app::log('api:product:status:invalid', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Product status is incorrect"), 'status');
			return false;
		}

		// $sold = \dash\app::request('sold');
		// if(floatval($sold) >= 1E+20 || floatval($sold) < 0)
		// {
		// 	// \dash\app::log('api:product:sold:max:lenght', \dash\user::id(), $log_meta);
		// 	if($_option['debug']) \dash\notif::error(T_("Value of sold is out of rage"), 'sold');
		// 	return false;
		// }

		$stock = \dash\app::request('stock');
		$stock = \dash\utility\convert::to_en_number($stock);
		if($stock && !is_numeric($stock))
		{
			// \dash\app::log('api:product:stock:is:nan', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Value of stock muset be a number"), 'stock');
			return false;
		}

		if(abs(floatval($stock)) >= 1E+20)
		{
			// \dash\app::log('api:product:stock:max:lenght', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Value of stock is out of rage"), 'stock');
			return false;
		}

		$thumb = \dash\app::request('thumb');
		if($thumb && !is_string($thumb))
		{
			// \dash\app::log('api:product:thumb:is:not:string', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Value of thumb is out of rage"), 'thumb');
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
			// \dash\app::log('api:product:carton:is:nan', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Value of carton muset be a number"), 'carton');
			return false;
		}

		if(floatval($carton) >= 1E+10 || floatval($carton) < 0)
		{
			// \dash\app::log('api:product:carton:max:lenght', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Value of carton is out of rage"), 'carton');
			return false;
		}

		$desc = \dash\app::request('desc');
		$desc = trim($desc);
		if($desc && mb_strlen($desc))
		{
			// \dash\app::log('api:product:desc:max:lenght', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Value of desc is out of rage"), 'desc');
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


		$args                    = [];
		$args['title']           = $title;
		$args['name']            = $name;
		$args['cat']             = $cat;
		$args['slug']            = $slug;
		$args['company']         = $company;
		// $args['shortcode']    = $shortcode;
		$args['unit']            = $unit;
		$args['barcode']         = $barcode;
		$args['barcode2']        = $barcode2;
		$args['code']            = $code;
		$args['buyprice']        = $buyprice;
		$args['price']           = $price;
		$args['discount']        = $discount;
		$args['discountpercent'] = $discountpercent;
		$args['vat']             = $vat;
		$args['initialbalance']  = $initialbalance;
		$args['minstock']        = $minstock;
		$args['maxstock']        = $maxstock;
		$args['status']          = $status;
		// $args['sold']         = $sold;
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
					if($value)
					{
						$result[$key] = $value;
					}
					else
					{
						$result[$key] = \dash\app::static_image_url();
					}
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