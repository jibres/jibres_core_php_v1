<?php
namespace dash\app;


class user
{

	use \dash\app\user\add;
	use \dash\app\user\edit;
	use \dash\app\user\datalist;
	use \dash\app\user\get;


	public static function ban($_user_id, $_ban_expire = null)
	{
		$user_id = \dash\validate::id($_user_id, false);
		if($user_id)
		{
			$update = [];
			$update['status'] = 'ban';

			if($_ban_expire)
			{
				$update['ban_expire'] = $_ban_expire;
			}
			else
			{
				$update['ban_expire'] = null;
			}

			\dash\db\users::update($update, $user_id);
		}
	}


	public static function un_ban($_user_id)
	{
		$user_id = \dash\validate::id($_user_id, false);
		if($user_id)
		{
			$update = [];
			$update['status'] = 'awaiting';

			\dash\db\users::update($update, $user_id);
		}
	}



	public static function lates_user($_args = [])
	{
		if(!isset($_args['limit']))
		{
			$_args['limit'] = 5;
		}

		$_args['order_raw'] = 'users.id DESC';
		$_args['pagenation'] = false;

		$list = \dash\db\users::search(null, $_args);

		if(is_array($list))
		{
			$list = array_map(['\\dash\\app\\user', 'ready'], $list);
		}

		return $list;
	}

	public static function chart_gender()
	{
		$result     = \dash\db\users::get_gender_chart();
		$hi_chart   = [];

		if(!is_array($result))
		{
			$result = [];
		}

		foreach ($result as $key => $value)
		{
			$name  = null;
			$count = 0;

			if(is_array($value) && array_key_exists('gender', $value))
			{
				$name = $value['gender'] ? T_($value['gender']) : T_("Unknown");
			}

			if(is_array($value) && array_key_exists('count', $value))
			{
				$count = floatval($value['count']);
			}
			$newValue = ['name' => $name, 'y' => $count];
			if(is_array($value) && array_key_exists('gender', $value) && !$value['gender'])
			{
				$newValue['visible'] = false;
			}
			$hi_chart[] = $newValue;
		}

		$hi_chart = json_encode($hi_chart, JSON_UNESCAPED_UNICODE);

		return $hi_chart;

	}

	public static function chart_status()
	{
		$result = \dash\db\users::get_status_chart();
			$hi_chart   = [];

		if(!is_array($result))
		{
			$result = [];
		}

		foreach ($result as $key => $value)
		{
			if(!is_array($value))
			{
				$value = [];
			}
			$name  = null;
			$count = 0;

			if(array_key_exists('status', $value))
			{
				$name = $value['status'] ? T_($value['status']) : T_("Unknown");
			}

			if(array_key_exists('count', $value))
			{
				$count = floatval($value['count']);
			}

			$hi_chart[] = ['name' => $name, 'y' => $count];
		}

		$hi_chart      = json_encode($hi_chart, JSON_UNESCAPED_UNICODE);

		return $hi_chart;


	}


	public static function chart_identify($_args = [], $_get_raw = false)
	{

		$result = \dash\db\users::get_identify_chart();

		$hi_chart   = [];
		$categories = [];
		$values     = [];
		$raw        = [];

		if(!is_array($result))
		{
			$result = [];
		}

		$all = \dash\db\users::get_count();
		$all = floatval($all);
		if($all === 0)
		{
			$all = 1;
		}


		foreach ($result as $key => $value)
		{
			$temp     = 0;
			$type     = null;
			$type_raw = null;

			if(array_key_exists('type', $value))
			{
				$type = $value['type'] ? T_($value['type']) : T_("Unknown");
				$categories[] = $type;
				$type_raw = $value['type'];
			}

			if(array_key_exists('count', $value))
			{
				$temp = floatval($value['count']);
				$values[] = floatval($temp);
			}

			$raw[$type_raw] = round(($temp * 100) / $all, 1);
		}

		$hi_chart['categories'] = json_encode($categories, JSON_UNESCAPED_UNICODE);
		$hi_chart['value']      = json_encode($values, JSON_UNESCAPED_UNICODE);

		$return                 = [];
		$return['chart']        = $hi_chart;
		$return['raw']          = $raw;
		return $return;

	}





