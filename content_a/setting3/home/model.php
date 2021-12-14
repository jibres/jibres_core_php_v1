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
		if(self::in('set_title'))						return self::edit_store('title');
		if(self::in('set_desc'))						return self::edit_store('desc');
		if(self::in('set_lang'))						return self::edit_store('lang');
		if(self::in('set_industry'))					return self::edit_store('industry');
		if(self::in('set_nosale'))						return self::edit_store('nosale');

		if(self::in('set_currency'))					return self::edit_unit('currency');
		if(self::in('set_mass'))						return self::edit_unit('mass_unit');
		if(self::in('set_length'))						return self::edit_unit('length_unit');

		if(self::in('set_address'))						return self::address();

		if(self::in('set_logo'))						return self::set_logo();
		if(self::in('remove_logo'))						return self::remove_logo();


		if(self::in('set_enterdisallow')) 				return self::edit_store('enterdisallow');
		if(self::in('set_entersignupdisallow')) 		return self::edit_store('entersignupdisallow');
		if(self::in('set_disallowsearchengine')) 		return self::disallowsearchengine();
		if(self::in('set_forceloginorder')) 			return self::edit_store('forceloginorder');
	}







	/**
	 * Save general setting
	 */
	private static function edit_store($_key)
	{
		$post =
		[
			$_key      => \dash\request::post($_key),
		];

		\lib\app\store\edit::selfedit($post);

		if(\dash\engine\process::status())
		{
			\dash\notif::clean();
			\dash\notif::complete();
			\lib\store::refresh();
		}
	}

	private static function disallowsearchengine()
	{
		$post =
		[
			'disallowsearchengine' => \dash\request::post('disallowsearchengine') ? 'yes' : 'no',
		];

		\lib\app\store\edit::selfedit($post);

		if(\dash\engine\process::status())
		{
			\dash\notif::clean();
			\dash\notif::complete();
			\lib\store::refresh();
		}
	}


	private static function edit_unit($_key)
	{
		$edit_unit =
		[
			$_key => \dash\request::post($_key),
		];

		\lib\app\setting\set::set_units($edit_unit);

		if(\dash\engine\process::status())
		{
			\dash\notif::clean();
			\dash\notif::complete();
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