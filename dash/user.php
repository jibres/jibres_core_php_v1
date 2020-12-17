<?php
namespace dash;

class user
{
	/**
	 * The user working by system
	 *
	 * @var        <type>
	 */
	private static $detail = [];



	/**
	 * Determines if initialize jibres user.
	 * call from enter
	 * @return     boolean  True if initialize jibres user, False otherwise.
	 */
	public static function jibres_user($_need = 'jibres_user_id')
	{
		if($_need)
		{
			return self::detail($_need);
		}

		return self::detail('jibres_user_id');
	}


	public static function set_detail($_detail)
	{
		$_detail = \dash\app::fix_avatar($_detail);
		$_detail['fullname'] = self::fullName($_detail);
		self::$detail = $_detail;
	}


	/**
	 * Initial user id
	 *
	 * @param      <type>  $_user_id  The user identifier
	 */
	public static function init($_user_id, $_place = null)
	{

		$detail = \dash\login::init($_user_id, $_place);

		if(!$detail)
		{
			return false;
		}

		self::set_detail($detail);

		// check some function in login user
		self::delete_user_guest();

	}



	public static function login($_key = null)
	{
		if($_key === null)
		{
			if(self::id())
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return self::detail($_key);
		}
	}



	/**
	 * return current version
	 *
	 * @return     string  The current version of dash
	 */
	public static function id()
	{
		$id = null;

		if(isset(self::$detail['id']))
		{
			$id = self::$detail['id'];
		}


		if(is_numeric($id))
		{
			return floatval($id);
		}

		return $id;
	}


	public static function code()
	{
		if(self::id())
		{
			return \dash\coding::encode(self::id());
		}
		return null;
	}


	public static function mobile()
	{
		$mobile = self::detail('mobile');
		if($mobile)
		{
			return $mobile;
		}

		return null;
	}


	public static function chatid()
	{
		$chatid = self::detail('chatid');
		if($chatid)
		{
			return $chatid;
		}

		return null;
	}



	public static function budget()
	{
		if(!self::id())
		{
			return 0;
		}

		$temp = \dash\temp::get('USER_BUDGET');
		if($temp)
		{
			return $temp;
		}
		else
		{
			$budget = floatval(\dash\db\transactions::budget(self::id()));
			\dash\temp::set('USER_BUDGET', $budget);
			return $budget;
		}
	}


	public static function fullName($_detail = null)
	{
		if(!$_detail || !is_array($_detail))
		{
			$myDetail = self::detail();
		}
		else
		{
			$myDetail = $_detail;
		}

		if($myDetail)
		{
			$myName = '';
			if(isset($myDetail['firstname']) && isset($myDetail['lastname']))
			{
				$myName = $myDetail['firstname']. ' '. $myDetail['lastname'];
			}
			elseif(isset($myDetail['displayname']))
			{
				$myName = $myDetail['displayname'];
			}
			else
			{
				$myName = T_("Without name");
			}

			if(isset($myDetail['gender']))
			{
				if($myDetail['gender'] === 'male')
				{
					$myName = T_("Mr"). ' '. $myName;
				}
				else if($myDetail['gender'] === 'female')
				{
					$myName = T_("Mrs"). ' '. $myName;
				}
			}

			return $myName;
		}

		return null;
	}


	/**
	 * get detail of user
	 *
	 * @param      <type>  $_key   The key
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function detail($_key = null)
	{
		if(empty(self::$detail))
		{
			return null;
		}

		if($_key)
		{
			if(isset(self::$detail[$_key]))
			{
				return self::$detail[$_key];
			}
			return null;
		}
		else
		{
			if(isset(self::$detail))
			{
				return self::$detail;
			}
			return null;
		}
	}


	public static function sidebar()
	{
		$sidebar = self::detail('sidebar');

		if(is_null($sidebar) || $sidebar === '')
		{
			return null;
		}

		if(intval($sidebar) === 1)
		{
			return true;
		}
		elseif($sidebar === '0')
		{
			return false;
		}

		return null;
	}


	private static $email_list = [];
	private static $load_emails_list = false;
	public static function email_list($_verify = false, $_raw = false)
	{
		if(!self::id())
		{
			return [];
		}


		if(self::$load_emails_list)
		{
			$email_list = self::$email_list;
		}
		else
		{
			$email_list             = \dash\db\useremail::get_by_user_id(self::id());
			self::$email_list       = $email_list;
			self::$load_emails_list = true;
		}


		if(!is_array($email_list))
		{
			$email_list = [];
		}

		$result = [];

		if($_raw)
		{
			$result = $email_list;
		}
		else
		{
			foreach ($email_list as $key => $value)
			{
				if($_verify)
				{
					if(isset($value['verify']) && $value['verify'])
					{
						$result[] = $value['email'];
					}
				}
				else
				{
					$result[] = $value['email'];
				}
			}
		}

		return $result;

	}


	public static function primary_email()
	{
		$list = self::email_list(false, true);
		if($list && is_array($list))
		{
			foreach ($list as $key => $value)
			{
				if(isset($value['primary']) && $value['primary'] && isset($value['email']))
				{
					return $value['email'];
				}
			}
		}

		return null;
	}



	// get user guest id if exists
	public static function get_user_guest($_force = false)
	{
		$user_guest_id = \dash\utility\cookie::read('user_guest_id');

		if($user_guest_id && \dash\validate::md5($user_guest_id, false))
		{
			return $user_guest_id;
		}

		// force need guest user
		if($_force)
		{
			$user_guest_id = self::set_user_guest();

			return $user_guest_id;
		}

		return null;
	}


	public static function delete_user_guest()
	{
		$guest = \dash\utility\cookie::read('user_guest_id');
		if($guest && \dash\validate::md5($guest, false))
		{
			$code = self::code();

			if($code && $guest)
			{
				if(\dash\engine\store::inStore())
				{
					\lib\app\cart\add::assing_to_user($guest, $code, true);
				}
			}

			\dash\utility\cookie::delete('user_guest_id');
		}
	}


	// set user guest id if not exists
	private static function set_user_guest()
	{
		if(self::id())
		{
			// not set get user if user login
			return;
		}

		$user_guest_id = \dash\utility\cookie::read('user_guest_id');
		if($user_guest_id)
		{
			if(!\dash\validate::md5($user_guest_id, false))
			{
				$user_guest_id = null;
			}
			else
			{
				// ok
				return;
			}
		}

		if($user_guest_id)
		{
			// ok;
			return;
		}

		$new_guest_id = microtime(). '_'. time(). '_'. rand(1, 999). '_'. rand(1, 999). '_'. rand(1, 999);
		$new_guest_id = md5($new_guest_id);

		\dash\utility\cookie::write('user_guest_id', $new_guest_id, (60*60*24*7));

		return $new_guest_id;
	}

}
?>
