<?php
namespace lib\app\user;


class add
{



	/**
	 * add new user
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function add($_args, $_option = [])
	{
		\dash\app::variable($_args);

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => \dash\app::request(),
			]
		];

		$default_option =
		[

		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		if(!\lib\user::id())
		{
			\dash\notif::error(T_("User not found"), 'user');
			return false;
		}

		// check args
		$args = \lib\app\user\check::check(null, $_option);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$return         = [];

		if(!$args['status'])
		{
			$args['status'] = 'awaiting';
		}

		if($args['mobile'])
		{
			$check_mobile_exist = \lib\db\users\users::get_by_mobile($args['mobile']);
			if(isset($check_mobile_exist['id']))
			{
				\dash\notif::error(T_("Duplicate mobile"), 'mobile');
				return null;
			}
		}

		if(\dash\app::isset_request('nationalcode') || \dash\app::isset_request('pasportcode'))
		{
			if($args['nationalcode'] || $args['pasportcode'])
			{
				$check_duplicate_nationalcode = \lib\app\user\check::check_duplicate($args['nationalcode'], $args['pasportcode']);

				if($check_duplicate_nationalcode)
				{
					if($args['nationalcode'])
					{
						$nationalcode_q = $args['nationalcode'];
					}
					else
					{
						$nationalcode_q = $args['pasportcode'];
					}

					$msg = T_("Duplicate nationalcode or pasportcode in your user list");
					// $msg = "<a href='". \dash\url::kingdom(). '/crm/member?q='. $nationalcode_q. "'>$msg</a>";
					\dash\notif::error($msg, ['nationalcode', 'pasportcode']);
					return false;
				}
			}
		}

		$user_id = \lib\db\users\users::signup($args);

		if(!$user_id)
		{
			\dash\notif::error(T_("No way to insert user"), 'db', 'system');
			return false;
		}


		$return['id']      = $user_id;
		$return['user_id'] = $user_id;

		\dash\log::set('StoreAddNewUser', ['code' => $user_id]);
		// $_option['user_id'] = $user_id;

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("User successfuly added"));
		}

		return $return;
	}
}
?>