<?php
namespace lib\app\store;


class edit
{

	public static function selfedit($_args)
	{
		\dash\app::variable($_args);

		$args = \lib\app\store\check::variable();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		if(!\dash\app::isset_request('name')) unset($args['name']);
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

		\lib\store::refresh();
		\dash\notif::ok(T_("Your setting was saved"));
		return true;
	}
}
?>