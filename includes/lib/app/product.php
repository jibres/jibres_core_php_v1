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


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	private static function check()
	{
		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => \lib\app::request(),
			]
		];

		$title = \lib\app::request('title');
		$title = trim($title);
		if(!$title)
		{
			\lib\app::log('api:product:title:not:set', \lib\user::id(), $log_meta);
			debug::error(T_("Product title can not be null"), 'title');
			return false;
		}

		if(mb_strlen($title) >= 500)
		{
			\lib\app::log('api:product:title:max:lenght', \lib\user::id(), $log_meta);
			debug::error(T_("Product title must be less than 500 character"), 'title');
			return false;
		}


		$name = \lib\app::request('name');
		$name = trim($name);
		if($name && mb_strlen($name) >= 500)
		{
			\lib\app::log('api:product:name:max:lenght', \lib\user::id(), $log_meta);
			debug::error(T_("Product name must be less than 500 character"), 'name');
			return false;
		}



		$name           = \lib\app::request('name');
		$slug           = \lib\app::request('slug');
		$company        = \lib\app::request('company');
		$shortcode      = \lib\app::request('shortcode');
		$unit           = \lib\app::request('unit');
		$barcode        = \lib\app::request('barcode');
		$barcode2       = \lib\app::request('barcode2');
		$code           = \lib\app::request('code');
		// $buyprice       = \lib\app::request('buyprice');
		// $price          = \lib\app::request('price');
		// $discount       = \lib\app::request('discount');
		$vat            = \lib\app::request('vat');
		$initialbalance = \lib\app::request('initialbalance');
		$minstock       = \lib\app::request('minstock');
		$maxstock       = \lib\app::request('maxstock');
		$status         = \lib\app::request('status');
		$sold           = \lib\app::request('sold');
		$stock          = \lib\app::request('stock');
		$thumb          = \lib\app::request('thumb');
		$service        = \lib\app::request('service');
		$checkstock     = \lib\app::request('checkstock');
		$sellonline     = \lib\app::request('sellonline');
		$sellstore      = \lib\app::request('sellstore');
		$carton         = \lib\app::request('carton');
		$desc           = \lib\app::request('desc');


		$name = trim($name);
		if(!$name)
		{
			\lib\app::log('api:product:name:not:set', \lib\user::id(), $log_meta);
			debug::error(T_("Product name of product can not be null"), 'name', 'arguments');
			return false;
		}

		if(mb_strlen($name) > 100)
		{
			\lib\app::log('api:product:maxlength:name', \lib\user::id(), $log_meta);
			debug::error(T_("Product name must be less than 100 character"), 'name', 'arguments');
			return false;
		}

		$title = \lib\app::request('title');
		$title = trim($title);
		if($title && mb_strlen($title) >= 100)
		{
			\lib\app::log('api:product:maxlength:title', \lib\user::id(), $log_meta);
			debug::error(T_("Product title must be less than 200 character"), 'title', 'arguments');
			return false;
		}

		// $slug = \lib\app::request('slug');
		// $slug = trim($slug);

		// if(!$slug && !$name)
		// {
		// 	\lib\app::log('api:product:slug:not:sert', \lib\user::id(), $log_meta);
		// 	debug::error(T_("slug of product can not be null"), 'slug', 'arguments');
		// 	return false;
		// }

		// // get slug of name in slug if the slug is not set
		// if(!$slug && $name)
		// {
		// 	$slug = \lib\utility\shortURL::encode((int) \lib\user::id() + (int) rand(10000,99999) * 10000);
		// 	// $slug = \lib\utility\filter::slug($name);
		// }

		// // remove - from slug
		// // if the name is persian and slug not set
		// // we change the slug as slug of name
		// // in the slug we have some '-' in return
		// $slug = str_replace('-', '', $slug);

		// if($slug && mb_strlen($slug) < 5)
		// {
		// 	\lib\app::log('api:product:minlength:slug', \lib\user::id(), $log_meta);
		// 	debug::error(T_("Product slug must be larger than 5 character"), 'slug', 'arguments');
		// 	return false;
		// }

		// if($slug && !preg_match("/^[A-Za-z0-9]+$/", $slug))
		// {
		// 	\lib\app::log('api:product:invalid:slug', \lib\user::id(), $log_meta);
		// 	debug::error(T_("Only [A-Za-z0-9] can use in product slug"), 'slug', 'arguments');
		// 	return false;
		// }

		// // check slug
		// if($slug && mb_strlen($slug) >= 50)
		// {
		// 	\lib\app::log('api:product:maxlength:slug', \lib\user::id(), $log_meta);
		// 	debug::error(T_("Product slug must be less than 500 character"), 'slug', 'arguments');
		// 	return false;
		// }

		// $desc = \lib\app::request('desc');
		// if($desc && mb_strlen($desc) > 200)
		// {
		// 	\lib\app::log('api:product:maxlength:desc', \lib\user::id(), $log_meta);
		// 	debug::error(T_("Product desc must be less than 200 character"), 'desc', 'arguments');
		// 	return false;
		// }

		// $logo_id  = null;
		// $logo_url = null;

		// $logo = \lib\app::request('logo');
		// if($logo)
		// {
		// 	$logo_id = \lib\utility\shortURL::decode($logo);
		// 	if($logo_id)
		// 	{
		// 		$logo_record = \lib\db\posts::is_attachment($logo_id);
		// 		if(!$logo_record)
		// 		{
		// 			$logo_id = null;
		// 		}
		// 		elseif(isset($logo_record['meta']['url']))
		// 		{
		// 			$logo_url = $logo_record['meta']['url'];
		// 		}
		// 	}
		// 	else
		// 	{
		// 		$logo_id = null;
		// 	}
		// }

		// $parent = null;

		// $parent = \lib\app::request('parent');
		// if($parent)
		// {
		// 	$parent = \lib\utility\shortURL::decode($parent);
		// }

		// if($parent)
		// {
		// 	// check this product and the parent product have one owner
		// 	$check_owner = \lib\db\products::get(['id' => $parent, 'creator' => \lib\user::id(), 'limit' => 1]);
		// 	if(is_array($check_owner) && !array_key_exists('parent', $check_owner))
		// 	{
		// 		\lib\app::log('api:product:parent:owner:not:match', \lib\user::id(), $log_meta);
		// 		debug::error(T_("The parent is not in your product"), 'parent', 'arguments');
		// 		return false;
		// 	}
		// }


		// $lang = \lib\app::request('language');
		// if($lang && (mb_strlen($lang) !== 2 || !utility\location\languages::check($lang)))
		// {
		// 	\lib\app::log('api:product:invalid:lang', \lib\user::id(), $log_meta);
		// 	debug::error(T_("Invalid language field"), 'language', 'arguments');
		// 	return false;
		// }

		// $country           = \lib\app::request('country');
		// if($country && mb_strlen($country) > 50)
		// {
		// 	\lib\app::log('api:product:add:country:max:lenght', \lib\user::id(), $log_meta);
		// 	debug::error(T_("You must set country less than 50 character", 'country', 'arguments'));
		// 	return false;
		// }

		// $province          = \lib\app::request('province');
		// if($province && mb_strlen($province) > 50)
		// {
		// 	\lib\app::log('api:product:add:province:max:lenght', \lib\user::id(), $log_meta);
		// 	debug::error(T_("You must set province less than 50 character", 'province', 'arguments'));
		// 	return false;
		// }

		// $city              = \lib\app::request('city');
		// if($city && mb_strlen($city) > 50)
		// {
		// 	\lib\app::log('api:product:add:city:max:lenght', \lib\user::id(), $log_meta);
		// 	debug::error(T_("You must set city less than 50 character", 'city', 'arguments'));
		// 	return false;
		// }

		// $tel               = \lib\app::request('tel');
		// if($tel && mb_strlen($tel) > 50)
		// {
		// 	\lib\app::log('api:product:add:tel:max:lenght', \lib\user::id(), $log_meta);
		// 	debug::error(T_("You must set tel less than 50 character", 'tel', 'arguments'));
		// 	return false;
		// }

		// $zipcode           = \lib\app::request('zipcode');
		// if($zipcode && mb_strlen($zipcode) > 50)
		// {
		// 	\lib\app::log('api:product:add:zipcode:max:lenght', \lib\user::id(), $log_meta);
		// 	debug::error(T_("You must set zipcode less than 50 character", 'zipcode', 'arguments'));
		// 	return false;
		// }

		// $status = \lib\app::request('status');
		// if($status && !in_array($status, ['enable', 'disable']))
		// {
		// 	\lib\app::log('api:product:add:status:invalid', \lib\user::id(), $log_meta);
		// 	debug::error(T_("Invalid status of products", 'status', 'arguments'));
		// 	return false;
		// }

		$args            = [];
		$args['name']    = $name;
		$args['title']   = $title;

		// $args['slug']     = $slug;
		// $args['desc']     = $desc;
		// $args['lang']     = $lang;
		// $args['logo']     = $logo_url;
		// $args['parent']   = $parent ? $parent : null;
		// $args['country']  = $country;
		// $args['province'] = $province;
		// $args['city']     = $city;
		// $args['phone']    = $tel;
		// $args['zipcode']  = $zipcode;

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
					$result['url'] = isset($value) ? Protocol. '://'. $value. '.jibres.'. Tld : null;
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
					$result[$key] = isset($value) ? (string) $value : null;
					break;
				case 'lang':
					$result['language'] = isset($value) ? (string) $value : null;
					break;

				case 'logo':
					if($value)
					{
						// $result['logo'] = self::host('file'). '/'. $value;
					}
					else
					{
						// $result['logo'] = self::host('siftal_image');
					}
					break;

				case 'createdate':
					$result[$key] = $value;
					$date_now = new \DateTime("now");
					$start    = new \DateTime($value);
					$result['day_use']    = $date_now->diff($start)->days;
					$result['day_use']++;
					break;

				case 'telegram_id':
					$result['telegram'] = $value ? true : false;
					break;

				case 'plan':
					$result[$key] = $value;
					break;
				default:
					continue;
					break;
			}
		}

		return $result;
	}

}
?>