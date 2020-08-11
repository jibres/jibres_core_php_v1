<?php
namespace lib\app\store;


class edit
{

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

		\lib\store::reset_cache();

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

		$store_id = \lib\store::id();

		if($store_id)
		{
			if(array_key_exists('logo', $args))
			{
				\lib\db\store\update::store_data('logo', $args['logo'], $store_id);
			}

			if(array_key_exists('title', $args))
			{
				\lib\db\store\update::store_data('title', $args['title'], $store_id);
			}

			if(array_key_exists('desc', $args))
			{
				\lib\db\store\update::store_data('description', $args['desc'], $store_id);
			}


			if(array_key_exists('lang', $args))
			{
				\lib\db\store\update::store_data('lang', $args['lang'], $store_id);
			}
		}

		\lib\store::reset_cache();

		\dash\notif::ok(T_("Your setting was saved"));
		return true;
	}
}
?>