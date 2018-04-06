<?php
namespace lib\app;


class store
{

	use \lib\app\store\add;
	use \lib\app\store\edit;
	use \lib\app\store\datalist;
	use \lib\app\store\get;
	use \lib\app\store\dashboard;

	public static $black_list_slug =
	[
		'ssl',			'www',
		'http',			'https',
		'jibres',		'ermile',
		'azvir',		'sarshomar',
		'tejarak',		'demo',
		'talambar',		'benefits',
		'pricing',		'help',
		'admin',		'enter',
		'about',		'social-responsibility',
		'social',		'terms',
		'privacy',		'changelog',
		'logo',			'contact',
		'api',			'branch',
		'team',			'member',
		'add',			'edit',
		'delete',		'user',
		'hours',		'report',
		'last',			'daily',
		'account',		'for',
		'files',		'static',
		'private',		'public',
		'dollar',
	];

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
				'input' => \dash\app::request(),
			]
		];

		$name = \dash\app::request('name');
		$name = trim($name);
		if(!$name)
		{
			// \dash\app::log('api:store:name:not:set', \lib\user::id(), $log_meta);
			\lib\notif::error(T_("Name of store can not be null"), 'name', 'arguments');
			return false;
		}

		if(mb_strlen($name) > 100)
		{
			// \dash\app::log('api:store:maxlength:name', \lib\user::id(), $log_meta);
			\lib\notif::error(T_("Store name must be less than 100 character"), 'name', 'arguments');
			return false;
		}

		$website = \dash\app::request('website');
		$website = trim($website);
		if($website && mb_strlen($website) >= 200)
		{
			// \dash\app::log('api:store:maxlength:website', \lib\user::id(), $log_meta);
			\lib\notif::error(T_("Store website must be less than 200 character"), 'website', 'arguments');
			return false;
		}

		$slug = \dash\app::request('slug');
		$slug = trim($slug);

		if(!$slug && !$name)
		{
			// \dash\app::log('api:store:slug:not:sert', \lib\user::id(), $log_meta);
			\lib\notif::error(T_("slug of store can not be null"), 'slug', 'arguments');
			return false;
		}

		// get slug of name in slug if the slug is not set
		if(!$slug && $name)
		{
			$slug = \dash\coding::encode((int) \lib\user::id() + (int) rand(10000,99999) * 10000);
			// $slug = \dash\utility\filter::slug($name);
		}

		// remove - from slug
		// if the name is persian and slug not set
		// we change the slug as slug of name
		// in the slug we have some '-' in return
		$slug = str_replace('-', '', $slug);

		if($slug && mb_strlen($slug) < 5)
		{
			// \dash\app::log('api:store:minlength:slug', \lib\user::id(), $log_meta);
			\lib\notif::error(T_("Store slug must be larger than 5 character"), 'slug', 'arguments');
			return false;
		}

		if($slug && !preg_match("/^[A-Za-z0-9]+$/", $slug))
		{
			// \dash\app::log('api:store:invalid:slug', \lib\user::id(), $log_meta);
			\lib\notif::error(T_("Only [A-Za-z0-9] can use in store slug"), 'slug', 'arguments');
			return false;
		}

		// check slug
		if($slug && mb_strlen($slug) >= 50)
		{
			// \dash\app::log('api:store:maxlength:slug', \lib\user::id(), $log_meta);
			\lib\notif::error(T_("Store slug must be less than 50 character"), 'slug', 'arguments');
			return false;
		}

		if($slug && in_array($slug, self::$black_list_slug))
		{
			\lib\notif::error(T_("You can not choose this slug"), 'slug', 'arguments');
			return false;
		}

		$desc = \dash\app::request('desc');
		if($desc && mb_strlen($desc) > 200)
		{
			// \dash\app::log('api:store:maxlength:desc', \lib\user::id(), $log_meta);
			\lib\notif::error(T_("Store desc must be less than 200 character"), 'desc', 'arguments');
			return false;
		}

		$phone = \dash\app::request('phone');
		if($phone && mb_strlen($phone) > 50)
		{
			// \dash\app::log('api:store:maxlength:phone', \lib\user::id(), $log_meta);
			\lib\notif::error(T_("Store phone must be less than 50 character"), 'phone', 'arguments');
			return false;
		}

		$mobile = \dash\app::request('mobile');
		if($mobile && mb_strlen($mobile) > 50)
		{
			// \dash\app::log('api:store:maxlength:mobile', \lib\user::id(), $log_meta);
			\lib\notif::error(T_("Store mobile must be less than 50 character"), 'mobile', 'arguments');
			return false;
		}

		$address = \dash\app::request('address');
		if($address && mb_strlen($address) > 1000)
		{
			// \dash\app::log('api:store:maxlength:address', \lib\user::id(), $log_meta);
			\lib\notif::error(T_("Store address must be less than 1000 character"), 'address', 'arguments');
			return false;
		}


		$logo_url = \dash\app::request('logo');
		if($logo_url && !is_string($logo_url))
		{
			// \dash\app::log('api:store:is:not:string:logo', \lib\user::id(), $log_meta);
			\lib\notif::error(T_("Invalid logo url fo store"), 'logo');
			return false;
		}

		$parent = null;

		$parent = \dash\app::request('parent');
		if($parent)
		{
			$parent = \dash\coding::decode($parent);
		}

		if($parent)
		{
			// check this store and the parent store have one owner
			$check_owner = \lib\db\stores::get(['id' => $parent, 'creator' => \lib\user::id(), 'limit' => 1]);
			if(is_array($check_owner) && !array_key_exists('parent', $check_owner))
			{
				// \dash\app::log('api:store:parent:owner:not:match', \lib\user::id(), $log_meta);
				\lib\notif::error(T_("The parent is not in your store"), 'parent', 'arguments');
				return false;
			}
		}


		$lang = \dash\app::request('language');
		if($lang && (mb_strlen($lang) !== 2 || !\lib\language::check($lang)))
		{
			// \dash\app::log('api:store:invalid:lang', \lib\user::id(), $log_meta);
			\lib\notif::error(T_("Invalid language field"), 'language', 'arguments');
			return false;
		}

		$country           = \dash\app::request('country');
		if($country && mb_strlen($country) > 50)
		{
			// \dash\app::log('api:store:add:country:max:lenght', \lib\user::id(), $log_meta);
			\lib\notif::error(T_("You must set country less than 50 character", 'country', 'arguments'));
			return false;
		}

		$province          = \dash\app::request('province');
		if($province && mb_strlen($province) > 50)
		{
			// \dash\app::log('api:store:add:province:max:lenght', \lib\user::id(), $log_meta);
			\lib\notif::error(T_("You must set province less than 50 character", 'province', 'arguments'));
			return false;
		}

		$city              = \dash\app::request('city');
		if($city && mb_strlen($city) > 50)
		{
			// \dash\app::log('api:store:add:city:max:lenght', \lib\user::id(), $log_meta);
			\lib\notif::error(T_("You must set city less than 50 character", 'city', 'arguments'));
			return false;
		}


		$status = \dash\app::request('status');
		if($status && !in_array($status, ['enable', 'disable']))
		{
			// \dash\app::log('api:store:add:status:invalid', \lib\user::id(), $log_meta);
			\lib\notif::error(T_("Invalid status of stores", 'status', 'arguments'));
			return false;
		}

		$args             = [];
		$args['name']     = $name;
		$args['slug']     = $slug;
		$args['website']  = $website;
		$args['desc']     = $desc;
		$args['lang']     = $lang;
		$args['logo']     = $logo_url;
		$args['parent']   = $parent ? $parent : null;
		$args['country']  = $country;
		$args['province'] = $province;
		$args['city']     = $city;
		$args['status']   = $status;
		$args['address']  = $address;
		$args['phone']    = $phone;
		$args['mobile']   = $mobile;

		return $args;
	}


	/**
	 * ready data of store to load in api
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
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'slug':
					$result[$key] = isset($value) ? (string) $value : null;
					$result['url'] = isset($value) ? \dash\url::protocol(). '://'. $value. '.jibres.'. \dash\url::tld() : null;
					break;

				case 'logo':
					if($value)
					{
						$result['logo'] = $value;
					}
					else
					{
						$result['logo'] = \dash\app::static_logo_url();
					}
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}

}
?>
