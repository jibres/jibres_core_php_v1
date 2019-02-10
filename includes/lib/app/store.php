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
		'ssl',			'www',						'ns1',
		'http',			'https',					'vps',
		'jibres',		'ermile',					'phpmyadmin',
		'azvir',		'sarshomar',				'php',
		'tejarak',		'demo',						'nginx',
		'talambar',		'benefits',					'phpcode',
		'pricing',		'help',						'apache',
		'admin',		'enter',					'apache2',
		'about',		'social-responsibility',	'hook',
		'social',		'terms',					'payment',
		'privacy',		'changelog',				'telegram',
		'logo',			'contact',					'instagram',
		'api',			'branch',					'twitter',
		'team',			'member',					'facebook',
		'add',			'edit',						'github',
		'delete',		'user',						'smartgit',
		'hours',		'report',					'trello',
		'last',			'daily',					'gmail',
		'account',		'for',						'vps1',
		'files',		'static',					'subdomain',
		'private',		'public',					'protected',
		'dollar',		'android',					'ubuntu',
		'wwww',			'wwwww',					'wwwwww',
	];


	public static function get_my_store($_field = null)
	{
		return self::get_store(\lib\store::id(), $_field);
	}


	public static function get_store($_id, $_field = null)
	{
		if(!$_id || !is_numeric($_id))
		{
			return false;
		}

		$load = \lib\db\stores::get(['id' => $_id, 'limit' => 1]);
		$load = self::ready($load);

		if($_field)
		{
			if(array_key_exists($_field, $load))
			{
				return $load[$_field];
			}
			else
			{
				return null;
			}
		}
		else
		{
			return $load;
		}

	}

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

		if(\dash\app::isset_request('name') && !$name)
		{
			\dash\notif::error(T_("Name of store can not be null"), 'name', 'arguments');
			return false;
		}

		if($name && mb_strlen($name) > 100)
		{
			\dash\notif::error(T_("Store name must be less than 100 character"), 'name', 'arguments');
			return false;
		}

		$website = \dash\app::request('website');
		$website = trim($website);
		if($website && mb_strlen($website) >= 200)
		{
			\dash\notif::error(T_("Store website must be less than 200 character"), 'website', 'arguments');
			return false;
		}

		if(\dash\app::isset_request('name'))
		{
			if(!$name)
			{
				\dash\notif::error(T_("Name of store can not be null"), 'name', 'arguments');
				return false;
			}
		}

		$slug = \dash\app::request('slug');
		$slug = trim($slug);

		if(\dash\app::isset_request('slug'))
		{
			if(!$slug)
			{
				\dash\notif::error(T_("slug of store can not be null"), 'slug', 'arguments');
				return false;
			}
		}

		// // get slug of name in slug if the slug is not set
		// if(!$slug && $name)
		// {
		// 	$slug = \dash\coding::encode((int) \dash\user::id() + (int) rand(10000,99999) * 10000);
		// 	// $slug = \dash\utility\filter::slug($name);
		// }

		// remove - from slug
		// if the name is persian and slug not set
		// we change the slug as slug of name
		// in the slug we have some '-' in return
		// $slug = str_replace('-', '', $slug);

		if($slug)
		{
			$slug = \dash\utility\convert::to_en_number($slug);

			$slug = preg_replace("/\_{2,}/", "_", $slug);
			$slug = preg_replace("/\-{2,}/", "-", $slug);

			if(mb_strlen($slug) < 5)
			{
				\dash\notif::error(T_("Slug must have at least 5 character"), 'slug');
				return false;
			}

			if(mb_strlen($slug) > 50)
			{
				\dash\notif::error(T_("Please set the slug less than 50 character"), 'slug');
				return false;
			}

			if(!preg_match("/^[A-Za-z0-9\-]+$/", $slug))
			{
				\dash\notif::error(T_("Only [A-Za-z0-9-] can use in slug"), 'slug');
				return false;
			}

			if(!preg_match("/[A-Za-z]+/", $slug))
			{
				\dash\notif::error(T_("You must use a one character from [A-Za-z] in the slug"), 'slug');
				return false;
			}

			if(is_numeric($slug))
			{
				\dash\notif::error(T_("Slug should contain a Latin letter"),'slug');
				return false;
			}

			if(is_numeric(substr($slug, 0, 1)))
			{
				\dash\notif::error(T_("The slug must begin with latin letters"),'slug');
				return false;
			}

			$slug = mb_strtolower($slug);

			if(in_array($slug, self::$black_list_slug))
			{
				\dash\notif::error(T_("You can not choose this slug"), 'slug', 'arguments');
				return false;
			}

			if(substr_count($slug, '-') > 1)
			{
				\dash\notif::error(T_("The slug must have one separator"),'slug');
				return false;
			}

		}

		$desc = \dash\app::request('desc');
		if($desc && mb_strlen($desc) > 200)
		{
			\dash\notif::error(T_("Store desc must be less than 200 character"), 'desc', 'arguments');
			return false;
		}

		$phone = \dash\app::request('phone');
		if($phone && mb_strlen($phone) > 50)
		{
			\dash\notif::error(T_("Store phone must be less than 50 character"), 'phone', 'arguments');
			return false;
		}

		$mobile = \dash\app::request('mobile');
		if($mobile && mb_strlen($mobile) > 50)
		{
			\dash\notif::error(T_("Store mobile must be less than 50 character"), 'mobile', 'arguments');
			return false;
		}

		$address = \dash\app::request('address');
		if($address && mb_strlen($address) > 1000)
		{
			\dash\notif::error(T_("Store address must be less than 1000 character"), 'address', 'arguments');
			return false;
		}


		$logo_url = \dash\app::request('logo');
		if($logo_url && !is_string($logo_url))
		{
			\dash\notif::error(T_("Invalid logo url fo store"), 'logo');
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
			$check_owner = \lib\db\stores::get(['id' => $parent, 'creator' => \dash\user::id(), 'limit' => 1]);
			if(is_array($check_owner) && !array_key_exists('parent', $check_owner))
			{
				\dash\notif::error(T_("The parent is not in your store"), 'parent', 'arguments');
				return false;
			}
		}


		$lang = \dash\app::request('language');
		if($lang && (mb_strlen($lang) !== 2 || !\dash\language::check($lang)))
		{
			\dash\notif::error(T_("Invalid language field"), 'language', 'arguments');
			return false;
		}

		$country           = \dash\app::request('country');
		if($country && mb_strlen($country) > 50)
		{
			\dash\notif::error(T_("You must set country less than 50 character", 'country', 'arguments'));
			return false;
		}

		$province          = \dash\app::request('province');
		if($province && mb_strlen($province) > 50)
		{
			\dash\notif::error(T_("You must set province less than 50 character", 'province', 'arguments'));
			return false;
		}

		$city              = \dash\app::request('city');
		if($city && mb_strlen($city) > 50)
		{
			\dash\notif::error(T_("You must set city less than 50 character", 'city', 'arguments'));
			return false;
		}


		$status = \dash\app::request('status');
		if($status && !in_array($status, ['enable', 'disable', 'close']))
		{
			\dash\notif::error(T_("Invalid status of stores", 'status', 'arguments'));
			return false;
		}

		$plan = \dash\app::request('plan');
		if($plan && !in_array($plan, ['free', 'standard', 'simple', 'trial']))
		{
			\dash\notif::error(T_("Invalid plan of stores", 'plan'));
			return false;
		}

		$factorheader = \dash\app::request('factorheader');
		$factorfooter = \dash\app::request('factorfooter');


		$args                 = [];
		$args['name']         = $name;
		$args['slug']         = $slug;
		$args['website']      = $website;
		$args['desc']         = $desc;
		$args['lang']         = $lang;
		$args['logo']         = $logo_url;
		$args['parent']       = $parent ? $parent : null;
		$args['country']      = $country;
		$args['province']     = $province;
		$args['city']         = $city;
		$args['status']       = $status;
		$args['address']      = $address;
		$args['phone']        = $phone;
		$args['mobile']       = $mobile;
		$args['plan']         = $plan;
		$args['factorheader'] = $factorheader;
		$args['factorfooter'] = $factorfooter;

		return $args;
	}


	/**
	 * ready data of store to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function ready($_data)
	{
		$start = null;
		$end   = null;
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

					if($key === 'creator')
					{
						if(intval($value) === intval(\dash\user::id()))
						{
							$result['is_creator'] = true;
						}
						else
						{
							$result['is_creator'] = false;
						}
					}
					break;

				case 'startplan':
					$start        = $value;
					$result[$key] = $value;
					break;

				case 'expireplan':
					$end          = $value;
					$result[$key] = $value;
					break;

				// JSON TO ARRAY
				case 'pos':
				case 'cat':
				case 'unit':
				case 'setting':
					if($value && is_string($value))
					{
						$result[$key] = json_decode($value, true);
					}
					else
					{
						$result[$key] = $value;
					}
					break;

				case 'slug':
					$result[$key] = isset($value) ? (string) $value : null;
					$result['url'] = isset($value) ? \dash\url::protocol(). '://'. $value. '.jibres.'. \dash\url::tld() : null;
					break;

				case 'logo':

					$result['logo_raw'] = $value;

					if($value)
					{
						$result['logo'] = \lib\filepath::fix($value);
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

		if($end)
		{
			$daysleft = null;

			if($end)
			{
				$date1    = date_create(date("Y-m-d"));
				$date2    = date_create($end);
				$diff     = date_diff($date1,$date2);

				$daysleft = $diff->format("%r%a");

				if(intval($daysleft) < 0)
				{
					$daysleft = 0;
				}

				$daysleft = abs(intval($daysleft));
			}

			$result['daysleft'] = $daysleft;

		}


		return $result;
	}

}
?>