	public static function get_full_name($_user_id, $_get_gender = false)
	{
		if(!$_user_id || !is_numeric($_user_id))
		{
			return false;
		}

		$load = \dash\db\users::get_by_id($_user_id);

		$name = null;
		if(isset($load['firstname']) && isset($load['lastname']))
		{
			$name = trim($load['firstname']. ' '. $load['lastname']);
		}
		elseif(isset($load['displayname']))
		{
			$name = $load['displayname'];
		}

		if($_get_gender)
		{
			if(isset($load['gender']))
			{
				if($load['gender'] === 'male')
				{
					$name = T_("Mr"). ' '. $name;
				}
				elseif($load['gender'] === 'female')
				{
					$name = T_("Mrs"). ' '. $name;
				}
			}
		}

		return $name;
	}



	public static function check_duplicate($_national_code, $_passport_code)
	{
		$result = false;
		if($_national_code)
		{
			// check not duplicate nationalcode only
			$result = \dash\db\users::get(['nationalcode' => "$_national_code",  'limit' => 1]);
		}
		else
		{
			// check pasportcode only
			$result = \dash\db\users::get(['pasportcode' => "$_passport_code", 'limit' => 1]);
		}

		return $result;

	}

	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function check($_args, $_id = null, $_option = [], $_load_user = [])
	{
		$condition =
		[
			'username'              => 'username',
			'theme'                 => ['enum' => ['default','night','light']],
			'accounttype'           => ['enum' => ['real', 'legal']],
			'mobile'                => 'mobile',
			'email'                 => 'email',
			'language'              => 'language',
			'bio'                   => 'desc',
			'displayname'           => 'displayname',
			'nationalcode'          => 'nationalcode',
			'pasportcode'           => 'id',
			'firstname'             => 'displayname',
			'lastname'              => 'displayname',
			'father'                => 'displayname',
			'birthday'              => 'birthdate',
			'pasportdate'           => 'date',
			'gender'                => ['enum' => ['male','female', 'company', 'rather not say']],
			'marital'               => ['enum' => ['single', 'married']],
			'avatar'                => 'string_200',
			// 'shcode'             => 'smallint',
			'subscribe'             => 'bit',
			'nationality'           => 'country',
			'phone'                 => 'phone',
			'status'                => ['enum' => ['active','awaiting','deactive','removed','filter','unreachable', 'ban', 'block']],
			'website'               => 'url',
			'ban_expire'            => 'datetime',
			'title'                 => 'string_50',
			'instagram'             => 'socialnetwork',
			'linkedin'              => 'socialnetwork',
			'facebook'              => 'socialnetwork',
			'twitter'               => 'socialnetwork',
			'twostep'               => 'bit',
			'forceremember'         => 'bit',
			'sidebar'               => 'bit',
			'signature'             => 'html',
			'type'                  => 'string_50',
			'permission'            => ['enum' => array_merge(\dash\permission::groups(), ['admin'])],
			'password'              => 'password',
			'companyname'           => 'string_200',
			'companyregisternumber' => 'bigint',
			'companynationalid'     => 'bigint',
			'companyeconomiccode'   => 'bigint',
			'accounting_detail_id'  => 'id',
		];

		$require = ['displayname'];
		$meta    =
		[
			'field_title' =>
			[
				'displayname' => T_("Display name"),
			],
		];

		$data    = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(!$data['mobile'] && array_key_exists('mobile', $_args))
		{
			// in crm content the mobile is not required
			if(\dash\url::content() !== 'crm')
			{
				\dash\notif::error(T_("Mobile is required"), 'mobile');
				return false;
			}
		}


		if($data['password'])
		{
			$data['password'] = \dash\utility::hasher($data['password'], null, false);
		}


		if(!\dash\permission::check("crmPermissionManagement"))
		{
			unset($data['permission']);
		}

		if($_id && isset($_load_user['permission']))
		{
			if($_load_user['permission'] === 'supervisor')
			{
				unset($data['permission']);
			}
		}

		if(isset($data['permission']) && $data['permission'] === 'supervisor')
		{
			unset($data['permission']);
		}

		if(!$data['displayname'] && ($data['firstname'] || $data['lastname']))
		{
			$data['displayname'] = trim($data['firstname']. ' '. $data['lastname']);
		}

		$data['forceremember'] = $data['forceremember'] ? 1 : 0;

		return $data;
	}


