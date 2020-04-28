<?php
namespace lib\app\ipg\wallet;


class set
{



	/**
	 * Add new wallet.
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function add_new_wallet($_args)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$condition =
		[
			'title' => 'string_50',

		];

		$require = ['title'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$check_duplicate_walletn = \lib\db\ipg\wallet\get::check_duplicate_walletn($data['title'], \dash\user::id());

		if(isset($check_duplicate_walletn['id']))
		{
			\dash\notif::error(T_("This Wallet was exists in your list"));
			return false;
		}

		$data['user_id']     = \dash\user::id();
		$data['status']      = 'enable';
		$data['datecreated'] = date("Y-m-d H:i:s");
		\lib\db\ipg\wallet\insert::new_record($data);

		\dash\notif::ok(T_("Wallet was added"));

		return true;
	}
}
?>