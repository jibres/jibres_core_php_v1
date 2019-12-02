<?php
namespace lib\app\store;


class check
{

	public static function variable($_option = [])
	{
		$default_option =
		[
			'debug'   => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		$title = \dash\app::request('title');
		if(\dash\app::isset_request('title') && !$title)
		{
			\dash\notif::error(T_("title of your store is required"), 'title');
			return false;
		}

		if($title && mb_strlen($title) > 100)
		{
			\dash\notif::error(T_("Store title must be less than 100 character"), 'title');
			return false;
		}

		$website = \dash\app::request('website');
		if($website && mb_strlen($website) >= 200)
		{
			\dash\notif::error(T_("Store website must be less than 200 character"), 'website');
			return false;
		}

		if($website && !\dash\utility\filter::url($website))
		{
			\dash\notif::error(T_("Please enter a valid url"), 'website');
			return false;
		}

		$desc = \dash\app::request('desc');
		if($desc && mb_strlen($desc) > 2000)
		{
			\dash\notif::error(T_("Store desc must be less than 2000 character"), 'desc');
			return false;
		}

		$phone = \dash\app::request('phone');
		if($phone && mb_strlen($phone) > 50)
		{
			\dash\notif::error(T_("Store phone must be less than 50 character"), 'phone');
			return false;
		}

		$mobile = \dash\app::request('mobile');
		if($mobile && mb_strlen($mobile) > 50)
		{
			\dash\notif::error(T_("Store mobile must be less than 50 character"), 'mobile');
			return false;
		}

		$address = \dash\app::request('address');
		if($address && mb_strlen($address) > 1000)
		{
			\dash\notif::error(T_("Store address must be less than 1000 character"), 'address');
			return false;
		}


		$lang = \dash\app::request('language');
		if($lang && (mb_strlen($lang) !== 2 || !\dash\language::check($lang)))
		{
			\dash\notif::error(T_("Invalid language"), 'language');
			return false;
		}


		$status = \dash\app::request('status');
		if($status && !in_array($status, ['enable', 'disable', 'close']))
		{
			\dash\notif::error(T_("Invalid status of stores", 'status'));
			return false;
		}


		$args                 = [];
		$args['title']         = $title;
		$args['website']      = $website;
		$args['desc']         = $desc;
		$args['lang']         = $lang;
		$args['status']       = $status;
		$args['address']      = $address;
		$args['phone']        = $phone;
		$args['mobile']       = $mobile;

		return $args;
	}



}
?>