<?php
namespace lib\db;

class userstores
{

	/**
	 * insert new userstore
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function insert()
	{
		\lib\db\config::public_insert('userstores', ...func_get_args());
		return \lib\db::insert_id();
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

		$_mobile = \lib\utility\filter::mobile($_mobile);
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

		$result = \lib\db::get($query, null, true);
		return $result;
	}


	/**
	 * update userstores
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function update($_args, $_id)
	{
		$result = \lib\db\config::public_update('userstores', $_args, $_id);
		self::update_cache($_id);
		return $result;
	}


	public static function update_cache($_id)
	{
		$store_id = \lib\store::id();
		if(!$store_id)
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
				userstores.firstname    = (SELECT contacts.value FROM contacts WHERE contacts.store_id = $store_id AND contacts.user_id = $user_id AND contacts.key = 'firstname' 	LIMIT 1),
				userstores.lastname     = (SELECT contacts.value FROM contacts WHERE contacts.store_id = $store_id AND contacts.user_id = $user_id AND contacts.key = 'lastname' 	LIMIT 1),
				userstores.mobile       = (SELECT contacts.value FROM contacts WHERE contacts.store_id = $store_id AND contacts.user_id = $user_id AND contacts.key = 'mobile' 		LIMIT 1),
				userstores.birthday     = (SELECT contacts.value FROM contacts WHERE contacts.store_id = $store_id AND contacts.user_id = $user_id AND contacts.key = 'birthday' 	LIMIT 1),
				userstores.avatar       = (SELECT contacts.value FROM contacts WHERE contacts.store_id = $store_id AND contacts.user_id = $user_id AND contacts.key = 'avatar' 		LIMIT 1),
				userstores.father       = (SELECT contacts.value FROM contacts WHERE contacts.store_id = $store_id AND contacts.user_id = $user_id AND contacts.key = 'father' 		LIMIT 1),
				userstores.nationalcode = (SELECT contacts.value FROM contacts WHERE contacts.store_id = $store_id AND contacts.user_id = $user_id AND contacts.key = 'nationalcode' LIMIT 1)

			WHERE userstores.id = $_id
		";
		return \lib\db::query($query);
	}


	/**
	 * get userstore detail
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function get()
	{
		return \lib\db\config::public_get('userstores', ...func_get_args());
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
					userstores.birthday LIKE '%__string__%'
				)
			",
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		return \lib\db\config::public_search('userstores', $_string, $_option);
	}


}
?>