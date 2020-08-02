<?php
namespace lib\app\store;


class edit
{
	public static function title($_title)
	{
		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		if(!$_title)
		{
			\dash\notif::error(T_("Title of your store is required"), 'title');
			return false;
		}

		if(!is_string($_title))
		{
			\dash\notif::error(T_("Please set title as string!"), 'title');
			return false;
		}

		if(mb_strlen($_title) > 100)
		{
			\dash\notif::error(T_("Store title must be less than 100 character"), 'title');
			return false;
		}

		$store_id = \lib\store::id();

		if(!$store_id)
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}


		\lib\app\setting\tools::update('store_setting', 'title', $_title);
		\lib\app\sync\store::title($_title, $store_id);


	}



	public static function logo($_logo)
	{
		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		if(!$_logo)
		{
			return false;
		}

		if(!is_string($_logo))
		{
			return false;
		}

		if(mb_strlen($_logo) > 100)
		{
			return false;
		}

		$store_id = \lib\store::id();

		if(!$store_id)
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		\lib\app\setting\tools::update('store_setting', 'logo', $_logo);
		\lib\app\sync\store::logo($_logo, $store_id);
	}


	public static function social($_args)
	{
		$condition =
		[
			'instagram' => 'string_50',
			'telegram'  => 'string_50',
			'youtube'   => 'string_50',
			'twitter'   => 'string_50',
			'linkedin'  => 'string_50',
			'github'    => 'string_50',
			'facebook'  => 'string_50',
			'email'     => 'string_50',
			'aparat'    => 'string_50',
			'eitaa'     => 'string_50',
		];

		$require = [];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		foreach ($data as $key => $value)
		{
			\lib\app\setting\tools::update('store_setting', $key, $value);
		}

		\dash\notif::ok(T_("Your social network was saved"));
	}



	public static function selfedit($_args)
	{
		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}



		$args = \lib\app\store\check::variable($_args);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$args = \dash\cleanse::patch_mode($_args, $args);

		if(!empty($args))
		{
			foreach ($args as $key => $value)
			{
				\lib\app\setting\tools::update('store_setting', $key, $value);
			}
		}

		\dash\notif::ok(T_("Your setting was saved"));
		return true;
	}
}
?>