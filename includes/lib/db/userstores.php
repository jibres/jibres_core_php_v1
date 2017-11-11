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
				userstores.displayname =
				CONCAT
				(
					(
						SELECT
							contacts.value
						FROM
							contacts
						WHERE
							contacts.store_id = $store_id AND
							contacts.user_id  = $user_id AND
							contacts.key      = 'firstname'
						LIMIT 1

					 ), ' ',
					 (
					 	SELECT
							contacts.value
						FROM
							contacts
						WHERE
							contacts.store_id = $store_id AND
							contacts.user_id  = $user_id AND
							contacts.key      = 'lastname'
						LIMIT 1
					 )
				)
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
	 * search in userstore
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function search()
	{
		return \lib\db\config::public_search('userstores', ...func_get_args());
	}
}
?>