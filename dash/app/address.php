<?php
namespace dash\app;

/**
 * Class for address.
 */
class address
{

	public static function get($_id)
	{
		$id = \dash\validate::code($_id);
		$id = \dash\coding::decode($id);
		if(!$id)
		{
			return false;
		}

		$result = \dash\db\address::get(['id' => $id, 'limit' => 1]);
		$temp = [];
		if(is_array($result) && $result)
		{
			$temp = self::ready($result);
		}
		return $temp;
	}


	public static function get_my_address($_id)
	{
		if(!\dash\user::id())
		{
			return false;
		}

		$id = \dash\validate::code($_id);
		$id = \dash\coding::decode($id);
		if(!$id)
		{
			return false;
		}

		$result = \dash\db\address::get(['id' => $id, 'user_id' => \dash\user::id(), 'limit' => 1]);

		$temp = [];
		if(is_array($result) && $result)
		{
			$temp = self::ready($result);
		}
		return $temp;
	}


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function check($_args, $_id = null)
	{
		$condition =
		[
			'user_id'     => 'id',
			'title'       => 'string_40',
			'name'        => 'displayname',
			'mobile'      => 'mobile',
			'isdefault'   => 'bit',
			'company'     => 'bit',
			'country'     => 'country',
			'province'    => 'province',
			'city'        => 'city',
			'address'     => 'address',
			'address2'    => 'address',
			'postcode'    => 'postcode',
			'phone'       => 'phone',
			'fax'         => 'phone',
			'status'      => ['enum' => ['enable','disable','filter','leave','spam','delete']],
			'favorite'    => 'bit',

		];

		$require = ['address'];
		$meta    = [];

		$data    = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(!$data['province'] && $data['city'])
		{
			$data['province'] = \dash\utility\location\cites::get($data['city'], 'province', 'province');
			if(!\dash\utility\location\provinces::check($data['province']))
			{
				$data['province'] = null;
			}
		}

		return $data;

	}


	/**
	 * ready data of user to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function ready($_data)
	{
		$result = [];
		$result['location_string'] = [];
		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
				case 'user_id':
					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'country':
					$result[$key]                 = $value;
					if($value && mb_strlen($value) === 2)
					{
						$result['flag'] = \dash\url::cdn(). '/img/flags/png100px/'. mb_strtolower($value). '.png';
					}
					else
					{
						$result['flag'] = null;
					}
					$result['country_name']       = \dash\utility\location\countres::get_localname($value, true);
					$result['location_string'][1] = $result['country_name'];
					break;


				case 'province':
					$result[$key] = $value;
					$result['province_name'] = \dash\utility\location\provinces::get_localname($value);
					$result['location_string'][2] = $result['province_name'];
					break;

				case 'city':
					$result[$key] = $value;
					$result['city_name'] = \dash\utility\location\cites::get_localname($value);
					$result['location_string'][3] = $result['city_name'];
					break;

				case 'map':
					if($value && is_string($value))
					{
						$result[$key] = json_decode($value, true);
					}
					else
					{
						$result[$key] = $value;
					}
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}
		ksort($result['location_string']);
		$result['location_string'] = array_filter($result['location_string']);
		$result['location_string'] = implode(T_(","). " ", $result['location_string']);

		return $result;
	}


	/**
	 * add new user
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function add($_args, $_option = [])
	{

		$default_option =
		[
			'debug'    => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);


		if(!\dash\user::id())
		{
			\dash\notif::error(T_("User not found"), 'user');
			return false;
		}

		// check args
		$args = self::check($_args);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$return  = [];

		if(!$args['status'])
		{
			$args['status'] = 'enable';
		}

		if(!$args['user_id'])
		{
			$args['user_id'] = \dash\user::id();
		}

		$count_user_address = \dash\db\address::get_count_user_address($args['user_id']);
		if(intval($count_user_address) > 100)
		{
			\dash\notif::error(T_("You can not add any address"));
			return false;
		}


		$address = \dash\db\address::insert($args);

		if(!$address)
		{
			\dash\log::set('noWayToAddAddress');
			\dash\notif::error(T_("No way to insert address"));
			return false;
		}

		\dash\log::set('addAddress');

		$return['id'] = \dash\coding::encode($address);

		return $return;
	}


	public static function list($_string = null, $_args = [])
	{

		if(!\dash\user::id())
		{
			return false;
		}

		$default_args =
		[
			'order' => null,
			'sort'  => null,
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$option = [];
		$option = array_merge($default_args, $_args);

		$result = \dash\db\address::search($_string, $option);

		$temp            = [];


		foreach ($result as $key => $value)
		{
			$check = self::ready($value);
			if($check)
			{
				$temp[] = $check;
			}
		}

		return $temp;
	}


	public static function get_user_address($_user_id, $_address_id)
	{
		if(!$_address_id)
		{
			return false;
		}

		$address_id = \dash\coding::decode($_address_id);
		if(!$address_id || !is_numeric($address_id) || !$_user_id || !is_numeric($_user_id))
		{
			return false;
		}

		$load = \dash\db\address::get_user_address($_user_id, $address_id);

		return $load;
	}


	public static function edit($_args, $_id)
	{
		$id = \dash\validate::code($_id);
		$id = \dash\coding::decode($id);

		if(!$id)
		{
			\dash\notif::error(T_("Can not access to edit address"), 'address');
			return false;
		}

		if(!\dash\user::id())
		{
			return false;
		}

		// check args
		$args = self::check($_args, $id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$args = \dash\cleanse::patch_mode($_args, $args);

		if(!empty($args))
		{
			\dash\db\address::update($args, $id);
			\dash\log::set('editAddress');
		}

		return true;
	}


	public static function remove($_id)
	{
		$id = \dash\validate::code($_id);

		$id = \dash\coding::decode($id);

		if(!$id)
		{
			\dash\notif::error(T_("Can not access to remove this address"));
			return false;
		}

		if(!\dash\user::id())
		{
			return false;
		}

		$check = ['user_id' => \dash\user::id(), 'id' => $id, 'limit' => 1];
		$check = \dash\db\address::get($check);
		if(!isset($check['id']))
		{
			\dash\notif::error(T_("Can not access to remove this address"));
			return false;
		}

		\dash\db\address::update(['status' => 'delete'], $id);
		\dash\notif::ok(T_("Address removed"));
		return true;
	}


	public static function remove_admin($_id)
	{
		$id = \dash\validate::code($_id);

		$id = \dash\coding::decode($id);

		if(!$id)
		{
			\dash\notif::error(T_("Can not access to remove this address"));
			return false;
		}

		if(!\dash\user::id())
		{
			return false;
		}

		$check = ['id' => $id, 'limit' => 1];
		$check = \dash\db\address::get($check);
		if(!isset($check['id']))
		{
			\dash\notif::error(T_("Can not access to remove this address"));
			return false;
		}

		\dash\db\address::update(['status' => 'delete'], $id);
		\dash\notif::ok(T_("Address removed"));
		return true;
	}
}
?>