	/**
	 * ready data of user to _load_user in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function ready($_data, $_id = null)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'permission':
					if($value === 'supervisor' && !\dash\permission::supervisor())
					{
						return false;
					}
					else
					{
						$result[$key] = $value;
					}

					break;
				case 'id':
				case 'creator':
				case 'parent':
					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'avatar':
					// $value = \lib\filepath::force_dl($value);
					$value = \lib\filepath::fix_avatar($value);

					$result['avatar_raw'] = $value;
					if($value)
					{
						$result['avatar'] = $value;
					}
					else
					{
						if(isset($_data['gender']))
						{
							if($_data['gender'] === 'male')
							{
								$avatar = \dash\app::static_avatar_url('male');
							}
							else
							{
								$avatar = \dash\app::static_avatar_url('female');
							}
						}
						else
						{
							$avatar = \dash\app::static_avatar_url();
						}
						$result['avatar'] = $value ? $value : $avatar;
					}
					break;

				case 'sidebar':
					if($value || $value === null)
					{
						$result[$key] = true;
					}
					else
					{
						$result[$key] = false;
					}

					break;
				case 'detail':
					if($value)
					{
						$result[$key] = json_decode($value, true);
					}
					else
					{
						$result[$key] = $value;
					}

					if(isset($result['detail']['file1']))
					{
						$result['detail']['file1'] = \lib\filepath::fix($result['detail']['file1']);
					}

					if(isset($result['detail']['file2']))
					{
						$result['detail']['file2'] = \lib\filepath::fix($result['detail']['file2']);
					}
					break;

				case 'forceremember':
					if($value === null)
					{
						$result[$key] = true;
					}
					elseif($value)
					{
						$result[$key] = true;
					}
					else
					{
						$result[$key] = false;
					}
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}

	public static function ready_api($_data)
	{

		unset($_data['pin']);
		unset($_data['ref']);
		unset($_data['twostep']);
		unset($_data['unit_id']);
		unset($_data['meta']);
		unset($_data['sidebar']);
		unset($_data['theme']);
		unset($_data['forceremember']);
		unset($_data['signature']);
		unset($_data['foreign']);
		unset($_data['detail']);
		unset($_data['jibres_user_id']);
		unset($_data['password']);
		unset($_data['title']);
		unset($_data['avatar_raw']);
		unset($_data['parent']);

		return $_data;
	}



	public static function delete_user($_user_id)
	{
		if(!$_user_id || !is_numeric($_user_id))
		{
			return false;
		}

		$deletedetail               = [];
		$deletedetail['remover']    = \dash\user::id();
		$deletedetail['deletedate'] = date("Y-m-d H:i:s");
		$loadAll                    = \dash\db\users::get(['id' => $_user_id, 'limit' => 1]);
		if(!is_array($loadAll))
		{
			$loadAll = [];
		}

		if(isset($loadAll['permission']) && $loadAll['permission'])
		{
			\dash\notif::error(T_("Can not remove user by permission"));
			return false;
		}

		if(isset($loadAll['status']) && $loadAll['status'] === 'removed')
		{
			\dash\notif::error(T_("This user was removed"));
			return false;
		}

		$deletedetail = array_merge($deletedetail, $loadAll);
		$deletedetail = json_encode($deletedetail, JSON_UNESCAPED_UNICODE);

		$update_old                         = [];

		$update_old['mobile']               = null;
		$update_old['email']                = null;
		$update_old['username']             = null;
		$update_old['displayname']          = null;
		$update_old['gender']               = null;
		$update_old['title']                = null;
		$update_old['password']             = null;
		$update_old['verifymobile']         = null;
		$update_old['verifyemail']          = null;
		$update_old['avatar']               = null;
		$update_old['parent']               = null;
		$update_old['type']                 = null;
		$update_old['pin']                  = null;
		$update_old['ref']                  = null;
		$update_old['twostep']              = null;
		$update_old['birthday']             = null;
		$update_old['unit_id']              = null;
		$update_old['language']             = null;
		$update_old['website']              = null;
		$update_old['facebook']             = null;
		$update_old['twitter']              = null;
		$update_old['instagram']            = null;
		$update_old['linkedin']             = null;
		$update_old['gmail']                = null;
		$update_old['sidebar']              = null;
		$update_old['firstname']            = null;
		$update_old['lastname']             = null;
		$update_old['bio']                  = null;
		$update_old['forceremember']        = null;
		$update_old['signature']            = null;
		$update_old['father']               = null;
		$update_old['nationality']          = null;
		$update_old['pasportdate']          = null;
		$update_old['marital']              = null;
		$update_old['foreign']              = null;
		$update_old['phone']                = null;
		$update_old['detail']               = null;
		$update_old['permission']           = null;

		$update_old['status']               = 'removed';

		$update_old['nationalcode']         = null;
		$update_old['pasportcode']          = null;
		$update_old['meta']                 = $deletedetail;

		\dash\app\user::quick_update($update_old, $_user_id);

		\dash\log::set('crmMemberRemoved', ['code' => $_user_id]);
		return true;

	}

}
?>