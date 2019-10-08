<?php
namespace lib\app\store;


class add
{

	public static function trial($_args)
	{
		$plan    = 'trial';
		$user_id = \dash\user::id();

		if(!$user_id)
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		// create new store by free plan
		// just check count of free plan store
		// check store count
		$count_store_free = intval(\lib\db\store\get::count_free_trial($user_id));

		if($count_store_free >= 1)
		{
			$user_budget = \dash\db\transactions::budget($user_id, ['unit' => 'toman']);

			$user_budget = floatval($user_budget);

			if($user_budget < 10000)
			{
				if(\dash\permission::supervisor())
				{
					\dash\notif::warn(T_("To register a second store, you need to have at least 10,000 toman in inventory on your account"));
				}
				else
				{
					\dash\notif::error(T_("To register a second store, you need to have at least 10,000 toman in inventory on your account"));
					return false;
				}
			}
		}

		if($count_store_free >= 2)
		{
			$msg = T_("You can not have more than two free or trial stores.");

			if(\dash\url::isLocal())
			{
				\dash\notif::warn($msg. "\n". T_("This msg in local is warn and in site is error :)"));
			}
			else
			{
				\dash\notif::error($msg);
				return false;
			}
		}

		if($plan === 'trial')
		{
			$_args['startplan']  = date("Y-m-d H:i:s");
			$_args['expireplan'] = date("Y-m-d H:i:s", strtotime("+14 days"));
			$_args['plan']       = 'trial';
		}

		return self::add($_args);
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

		$payment = \dash\app::request('payment');
		if($payment && is_array($payment))
		{
			$payment = json_encode($payment, JSON_UNESCAPED_UNICODE);
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
		$args['payment']      = $payment;

		return $args;
	}

}
?>