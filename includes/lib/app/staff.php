<?php
namespace lib\app;


/**
 * Class for staff.
 */
class staff extends \lib\app\user
{
	/**
	 * add new user and save the userstore record
	 *
	 * @param      <type>  $_args    The arguments
	 * @param      array   $_option  The option
	 */
	public static function add($_args, $_option = [])
	{
		$displayname = null;
		if(isset($_args['displayname']))
		{
			$displayname = $_args['displayname'];
		}
		else
		{
			if(isset($_args['firstname']))
			{
				$displayname = $_args['firstname'];
			}

			if(isset($_args['lastname']))
			{
				$displayname .= ' '. $_args['lastname'];
			}
		}

		$displayname = trim($displayname);

		unset($_args['type']);

		// save in contacts.store_id
		$_option['other_field']    = 'store_id';
		$_option['other_field_id'] = \lib\store::id();
		// add user
		$result = parent::add($_args, $_option);

		if(isset($result['user_id']))
		{
			$user_id = \lib\utility\shortURL::decode($result['user_id']);

			$insert_userstore =
			[
				'user_id'     => $user_id,
				'store_id'    => \lib\store::id(),
				'type'        => 'staff',
				'displayname' => $displayname,
			];

			$userstore_id = \lib\db\userstores::insert($insert_userstore);

			if(!$userstore_id)
			{
				\lib\app::log('cannot:add:user:to:userstore', \lib\user::id());
				\lib\debug::error(T_("Can not set the user in you store user list"));
				return false;
			}

			$result['userstore_id'] = \lib\utility\shortURL::encode($userstore_id);
		}
		return $result;
	}


	public static function list($_args = [])
	{
		$list = \lib\db\userstores::search(null, []);
		return $list;
	}
}
?>