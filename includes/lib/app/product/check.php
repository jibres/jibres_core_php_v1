<?php
namespace lib\app\product;


class check
{

	public static function variable_args()
	{
		$variable_args =
		[
			'raw_field' => ['desc'],
		];
		return $variable_args;
	}



	public static function variable($_id = null, $_option = [])
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
			if(!$title && $title !== '0')
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
		}

		if($slug)
		{
			$slug = \dash\utility\filter::slug($slug, null, 'persian');
			$slug = substr($slug, 0, 199);
		}


		$barcode = \dash\app::request('barcode');
		$to_barcode = \dash\utility\convert::to_barcode($barcode);
		if($barcode != $to_barcode)
		{
			\dash\log::set('barcode:is:different:barcode', ['barcode' => $barcode, 'fixed' => $to_barcode]);
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
			\dash\log::set('barcode2:is:different:barcode2', ['barcode2' => $barcode2, 'fixed' => $to_barcode2]);
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
			$check_unique_barcode = self::check_unique_barcode($barcode, $_id);
			if(!$check_unique_barcode || !\dash\engine\process::status())
			{
				return false;
			}
		}

		if($barcode2)
		{
			$check_unique_barcode = self::check_unique_barcode($barcode2, $_id);
			if(!$check_unique_barcode || !\dash\engine\process::status())
			{
				return false;
			}
		}


		$minstock = \dash\app::request('minstock');
		$minstock = \dash\utility\convert::to_en_number($minstock);
		if($minstock && !is_numeric($minstock))
		{
			\dash\notif::error(T_("Value of minstock must be a number"), 'minstock');
			return false;
		}

		if(\dash\utility\filter::is_larger($minstock, 999999999))
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
			\dash\notif::error(T_("Value of maxstock must be a number"), 'maxstock');
			return false;
		}

		if(\dash\utility\filter::is_larger($maxstock, 999999999))
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
			\dash\notif::error(T_("Value of weight must be a number"), 'weight');
			return false;
		}

		if(\dash\utility\filter::is_larger($weight, 999999999))
		{
			\dash\notif::error(T_("Value of weight is out of rage"), 'weight');
			return false;
		}

		if(intval($weight) < 0)
		{
			\dash\notif::error(T_("Value of weight is out of rage"), 'weight');
			return false;
		}

		$weightunit = \dash\app::request('weightunit');
		if($weightunit && !in_array($weightunit, ['lb','oz','kg','g']))
		{
			\dash\notif::error(T_("Invalid weight unit"), 'weightunit');
			return false;
		}


		$status = \dash\app::request('status');
		if($status && !in_array($status, ['unset','available','unavailable','soon','discountinued', 'deleted']))
		{
			\dash\notif::error(T_("Product status is incorrect"), 'status');
			return false;
		}

		$type = \dash\app::request('type');
		if($type && !in_array($type, ['product','file','service']))
		{
			\dash\notif::error(T_("Invalid type of product"), 'type');
			return false;
		}

		$thumbid = \dash\app::request('thumbid');
		if($thumbid)
		{
			$load_file_detail = \dash\app\file::get_inline($thumbid);
			if(!$load_file_detail || !isset($load_file_detail['id']))
			{
				return false;
			}

			$thumbid = $load_file_detail['id'];
		}
		$gallery = \dash\app::request('gallery');


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
			\dash\notif::error(T_("Value of carton must be a number"), 'carton');
			return false;
		}

		if(\dash\utility\filter::is_larger($carton, 999999999))
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
		if($desc && mb_strlen($desc) > 60000)
		{
			\dash\notif::error(T_("Value of desc is out of rage"), 'desc');
			return false;
		}

		$salestep = \dash\app::request('salestep');
		$salestep = \dash\utility\convert::to_en_number($salestep);
		if($salestep && !is_numeric($salestep))
		{
			\dash\notif::error(T_("Value of salestep must be a number"), 'salestep');
			return false;
		}

		if(\dash\utility\filter::is_larger($salestep, 999999999))
		{
			\dash\notif::error(T_("Value of salestep is out of rage"), 'salestep');
			return false;
		}

		if(intval($salestep) < 0)
		{
			\dash\notif::error(T_("Value of salestep is out of rage"), 'salestep');
			return false;
		}

		$minsale = \dash\app::request('minsale');
		$minsale = \dash\utility\convert::to_en_number($minsale);
		if($minsale && !is_numeric($minsale))
		{
			\dash\notif::error(T_("Value of minsale must be a number"), 'minsale');
			return false;
		}

		if(\dash\utility\filter::is_larger($minsale, 999999999))
		{
			\dash\notif::error(T_("Value of minsale is out of rage"), 'minsale');
			return false;
		}

		if(intval($minsale) < 0)
		{
			\dash\notif::error(T_("Value of minsale is out of rage"), 'minsale');
			return false;
		}

		$maxsale = \dash\app::request('maxsale');
		$maxsale = \dash\utility\convert::to_en_number($maxsale);
		if($maxsale && !is_numeric($maxsale))
		{
			\dash\notif::error(T_("Value of maxsale must be a number"), 'maxsale');
			return false;
		}

		if(\dash\utility\filter::is_larger($maxsale, 999999999))
		{
			\dash\notif::error(T_("Value of maxsale is out of rage"), 'maxsale');
			return false;
		}

		if(intval($maxsale) < 0)
		{
			\dash\notif::error(T_("Value of maxsale is out of rage"), 'maxsale');
			return false;
		}


		$oversale     = \dash\app::request('oversale') ? 'yes' : null;
		$saletelegram = \dash\app::request('saletelegram') ? null : 'no';
		$saleapp      = \dash\app::request('saleapp') ? null : 'no';
		$infinite     = \dash\app::request('infinite') ? 'yes' : null;


		$parent = \dash\app::request('parent');
		if($parent)
		{
			$parent_detail = \lib\app\product\get::inline_get($parent);
			if(!$parent_detail || !isset($parent_detail['id']))
			{
				\dash\notif::error(T_("Ivalid parent id"));
				return  false;
			}

			$parent = $parent_detail['id'];
		}


		$scalecode = \dash\app::request('scalecode');
		if($scalecode)
		{
			$scalecode = \dash\utility\convert::to_en_number($scalecode);
			if(!is_numeric($scalecode))
			{
				\dash\notif::error(T_("Plase set scale code as a number"), 'scalecode');
				return false;
			}

			if(\dash\utility\filter::is_larger($scalecode, 999999999))
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

		$sku = \dash\app::request('sku');
		if($sku)
		{
			$sku = self::check_sku($sku, $_id);
			if(!\dash\engine\process::status())
			{
				return false;
			}
		}

		$seotitle = \dash\app::request('seotitle');
		if($seotitle && mb_strlen($seotitle) >= 300)
		{
			\dash\notif::error(T_("Seo title is out of range"), 'seotitle');
			return false;
		}

		$seodesc = \dash\app::request('seodesc');
		if($seodesc && mb_strlen($seodesc) >= 500)
		{
			\dash\notif::error(T_("Seo description is out of range"), 'seodesc');
			return false;
		}

		$args                 = [];
		$args['title']        = $title;
		$args['slug']         = $slug;
		$args['barcode']      = (string) $barcode;
		$args['barcode2']     = (string) $barcode2;
		$args['minstock']     = $minstock;
		$args['maxstock']     = $maxstock;
		$args['weight']       = $weight;
		$args['status']       = $status;
		$args['thumbid']      = $thumbid;
		$args['vat']          = $vat;
		$args['saleonline']   = $saleonline;
		$args['carton']       = $carton;
		$args['desc']         = $desc;
		$args['saletelegram'] = $saletelegram;
		$args['saleapp']      = $saleapp;
		$args['infinite']     = $infinite;
		$args['parent']       = $parent;
		$args['scalecode']    = $scalecode;
		$args['optionname1']  = $optionname1;
		$args['optionvalue1'] = $optionvalue1;
		$args['optionname2']  = $optionname2;
		$args['optionvalue2'] = $optionvalue2;
		$args['optionname3']  = $optionname3;
		$args['optionvalue3'] = $optionvalue3;
		$args['sku']          = $sku;
		$args['seotitle']     = $seotitle;
		$args['seodesc']      = $seodesc;
		$args['salestep']     = $salestep;
		$args['minsale']      = $minsale;
		$args['maxsale']      = $maxsale;
		$args['weightunit']   = $weightunit;
		$args['type']         = $type;
		$args['gallery']      = $gallery;
		$args['oversale']     = $oversale;

		return $args;
	}



	private static function check_sku($_sku, $_id)
	{
		$_sku = \dash\utility\convert::to_en_number($_sku);

		$_sku = preg_replace("/\_{2,}/", "_", $_sku);
		$_sku = preg_replace("/\-{2,}/", "-", $_sku);

		if(mb_strlen($_sku) > 16)
		{
			\dash\notif::error(T_("Please set the sku less than 16 character"), 'sku');
			return false;
		}

		if(!preg_match("/^[A-Za-z0-9_\-]+$/", $_sku))
		{
			\dash\notif::error(T_("Only [A-Za-z0-9_-] can use in sku"), 'sku');
			return false;
		}

		$check_unique_sku = \lib\db\products\db::check_unique_sku($_sku);
		if(isset($check_unique_sku['id']))
		{
			if(intval($check_unique_sku['id']) === intval($_id))
			{
				// nothing
			}
			else
			{
				\dash\notif::error(T_("Duplicate sku code"), 'sku');
				return false;
			}
		}

		return $_sku;
	}


	private static function check_unique_barcode($_barcode, $_id)
	{

		$check_exist  = \lib\db\products\db::get_barcode($_barcode);

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
					if($_id && intval($_id) === intval($check_exist[0]['id']))
					{
						// update product by old barcode
						return true;
					}
					else
					{


						$product_title = '';
						if(isset($check_exist[0]['title']))
						{
							$product_title = $check_exist[0]['title'];
						}

						if(isset($check_exist[0]['barcode']) && $_barcode === $check_exist[0]['barcode'])
						{
							$msg = T_("This barcode used as barcode :title", ['title' => $product_title]);
						}

						if(isset($check_exist[0]['barcode2']) && $_barcode === $check_exist[0]['barcode2'])
						{
							$msg = T_("This barcode used as barcode2 :title", ['title' => $product_title]);
						}

						$product_code = null;
						if(isset($check_exist[0]['code']))
						{
							$product_code = $check_exist[0]['code'];
						}

						if($product_code)
						{
							$link = \dash\url::this(). '/edit?code='. $product_code;
							$msg = "<a href='$link'>". $msg. '</a>';
						}

						\dash\log::set('app:product:barcode:is:duplicate');
						\dash\notif::error($msg);
						return false;
					}
				}
				else
				{
					\dash\log::set('app:product:barcode:1:record:havenot:id:error');
					\dash\notif::error(T_("Undefined error was happend"));
					return false;
				}
			}
			else
			{
				\dash\log::set('more:than:2:product:save:by:one:barcode');
				\dash\notif::error(T_("More than 2 products saved by this barcode"));
				return false;
			}
		}
	}



	public static function price($_id = null, $_option = [])
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

		$buyprice = \dash\app::request('buyprice');
		$buyprice = \dash\utility\convert::to_en_number($buyprice);
		if($buyprice && !is_numeric($buyprice))
		{
			\dash\notif::error(T_("Value of buyprice must be a number"), 'buyprice');
			return false;
		}

		if(\dash\utility\filter::is_larger($buyprice, 999999999999999999))
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
			\dash\notif::error(T_("Value of price must be a number"), 'price');
			return false;
		}

		if(\dash\utility\filter::is_larger($price, 999999999999999999))
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
			\dash\notif::error(T_("Value of discount must be a number"), 'discount');
			return false;
		}

		if($discount && \dash\utility\filter::is_larger($discount, 999999999999999999))
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

		$args                    = [];
		$args['buyprice']        = $buyprice;
		$args['price']           = $price;
		$args['discount']        = $discount;
		$args['discountpercent'] = $discountpercent;

		return $args;
	}

}
?>