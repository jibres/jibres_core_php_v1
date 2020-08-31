<?php
namespace dash\app\user;


class legal
{

	public static function get($_user_id)
	{
		$id = \dash\validate::code($_user_id);
		if($id)
		{
			$id  = \dash\coding::decode($id);
			return self::get_inline($id);
		}

		return null;
	}


	public static function get_inline($_user_id)
	{
		$get = \dash\db\userlegal\get::by_user_id($_user_id);

		if(isset($get['country']) && $get['country'])
		{
			$get['country_name'] = \dash\utility\location\countres::get_name($get['country'], true);
		}

		if(isset($get['province']) && $get['province'])
		{
			$get['province_name'] = \dash\utility\location\provinces::get_localname($get['province']);
		}

		if(isset($get['city']) && $get['city'])
		{
			$get['city_name'] = \dash\utility\location\cites::get_localname($get['city']);
		}

		return $get;
	}


	/**
	 * edit a user
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function set($_args, $_id, $_option = [])
	{

		$default_option =
		[

		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);


		$id = $_id;
		$id = \dash\validate::code($id);
		$id = \dash\coding::decode($id);

		if(!$id)
		{
			\dash\notif::error(T_("Can not access to edit user"), 'user');
			return false;
		}

		$load_user  = \dash\db\users::get_by_id($id);

		if(!isset($load_user['id']))
		{
			\dash\notif::error(T_("Invalid user id"));
			return false;
		}


		$condition =
		[
			'companyname'           => 'string_200',
			'companyregisternumber' => 'bigint',
			'companynationalid'     => 'bigint',
			'companyeconomiccode'   => 'bigint',
			'ceonationalcode'       => 'nationalcode',
			'country'               => 'country',
			'province'              => 'province',
			'city'                  => 'city',
			'address'               => 'address',
			'postcode'              => 'postcode',
			'phone'                 => 'phone',
			'fax'                   => 'phone',
			'url'                   => 'url',
			'accounting_details_id' => 'id',
		];


		$require = [];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		if($data === false || !\dash\engine\process::status())
		{
			return false;
		}

		$get = \dash\db\userlegal\get::by_user_id($load_user['id']);
		if(isset($get['user_id']))
		{
			$data['datemodified'] = date("Y-m-d H:i:s");
			\dash\db\userlegal\update::by_user_id($data, $load_user['id']);
		}
		else
		{
			$data['user_id'] = $load_user['id'];
			$data['datecreated'] = date("Y-m-d H:i:s");
			\dash\db\userlegal\insert::new_record($data);
		}

		\dash\notif::ok(T_("User successfully updated"));

		return true;
	}
}
?>