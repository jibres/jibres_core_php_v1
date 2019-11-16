<?php
namespace lib\db\userstore;


class insert
{

	/**
	 * check signup and if can add new user
	 * @return [type] [description]
	 */
	public static function signup($_args = [])
	{
		$default_args =
		[
			'mobile'       => null,
			'password'     => null,
			'email'        => null,
			'permission'   => null,
			'displayname'  => null,
			'ref'          => null,
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = array_merge($default_args, $_args);

		$ref = null;
		// get the ref and set in users_parent
		if(isset($_SESSION['ref']))
		{
			$ref = self::check_ref($_SESSION['ref']);
			if($ref)
			{
				$_args['ref'] = $_SESSION['ref'];
			}
			else
			{
				$_args['ref'] = null;
			}
		}
		elseif($_args['ref'])
		{
			$ref = self::check_ref($_args['ref']);
			if(!$ref)
			{
				$_args['ref'] = null;
			}
		}

		if($ref)
		{
			unset($_SESSION['ref']);
		}

		if(isset($_args['mobile']) && $_args['mobile'])
		{
			$mobile = \dash\utility\filter::mobile($_args['mobile']);
			if(!$mobile)
			{
				return false;
			}

			$check = self::get_by_mobile($mobile);

			if(isset($check['id']))
			{
				return $check['id'];
			}
		}


		if(isset($_args['username']) && $_args['username'])
		{
			$check_username = self::get(['username' => $_args['username'], 'limit' => 1]);

			if(isset($check_username['id']))
			{
				return $check_username['id'];
			}
		}

		if(isset($_args['chatid']) && $_args['chatid'])
		{
			$check_chatid = self::get(['chatid' => $_args['chatid'], 'limit' => 1]);

			if(isset($check_chatid['id']))
			{
				return $check_chatid['id'];
			}
		}

		if(isset($_args['email']) && $_args['email'])
		{
			$check_email = self::get(['email' => $email, 'limit' => 1]);

			if(isset($check_email['id']))
			{
				return $check_email['id'];
			}
		}


		if($_args['password'])
		{
			$password = \dash\utility::hasher($_args['password']);
		}
		else
		{
			$password = null;
		}

		if(!\dash\engine\process::status())
		{
			return false;
		}

		if(mb_strlen($_args['displayname']) > 99)
		{
			$_args['displayname'] = null;
		}

		// signup up users
		$_args['datecreated'] = date("Y-m-d H:i:s");

		$insert_id    = self::new_row($_args);
		return $insert_id;

	}



	public static function new_row($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `userstore` SET $set ";

			if(\dash\db::query($query))
			{
				$id = \dash\db::insert_id();
				return $id;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
}
?>