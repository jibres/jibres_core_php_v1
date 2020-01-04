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



	public static function selfedit($_args)
	{
		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		\dash\app::variable($_args);

		$args = \lib\app\store\check::variable();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		if(!\dash\app::isset_request('title')) unset($args['title']);
		if(!\dash\app::isset_request('website')) unset($args['website']);
		if(!\dash\app::isset_request('desc')) unset($args['desc']);
		if(!\dash\app::isset_request('lang')) unset($args['lang']);
		if(!\dash\app::isset_request('status')) unset($args['status']);
		if(!\dash\app::isset_request('address')) unset($args['address']);
		if(!\dash\app::isset_request('phone')) unset($args['phone']);
		if(!\dash\app::isset_request('mobile')) unset($args['mobile']);

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