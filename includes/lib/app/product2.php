<?php
namespace lib\app;


class product2
{


	public static function check($_id = null, $_option = [])
	{
		$args                    = [];

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
				\dash\notif::error(T_("Please fill your product title"), 'title');
				return false;
			}

			if(mb_strlen($title) >= 500)
			{
				\dash\notif::error(T_("Product title must be less than 500 character"), 'title');
				return false;
			}
		}


		$slug = \dash\app::request('slug');
		if(!$slug)
		{
			$slug = \dash\utility\filter::slug($title, null, 'persian');
			$slug = substr($slug, 0, 199);
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
			$check_unique_barcode = \lib\app\product2\barcode::check_unique_barcode($barcode, $_id, \lib\store::id());
			if(!$check_unique_barcode || !\dash\engine\process::status())
			{
				return false;
			}
		}

		if($barcode2)
		{
			$check_unique_barcode = \lib\app\product2\barcode::check_unique_barcode($barcode2, $_id, \lib\store::id());
			if(!$check_unique_barcode || !\dash\engine\process::status())
			{
				return false;
			}
		}


		$buyprice = \dash\app::request('buyprice');
		$buyprice = \dash\utility\convert::to_en_number($buyprice);
		if($buyprice && !is_numeric($buyprice))
		{
			\dash\notif::error(T_("Value of buyprice muset be a number"), 'buyprice');
			return false;
		}

		if(\dash\utility\filter::max_number($buyprice, 999999999999999999))
		{
			\dash\notif::error(T_("Value of buyprice is out of rage"), 'buyprice');
			return false;
		}

		if(intval($buyprice) < 0)
		{
			\dash\notif::error(T_("Value of buyprice is out of rage"), 'buyprice');
			return false;
		}

		$store_max_buyprice = \lib\store::setting('maxbuyprice');
		if($buyprice && $store_max_buyprice && intval($buyprice) > intval($store_max_buyprice))
		{
			\dash\notif::error(T_("The maximum buyprice in your store is :val", ['val' => \dash\utility\human::fitNumber($store_max_buyprice)]), 'buyprice');
			return false;
		}

		$price = \dash\app::request('price');
		$price = \dash\utility\convert::to_en_number($price);
		if($price && !is_numeric($price))
		{
			\dash\notif::error(T_("Value of price muset be a number"), 'price');
			return false;
		}

		if(\dash\utility\filter::max_number($price, 999999999999999999))
		{
			\dash\notif::error(T_("Value of price is out of rage"), 'price');
			return false;
		}

		if(intval($price) < 0)
		{
			\dash\notif::error(T_("Value of price is out of rage"), 'price');
			return false;
		}

		$store_max_price = \lib\store::setting('maxprice');
		if($price && $store_max_price && intval($price) > intval($store_max_price))
		{
			\dash\notif::error(T_("The maximum price in your store is :val", ['val' => \dash\utility\human::fitNumber($store_max_price)]), 'price');
			return false;
		}


		$discount = \dash\app::request('discount');
		$discount = \dash\utility\convert::to_en_number($discount);
		if($discount && !is_numeric($discount))
		{
			\dash\notif::error(T_("Value of discount muset be a number"), 'discount');
			return false;
		}

		if($discount && \dash\utility\filter::max_number($discount, 999999999999999999))
		{
			\dash\notif::error(T_("Value of discount is out of rage"), 'discount');
			return false;
		}

		if($discount && intval($discount) < 0)
		{
			\dash\notif::error(T_("Value of discount is out of rage"), 'discount');
			return false;
		}


		$discountpercent = null;
		if($discount && $price && intval($price) !== 0)
		{
			$discountpercent = round((intval($discount) * 100) / intval($price), 3);
		}

		$store_max_discount = \lib\store::setting('maxdiscount');
		if($discountpercent && $store_max_discount && intval($discountpercent) > intval($store_max_discount))
		{
			\dash\notif::error(T_("The maximum discount in your store is :val", ['val' => \dash\utility\human::fitNumber($store_max_discount)]), 'discount');
			return false;
		}


		$minstock = \dash\app::request('minstock');
		$minstock = \dash\utility\convert::to_en_number($minstock);
		if($minstock && !is_numeric($minstock))
		{
			\dash\notif::error(T_("Value of minstock muset be a number"), 'minstock');
			return false;
		}

		if(\dash\utility\filter::max_number($minstock, 999999999))
		{
			\dash\notif::error(T_("Value of minstock is out of rage"), 'minstock');
			return false;
		}

		if(intval($minstock) < 0)
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

		if(\dash\utility\filter::max_number($maxstock, 999999999))
		{
			\dash\notif::error(T_("Value of maxstock is out of rage"), 'maxstock');
			return false;
		}

		if(intval($maxstock) < 0)
		{
			\dash\notif::error(T_("Value of maxstock is out of rage"), 'maxstock');
			return false;
		}


		$weight = \dash\app::request('weight');
		$weight = \dash\utility\convert::to_en_number($weight);
		if($weight && !is_numeric($weight))
		{
			\dash\notif::error(T_("Value of weight muset be a number"), 'weight');
			return false;
		}

		if(\dash\utility\filter::max_number($weight, 999999999))
		{
			\dash\notif::error(T_("Value of weight is out of rage"), 'weight');
			return false;
		}

		if(intval($weight) < 0)
		{
			\dash\notif::error(T_("Value of weight is out of rage"), 'weight');
			return false;
		}



		$status = \dash\app::request('status');
		if($status && !in_array($status, ['unset','available','unavailable','soon','discountinued']))
		{
			\dash\notif::error(T_("Product status is incorrect"), 'status');
			return false;
		}


		$thumb = \dash\app::request('thumb');
		// app must be upload or not ???


		$vat = null;
		if(\dash\app::isset_request('vat'))
		{
			$vat = \dash\app::request('vat');
			$vat = $vat ? 'yes' : null;
		}


		$saleonline = null;
		if(\dash\app::isset_request('saleonline'))
		{
			$saleonline = \dash\app::request('saleonline');
			$saleonline = $saleonline ? null : 'no';
		}


		$carton = \dash\app::request('carton');
		$carton = \dash\utility\convert::to_en_number($carton);
		if($carton && !is_numeric($carton))
		{
			\dash\notif::error(T_("Value of carton muset be a number"), 'carton');
			return false;
		}

		if(\dash\utility\filter::max_number($carton, 999999999))
		{
			\dash\notif::error(T_("Value of carton is out of rage"), 'carton');
			return false;
		}

		if(intval($carton) < 0)
		{
			\dash\notif::error(T_("Value of carton is out of rage"), 'carton');
			return false;
		}

		$desc = \dash\app::request('desc');
		if($desc && mb_strlen($desc) > 9999)
		{
			\dash\notif::error(T_("Value of desc is out of rage"), 'desc');
			return false;
		}


		$saletelegram = \dash\app::request('saletelegram') ? null : 'no';
		$saleapp      = \dash\app::request('saleapp') ? null : 'no';
		$infinite     = \dash\app::request('infinite') ? 'yes' : null;

		// @check parent
		$parent = \dash\app::request('parent');


		$scalecode = \dash\app::request('scalecode');
		if($scalecode)
		{
			$scalecode = \dash\utility\convert::to_en_number($scalecode);
			if(!is_numeric($scalecode))
			{
				\dash\notif::error(T_("Plase set scale code as a number"), 'scalecode');
				return false;
			}

			if(\dash\utility\filter::max_number($scalecode, 999999999))
			{
				\dash\notif::error(T_("Please enter the scale code as a five digit number"), 'scalecode');
				return false;
			}

			if(intval($scalecode) < 0)
			{
				\dash\notif::error(T_("Please enter the scale code as a five digit number"), 'scalecode');
				return false;
			}

			$scalecode = intval($scalecode);

		}


		$optionname1  = \dash\app::request('optionname1');
		if($optionname1 && mb_strlen($optionname1) > 100)
		{
			\dash\notif::error(T_("optionname1 is out of range"), 'optionname1');
			return false;
		}

		$optionvalue1 = \dash\app::request('optionvalue1');
		if($optionvalue1 && mb_strlen($optionvalue1) > 100)
		{
			\dash\notif::error(T_("optionvalue1 is out of range"), 'optionvalue1');
			return false;
		}

		$optionname2  = \dash\app::request('optionname2');
		if($optionname2 && mb_strlen($optionname2) > 100)
		{
			\dash\notif::error(T_("optionname2 is out of range"), 'optionname2');
			return false;
		}

		$optionvalue2 = \dash\app::request('optionvalue2');
		if($optionvalue2 && mb_strlen($optionvalue2) > 100)
		{
			\dash\notif::error(T_("optionvalue2 is out of range"), 'optionvalue2');
			return false;
		}

		$optionname3  = \dash\app::request('optionname3');
		if($optionname3 && mb_strlen($optionname3) > 100)
		{
			\dash\notif::error(T_("optionname3 is out of range"), 'optionname3');
			return false;
		}

		$optionvalue3 = \dash\app::request('optionvalue3');
		if($optionvalue3 && mb_strlen($optionvalue3) > 100)
		{
			\dash\notif::error(T_("optionvalue3 is out of range"), 'optionvalue3');
			return false;
		}

		$sku          = \dash\app::request('sku');
		if($sku && mb_strlen($sku) > 20)
		{
			\dash\notif::error(T_("sku is out of range"), 'sku');
			return false;
		}



		$master_args = \dash\app::request();
		// check to add new cat or unit
		if($cat)
		{
			\lib\app\product\cat::$debug = false;
			$add_cat = \lib\app\product\cat::check_add($cat);

			if(isset($add_cat['id_raw']))
			{
				$args['cat_id'] = $add_cat['id_raw'];
			}

			if(isset($add_cat['title']))
			{
				$args['cat'] = $add_cat['title'];
			}
		}

		if($unit)
		{
			\lib\app\product\unit::$debug = false;
			$add_unit                     = \lib\app\product\unit::check_add($unit);
			if(isset($add_unit['id']))
			{
				$args['unit_id'] = $add_unit['id'];
			}

			if(isset($add_unit['title']))
			{
				$args['unit'] = $add_unit['title'];
			}
		}

		if($company)
		{
			\lib\app\product\company::$debug = false;
			$add_company                     = \lib\app\product\company::check_add($company);
			if(isset($add_company['id']))
			{
				$args['company_id'] = $add_company['id'];
			}

			if(isset($add_company['title']))
			{
				$args['company'] = $add_company['title'];
			}
		}




		\dash\app::request_set($master_args);

		$args['title']           = $title;
		$args['slug']            = $slug;
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
		// $args['checkstock']   = $checkstock;
		$args['parent']          = $parent;
		$args['saleonline']      = $saleonline;
		$args['salestore']       = $salestore;
		$args['carton']          = $carton;
		$args['desc']            = $desc;
		$args['scalecode']       = $scalecode;
		$args['salesite']        = $salesite;
		$args['saletelegram']    = $saletelegram;
		$args['saleapp']         = $saleapp;
		$args['salephysical']    = $salephysical;
		$args['weight']          = $weight;
		$args['infinite']        = $infinite;

		$args['optionname1']     = $optionname1;
		$args['optionvalue1']    = $optionvalue1;
		$args['optionname2']     = $optionname2;
		$args['optionvalue2']    = $optionvalue2;
		$args['optionname3']     = $optionname3;
		$args['optionvalue3']    = $optionvalue3;
		$args['sku']             = $sku;


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
				case 'cat_id':
				case 'unit_id':
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