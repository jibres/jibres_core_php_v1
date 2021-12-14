<?php
namespace content_a\setting3\home;


class model
{
	private static $switcher = 'switcher';

	public static function get_switcher_name()
	{
		return self::$switcher;
	}


	/**
	 * Check in moduel
	 *
	 * @param      <type>  $_key   The key
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function in($_key)
	{
		return \dash\request::post(self::$switcher) === $_key;
	}



	/**
	 * call all section
	 */
	public static function post()
	{
		if(self::in('set_title'))		{ 	return self::title();			}
		if(self::in('set_industry'))	{ 	return self::industry();		}
		if(self::in('set_address'))		{ 	return self::address();			}
		if(self::in('set_logo'))		{ 	return self::set_logo();		}
		if(self::in('remove_logo'))		{ 	return self::remove_logo();		}
	}


	/**
	 * Save general setting
	 */
	private static function title()
	{
		$post =
		[
			'title'      => \dash\request::post('title'),
		];

		\lib\app\store\edit::selfedit($post);

		if(\dash\engine\process::status())
		{
			\dash\notif::clean();
			\dash\notif::complete();
			\lib\store::refresh();
		}
	}


	private static function industry()
	{
		$post =
		[
			'industry'      => \dash\request::post('industry'),
		];

		\lib\app\store\edit::selfedit($post);

		if(\dash\engine\process::status())
		{
			\dash\notif::clean();
			\dash\notif::complete();
			\lib\store::refresh();
		}
	}



	private static function address()
	{
		$post             = [];
		$post['country']  = \dash\request::post('country');
		$post['city']     = \dash\request::post('city');
		$post['province'] = \dash\request::post('province');
		$post['address']  = \dash\request::post('address');
		$post['postcode'] = \dash\request::post('postcode');
		$post['phone']    = \dash\request::post('phone');
		$post['mobile']   = \dash\request::post('mobile');
		$post['fax']      = \dash\request::post('fax');

		\lib\app\setting\set::store_address($post);

		if(\dash\engine\process::status())
		{
			\dash\notif::clean();
			\dash\notif::complete();
		}
	}



	public static function set_logo()
	{

		$result = \lib\app\store\edit::upload_logo();
		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}

	public static function remove_logo()
	{
		\lib\app\store\edit::selfedit(['logo' => null]);
		\dash\redirect::pwd();

	}


}
?>