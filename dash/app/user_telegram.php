<?php
namespace dash\app;


class user_telegram
{


	public static $sort_field =
	[
		'id',
		'user_id',
		'chatid',
		'firstname',
		'lastname',
		'username',
		'language',
		'status',
		'lastupdate',
		'datecreated',
	];


	public static function dataTableList(&$dataTable)
	{
		$id = array_column($dataTable, 'id');
		$id = array_map(['\\dash\\coding', 'decode'], $id);
		if(!$id)
		{
			return;
		}
		$load = \dash\db\user_telegram::get_dataTable(implode(',', $id));
		if(!is_array($load))
		{
			return;
		}

		$load = array_combine(array_column($load, 'user_id'), $load);

		foreach ($dataTable as $key => $value)
		{
			$myId = \dash\coding::decode($value['id']);
			if(isset($load[$myId]))
			{
				$dataTable[$key]['chatid'] = $load[$myId]['chatid'];
			}
		}
	}


	public static function get($_id)
	{
		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			return false;
		}

		$result = \dash\db\user_telegram::get(['id' => $id, 'limit' => 1]);
		$temp = [];
		if(is_array($result))
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
			'user_id'   => 'id',
			'chatid'    => 'id',
			'firstname' => 'displayname',
			'lastname'  => 'displayname',
			'username'  => 'displayname',
			'title'     => 'displayname',
			'language'  => 'language',
			'status'    => ['enum' => ['active','deactive','spam','bot','block','unreachable','unknown','filter','awaiting','inline','callback']],
		];

		$require = ['chatid'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

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

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}


	public static function remove($_chat_id, $_user_id)
	{
		if(!$_chat_id || !$_user_id || !is_numeric($_chat_id) || !is_numeric($_user_id))
		{
			return false;
		}

		$check_duplicate =
		[
			'user_id' => $_user_id,
			'chatid'  => $_chat_id,
			'limit'   => 1,
		];

		$check_duplicate = \dash\db\user_telegram::get($check_duplicate);
		if(isset($check_duplicate['id']))
		{
			\dash\log::set('removeUserTelegram', ['oldrecord' => $check_duplicate]);
			\dash\db\user_telegram::hard_delete($check_duplicate['id']);
			return true;
		}
		else
		{
			\dash\notif::error(T_("This user have not this chatid"));
			return false;
		}


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

		// check args
		$args = self::check($_args);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$return  = [];

		$check_duplicate =
		[
			// 'user_id' => $args['user_id'],
			'chatid'  => $args['chatid'],
			'limit'   => 1,
		];

		$check_duplicate = \dash\db\user_telegram::get($check_duplicate);
		if(isset($check_duplicate['id']))
		{
			\dash\log::set('tryToInsertDuplicateUserTelegram');
			\dash\notif::error(T_("Duplicate chatid"));
			return false;
		}

		unset($args['title']);

		$user_telegram = \dash\db\user_telegram::insert($args);

		if(!$user_telegram)
		{
			\dash\log::set('noWayToAddUserTelegram');
			\dash\notif::error(T_("No way to insert user_telegram"));
			return false;
		}

		\dash\log::set('addUserTelegram');

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

		if($option['order'])
		{
			if(!in_array($option['order'], ['asc', 'desc']))
			{
				unset($option['order']);
			}
		}

		if($option['sort'])
		{
			if(!in_array($option['sort'], self::$sort_field))
			{
				unset($option['sort']);
			}
		}

		$field             = [];

		$result = \dash\db\user_telegram::search($_string, $option, $field);

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


	public static function edit($_args, $_id)
	{

		$id = \dash\coding::decode($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Can not access to edit user_telegram"), 'user_telegram');
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
			\dash\db\user_telegram::update($args, $id);
			\dash\log::set('editUserTelegram');
		}

		return true;
	}

}
?>