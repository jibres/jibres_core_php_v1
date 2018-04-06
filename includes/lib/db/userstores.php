<?php
namespace lib\db;

class userstores
{

	public static function search_customer($_search_name, $_store_id)
	{
		if(!$_search_name || !$_store_id || !is_numeric($_store_id))
		{
			return false;
		}

		$_search_name = trim($_search_name);

		$query =
		"
			SELECT
				*
			FROM
				userstores
			WHERE
				userstores.store_id    = $_store_id AND
				userstores.displayname = '$_search_name'
			LIMIT 1
		";
		return \dash\db::get($query, null, true);
	}

	/**
	 * insert new userstore
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function insert()
	{
		\dash\db\config::public_insert('userstores', ...func_get_args());
		return \dash\db::insert_id();
	}


	public static function get_count()
	{
		return \dash\db\config::public_get_count('userstores', ...func_get_args());
	}


	/**
	 * Determines if duplicate mobile.
	 *
	 * @param      <type>  $_mobile    The mobile
	 * @param      <type>  $_type      The type
	 * @param      <type>  $_store_id  The store identifier
	 */
	public static function is_duplicate_code($_code, $_type, $_store_id)
	{
		if(!$_store_id)
		{
			return null;
		}

		if(!$_code)
		{
			return false;
		}

		$query =
		"
			SELECT
				userstores.*
			FROM
				userstores
			WHERE
				userstores.code     = '$_code' AND
				userstores.type     = '$_type' AND
				userstores.store_id = $_store_id
			LIMIT 1
		";

		$result = \dash\db::get($query, null, true);
		return $result;
	}

	/**
	 * Determines if duplicate mobile.
	 *
	 * @param      <type>  $_mobile    The mobile
	 * @param      <type>  $_type      The type
	 * @param      <type>  $_store_id  The store identifier
	 */
	public static function is_duplicate_mobile($_mobile, $_type, $_store_id)
	{
		if(!$_store_id)
		{
			return null;
		}

		$_mobile = \dash\utility\filter::mobile($_mobile);
		if(!$_mobile)
		{
			return false;
		}

		$query =
		"
			SELECT
				userstores.*
			FROM
				userstores
			INNER JOIN users ON users.id = userstores.user_id
			WHERE
				users.mobile        = '$_mobile' AND
				userstores.type     = '$_type' AND
				userstores.store_id = $_store_id
			LIMIT 1
		";

		$result = \dash\db::get($query, null, true);
		return $result;
	}


	/**
	 * update userstores
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function update($_args, $_id)
	{
		$result = \dash\db\config::public_update('userstores', $_args, $_id);
		return $result;
	}


	public static function update_cache($_id, $_store_id, $_force = false)
	{
		// no detail was changed
		if(!\lib\temp::get('contact_change_any_thing') && !$_force)
		{
			return null;
		}

		if(\lib\temp::get('user_team_already_run_update_cache'))
		{
			return true;
		}

		\lib\temp::set('user_team_already_run_update_cache', true);

		if(!$_store_id)
		{
			return false;
		}

		$user_id = self::get(['id' => $_id, 'limit' => 1]);

		if(isset($user_id['user_id']))
		{
			$user_id = $user_id['user_id'];
		}
		else
		{
			return false;
		}

		$query =
		"
			UPDATE
				userstores
			SET
			userstores.firstname    = (SELECT contacts.value FROM contacts WHERE contacts.store_id = $_store_id AND contacts.user_id = $user_id AND contacts.key = 'firstname' 	LIMIT 1),
			userstores.lastname     = (SELECT contacts.value FROM contacts WHERE contacts.store_id = $_store_id AND contacts.user_id = $user_id AND contacts.key = 'lastname' 	LIMIT 1),
			userstores.mobile       = (SELECT contacts.value FROM contacts WHERE contacts.store_id = $_store_id AND contacts.user_id = $user_id AND contacts.key = 'mobile' 		LIMIT 1),
			userstores.birthday     = (SELECT contacts.value FROM contacts WHERE contacts.store_id = $_store_id AND contacts.user_id = $user_id AND contacts.key = 'birthday' 	LIMIT 1),
			userstores.avatar       = (SELECT contacts.value FROM contacts WHERE contacts.store_id = $_store_id AND contacts.user_id = $user_id AND contacts.key = 'avatar' 		LIMIT 1),
			userstores.father       = (SELECT contacts.value FROM contacts WHERE contacts.store_id = $_store_id AND contacts.user_id = $user_id AND contacts.key = 'father' 		LIMIT 1),
			userstores.nationalcode = (SELECT contacts.value FROM contacts WHERE contacts.store_id = $_store_id AND contacts.user_id = $user_id AND contacts.key = 'nationalcode' LIMIT 1),
			userstores.postion      = (SELECT contacts.value FROM contacts WHERE contacts.store_id = $_store_id AND contacts.user_id = $user_id AND contacts.key = 'postion' 	LIMIT 1),
			userstores.code         = (SELECT contacts.value FROM contacts WHERE contacts.store_id = $_store_id AND contacts.user_id = $user_id AND contacts.key = 'code' 		LIMIT 1)
			WHERE userstores.id = $_id
		";
		return \dash\db::query($query);
	}


	/**
	 * get userstore detail
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function get($_args)
	{
		$key = $_args;
		krsort($key);
		$cache = \dash\db\cache::get_cache('userstores', $key);
		if($cache)
		{
			return $cache;
		}

		$result = \dash\db\config::public_get('userstores', $_args);

		\dash\db\cache::set_cache('userstores', $key , $result);
		return $result;
	}



	/**
	 * Searches for the first match.
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function search($_string = null, $_option = [])
	{
		$default_option =
		[
			'search_field' =>
			"
				(
					userstores.firstname LIKE '%__string__%' OR
					userstores.lastname LIKE '%__string__%' OR
					userstores.mobile LIKE '%__string__%' OR
					userstores.nationalcode LIKE '%__string__%' OR
					userstores.father LIKE '%__string__%' OR
					userstores.birthday LIKE '%__string__%'
				)
			",
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		return \dash\db\config::public_search('userstores', $_string, $_option);
	}


}
?>