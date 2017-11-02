<?php
namespace lib\app;
use \lib\utility;
use \lib\debug;

/**
 * Class for product.
 */
class product
{

	use product\add;
	use product\edit;
	use product\datalist;
	use product\get;
	use product\buyprice;
	use product\import;
	use product\delete;
	use product\barcode;


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
				'input' => \lib\app::request(),
			]
		];

		$title = null;
		if(\lib\app::isset_request('title'))
		{
			$title = \lib\app::request('title');
			$title = trim($title);
			if(!$title)
			{
				\lib\app::log('api:product:title:not:set', \lib\user::id(), $log_meta);
				if($_option['debug']) debug::error(T_("Product title can not be null"), 'title');
				return false;
			}

			if(mb_strlen($title) >= 500)
			{
				\lib\app::log('api:product:title:max:lenght', \lib\user::id(), $log_meta);
				if($_option['debug']) debug::error(T_("Product title must be less than 500 character"), 'title');
				return false;
			}
		}


		$name = \lib\app::request('name');
		$name = trim($name);
		if($name && mb_strlen($name) >= 500)
		{
			\lib\app::log('api:product:name:max:lenght', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Product name must be less than 500 character"), 'name');
			return false;
		}

		$cat = \lib\app::request('cat');
		$cat = trim($cat);
		if($cat && mb_strlen($cat) >= 200)
		{
			\lib\app::log('api:product:cat:max:lenght', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Product cat must be less than 200 character"), 'cat');
			return false;
		}


		// $slug = \lib\app::request('slug');
		$slug = \lib\utility\filter::slug($title, null, 'persian');
		$slug = substr($slug, 0, 199);


		$company = \lib\app::request('company');
		$company = trim($company);
		if($company && mb_strlen($company) >= 200)
		{
			\lib\app::log('api:product:company:max:lenght', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("String of product company is too large"), 'company');
			return false;
		}

		// the short code
		// $shortcode = null;
		// if(!is_numeric($shortcode))
		// {
		// 	\lib\app::log('api:product:company:not:numberic', \lib\user::id(), $log_meta);
		// 	if($_option['debug']) debug::error(T_("Shortcode must be a number"), 'shortcode');
		// 	return false;
		// }

		// if(floatval($shortcode) > 1E+10 || floatval($shortcode) < 0)
		// {
		// 	\lib\app::log('api:product:shortcode:max:lenght', \lib\user::id(), $log_meta);
		// 	if($_option['debug']) debug::error(T_("Value of shortcode is out of rage"), 'shortcode');
		// 	return false;
		// }

		$unit = \lib\app::request('unit');
		$unit = trim($unit);
		if($unit && mb_strlen($unit) >= 100)
		{
			\lib\app::log('api:product:unit:max:lenght', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("String of product unit is too large"), 'unit');
			return false;
		}

		$barcode = \lib\app::request('barcode');
		$barcode = trim($barcode);

		if($barcode)
		{
			self::check_unique_barcode($barcode, $_option);
			if(!\lib\debug::$status)
			{
				return false;
			}
		}

		if($barcode && mb_strlen($barcode) >= 100)
		{
			\lib\app::log('api:product:barcode:max:lenght', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("String of product barcode is too large"), 'barcode');
			return false;
		}

		$barcode2 = \lib\app::request('barcode2');
		$barcode2 = trim($barcode2);

		if($barcode2)
		{
			self::check_unique_barcode($barcode2, $_option);
			if(!\lib\debug::$status)
			{
				return false;
			}
		}


		if($barcode2 && mb_strlen($barcode2) >= 100)
		{
			\lib\app::log('api:product:barcode2:max:lenght', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("String of product barcode2 is too large"), 'barcode2');
			return false;
		}

		$code = \lib\app::request('code');
		$code = trim($code);
		if($code && mb_strlen($code) >= 200)
		{
			\lib\app::log('api:product:code:max:lenght', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("String of product code is too large"), 'code');
			return false;
		}

		$buyprice = \lib\app::request('buyprice');
		if($buyprice && !is_numeric($buyprice))
		{
			\lib\app::log('api:product:buyprice:is:nan', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Value of buyprice muset be a number"), 'buyprice');
			return false;
		}

		if(floatval($buyprice) >= 1E+20 || floatval($buyprice) < 0)
		{
			\lib\app::log('api:product:buyprice:max:lenght', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Value of buyprice is out of rage"), 'buyprice');
			return false;
		}

		$price = \lib\app::request('price');
		if($price && !is_numeric($price))
		{
			\lib\app::log('api:product:price:is:nan', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Value of price muset be a number"), 'price');
			return false;
		}

		if(floatval($price) >= 1E+20 || floatval($price) < 0)
		{
			\lib\app::log('api:product:price:max:lenght', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Value of price is out of rage"), 'price');
			return false;
		}

		$discount = \lib\app::request('discount');

		if($discount && !is_numeric($discount))
		{
			\lib\app::log('api:product:discount:is:nan', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Value of discount muset be a number"), 'discount');
			return false;
		}

		if($discount && abs(floatval($discount)) >= 1E+10)
		{
			\lib\app::log('api:product:discount:max:lenght', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Value of discount is out of rage"), 'discount');
			return false;
		}


		$discountpercent = null;
		if($discount && $price && intval($price) !== 0)
		{
			$discountpercent = round((floatval($discount) * 100) / floatval($price), 3);
		}


		$initialbalance = \lib\app::request('initialbalance');

		if($initialbalance && !is_numeric($initialbalance))
		{
			\lib\app::log('api:product:initialbalance:is:nan', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Value of initialbalance muset be a number"), 'initialbalance');
			return false;
		}

		if(floatval($initialbalance) >= 1E+10 || floatval($initialbalance) < 0)
		{
			\lib\app::log('api:product:initialbalance:max:lenght', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Value of initialbalance is out of rage"), 'initialbalance');
			return false;
		}

		$minstock = \lib\app::request('minstock');

		if($minstock && !is_numeric($minstock))
		{
			\lib\app::log('api:product:minstock:is:nan', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Value of minstock muset be a number"), 'minstock');
			return false;
		}

		if(floatval($minstock) >= 1E+10 || floatval($minstock) < 0)
		{
			\lib\app::log('api:product:minstock:max:lenght', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Value of minstock is out of rage"), 'minstock');
			return false;
		}

		$maxstock = \lib\app::request('maxstock');

		if($maxstock && !is_numeric($maxstock))
		{
			\lib\app::log('api:product:maxstock:is:nan', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Value of maxstock muset be a number"), 'maxstock');
			return false;
		}

		if(floatval($maxstock) >= 1E+10 || floatval($maxstock) < 0)
		{
			\lib\app::log('api:product:maxstock:max:lenght', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Value of maxstock is out of rage"), 'maxstock');
			return false;
		}

		$status = \lib\app::request('status');
		$status  = trim(mb_strtolower($status));

		if($status && !in_array($status, ['unset','available','unavailable','soon','discountinued']))
		{
			\lib\app::log('api:product:status:invalid', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Product status is incorrect"), 'status');
			return false;
		}

		// $sold = \lib\app::request('sold');
		// if(floatval($sold) >= 1E+20 || floatval($sold) < 0)
		// {
		// 	\lib\app::log('api:product:sold:max:lenght', \lib\user::id(), $log_meta);
		// 	if($_option['debug']) debug::error(T_("Value of sold is out of rage"), 'sold');
		// 	return false;
		// }

		$stock = \lib\app::request('stock');

		if($stock && !is_numeric($stock))
		{
			\lib\app::log('api:product:stock:is:nan', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Value of stock muset be a number"), 'stock');
			return false;
		}

		if(floatval($stock) >= 1E+20 || floatval($stock) < 0)
		{
			\lib\app::log('api:product:stock:max:lenght', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Value of stock is out of rage"), 'stock');
			return false;
		}

		$thumb = \lib\app::request('thumb');
		if($thumb && !is_string($thumb))
		{
			\lib\app::log('api:product:thumb:is:not:string', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Value of thumb is out of rage"), 'thumb');
			return false;
		}

		$vat = null;
		if(\lib\app::isset_request('vat'))
		{
			$vat = \lib\app::request('vat');
			$vat = $vat ? 1 : 0;
		}

		$service = null;
		if(\lib\app::isset_request('service'))
		{
			$service    = \lib\app::request('service');
			$service    = $service ? 1 : 0;
		}


		$checkstock = null;
		if(\lib\app::isset_request('checkstock'))
		{
			$checkstock = \lib\app::request('checkstock');
			$checkstock = $checkstock ? 1 : 0;
		}

		$sellonline = null;
		if(\lib\app::isset_request('sellonline'))
		{
			$sellonline = \lib\app::request('sellonline');
			$sellonline = $sellonline ? 1 : 0;
		}


		$sellstore = null;
		if(\lib\app::isset_request('sellstore'))
		{
			$sellstore  = \lib\app::request('sellstore');
			$sellstore  = $sellstore ? 1 : 0;
		}


		$carton     = \lib\app::request('carton');

		if($carton && !is_numeric($carton))
		{
			\lib\app::log('api:product:carton:is:nan', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Value of carton muset be a number"), 'carton');
			return false;
		}

		if(floatval($carton) >= 1E+10 || floatval($carton) < 0)
		{
			\lib\app::log('api:product:carton:max:lenght', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Value of carton is out of rage"), 'carton');
			return false;
		}

		$desc = \lib\app::request('desc');
		$desc = trim($desc);
		if($desc && mb_strlen($desc))
		{
			\lib\app::log('api:product:desc:max:lenght', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Value of desc is out of rage"), 'desc');
			return false;
		}

		$args                    = [];
		$args['title']           = $title;
		$args['name']            = $name;
		$args['cat']             = $cat;
		$args['slug']            = $slug;
		$args['company']         = $company;
		// $args['shortcode']    = $shortcode;
		$args['unit']            = $unit;
		$args['barcode']         = "(SELECT '$barcode')";
		$args['barcode2']        = "(SELECT '$barcode2')";
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
		$args['sellonline']      = $sellonline;
		$args['sellstore']       = $sellstore;
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
		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
				case 'creator':
				// case 'parent':
					if(isset($value))
					{
						$result[$key] = \lib\utility\shortURL::encode($value);
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
						$result[$key] = \lib\app::static_image_url();
					}
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